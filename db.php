<?php
/*
Free Bulgarian Dictionary Database
Copyright (C) 2012  Vanyo Georgiev <info@vanyog.com>

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// Скрипт за преглеждане и приемане/отхвърляне на предложените нови думи

$idir = dirname(dirname(dirname(__FILE__))).'/';
$ddir = $idir;

include($idir."lib/f_db_table_field.php");
include($idir."conf_paths.php");
include("bg_spell/f_proposals.php");
include($mod_apth.'user/f_user.php');

user();

$c = db_table_field("COUNT(*)","w_misspelled_bg_words","correct='' AND NOT status");
$w = db_select_1("*","w_misspelled_bg_words","correct='' AND NOT `status` ORDER BY `count` DESC, `date_0`");
$s = proposals($w['word']);
mysqli_close($db_link);

header("Content-Type: text/html; charset=windows-1251");

echo '<table><tr><td><center>
<p><strong>Нови думи - '.$c.' </strong></p>
<p>'.$w['date_0'].'<br>
'.$w['IP'].'<br>
предложена: '.$w['count'].' пъти</p>
<form method="POST" action="db2.php">
<p>Виж google търсене <a href="http://www.google.bg/search?q='.urlencode(iconv('cp1251','UTF-8',$w['word'])).'" target="_blank">'.$w['word'].'</a></p> 
<p>Предложения за думата: ';

if (!count($s)) echo '<strong>няма предложения</strong>';
else {
 echo '';
 foreach($s as $w1){
  echo '<input type="radio" name="autocorrect" value="'.$w1.'">'.$w1;
 }
 echo '';
}

echo '</p>
<input type="hidden" name="word" value="'.$w['word'].'">
<p><input type="text" name="correct" value="'.$w['word'].'"></p>
<p><input type="checkbox" name="toadd"> За добавяне <input type="checkbox" name="toregect"> за отхвърляне</p>
<p><font color="red"><input type="checkbox" name="todel"> за изтриване</font></p>
<input type="submit" value="Следваща дума">
</form>

<p><a href="'.$dicurl.'index.php?pid=2" target="_blank">Речник</a> ||
<a href="http://vanyog.com/_new/index.php?pid=11" target="_blank">Нови думи</a> ||
<a href="editing.php">Администриране</a></p>
</center></td></tr></table>';

?>
