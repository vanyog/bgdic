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

// Скриптът чете всички думи със `status`='1' (одобрени за добавяне) от таблица w_misspelled_bg_words
// на думите, които вече са вкарани в речника, задава `status` = 3 (вече доавени)
// и показва думите, които още не са добавени.

$idir = dirname(dirname(__FILE__)).'/';

include($idir.'lib/f_db_select_m.php');
include($idir.'lib/f_db_select_1.php');
include('bg_spell/f_check.php');

// Четене на всички думи без корекция
//$da = db_select_m('*', 'w_misspelled_bg_words', "`correct`='' ORDER BY `date_0` DESC");

// Четене на всички думи със `status`='1'
$da = db_select_m('*', 'w_misspelled_bg_words', "`status`='1' ORDER BY `date_0` DESC");

header("Content-Type: text/html; charset=windows-1251");

foreach($da as $w){ // За всяка одобрена дума
  // Чете се записа от таблица w_word_forms
  if (isCorrect($w['word'])){
    $q = "UPDATE `$tn_prefix"."w_misspelled_bg_words` SET `status`=3 WHERE `ID`='".$w['ID']."';";
    mysql_query($q,$db_link);
    echo $w['word'].": $q<br>\n";
  }
  else echo '<a href="'.$adm_pth.'edit_record.php?t=w_misspelled_bg_words&r='.$w['ID'].'">'.$w['word']."</a><br>\n";
}

echo "===";

?>
