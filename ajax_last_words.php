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

// Отговаря на ajax заявка за показване на последните $_GET['n'] въведени думи

$idir = dirname(dirname(dirname(__FILE__))).'/';
$ddir = $idir;

include($idir.'lib/f_db_table_field.php');
include($idir.'lib/f_db_select_m.php');

$p = 1*$_GET['n']; // Брой на последните думи, които трябва да се покажат

$wd = db_select_m('*', 'w_words', "1 ORDER BY `ID` DESC LIMIT 0,$p"); //print_r($wd); die;

header("Content-Type: text/html; charset=windows-1251");

$cols = 5; $k = 1;
$a = count($wd)/$cols; 
echo '<div style="overflow-y: hidden;">
<div style="float: left; margin:10px;">'."\n";
foreach($wd as $i => $w){
  echo '<a href="" onclick="word_click('.$w['ID'].');return false;">'.$w['word'].'</a> '.$w['table'];
  if (($i+1)>=round($k*$a)){ $k++; echo '</div><div style="float: left; margin:10px;">'."\n"; }
  else echo "<br>\n";
}
echo "</div></div>\n"
?>
