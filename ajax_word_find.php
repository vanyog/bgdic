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

// Скриптът отговаря на Ajax заявка за намиране на дума, изпратена с $_GET['i']

$idir = dirname(dirname(dirname(__FILE__))).'/';

include($idir.'lib/f_db_select_1.php');
include($idir.'lib/f_db_select_m.php');
include($idir.'lib/f_utf8_to_cp1251.php');
include('f_form_string.php');
include('f_word_forms.php');

header("Content-Type: text/html; charset=windows-1251");

// Думата, която се търси
$w = addslashes($_GET['i']); //echo $_GET['m']."<br>";

// Ако е кликната отметка да се търси само основна форма
if (isset($_GET['m']) && ($_GET['m']=='true')) $tb = 'w_words'; else $tb = 'w_word_forms';

$wr = db_select_m('*', $tb, whr($w) );
if (!count($wr)){
  $w = utf8_to_cp1251($w);
  $wr = db_select_m('*', $tb, whr($w) );
}
foreach($wr as $r){
  if (isset($_GET['m']) && ($_GET['m']=='true')) $id = $r['ID']; else $id = $r['word_id'];
  // Данни за основната форма на думата
  $r0 = db_select_1('*','w_words',"`ID`=$id");
  // Данни за таблицата за образуване на формите
  $ti = db_select_1('*', 'w_table_props', "`table`=".$r0['table'] );

  if (isset($_GET['m']) && ($_GET['m']=='false')) echo "<strong>".$r['word_form']."</strong> - ".form_string($r['form_id']).' от ';

  echo '<strong><a href="" onclick="word_click('.$r0['ID'].');return false;">'.
       $r0['word']."</a></strong> - ".form_string($ti['form_id']).
       " табл. ".$r0['table'].
       ' (<a href="http://google.bg/search?q='.urlencode(iconv('cp1251','UTF-8',$r0['word'])).'" target="_blank">google</a>)'.
       " <br>";
}

if (!count($wr)) echo "<p>Думата \"<strong>$w</strong>\" липсва в речника.</p>";

// Генерира частта след WHARE на sql заявката, която 
function whr($w){
if (isset($_GET['m']) && ($_GET['m']=='true')) $fn = 'word'; else $fn = 'word_form';
$p = strpos($w,'%');
if (!($p===false)){
  return "`$fn` LIKE '$w' LIMIT 0,10";
}
return "`$fn`='$w' ";
}

?>
