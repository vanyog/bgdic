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

// Ако са правени промени в някоя таблица, този скрипт генерира отново формите на думите от тази таблица
// Номерът на таблицата трябва да е изпратен в $_GET['t'].

if (isset($_GET['t'])) $t = 1*$_GET['t']; // Номер на таблицата
else die('Не е изпратен номер на таблица с $_GET["t"]');

$idir = dirname(dirname(__FILE__)).'/';

include($idir.'lib/f_db_select_m.php');
include('f_insert_forms.php');

$wd = db_select_m('*','w_words',"`table`=$t");

foreach($wd as $w){
  $q = "DELETE FROM `$tx_prefix"."w_word_forms` WHERE `word_id`=".$w['ID'].";";
  mysql_query($q,$db_link);
  insert_forms($w);
  echo $w['word']."<br>";
}

?>
