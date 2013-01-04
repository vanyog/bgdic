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

// Отговаря на ajax заявка за показване на списък от думи,
// започващ от дума номер $_GET['n']

$idir = dirname(dirname(dirname(__FILE__))).'/';

include($idir.'lib/f_db_table_field.php');
include($idir.'lib/f_db_select_m.php');

$n = 1*$_GET['i']; // Номер на думата, от която започва списъка

$c = db_table_field('COUNT(*)', 'w_words', "1"); // Брой на всички думи в базата данни
$p = ceil(sqrt($c)); // Брой на думите, които ще се покажат

//if ($c-$n<2*$p) $p = $c-$n+1;

$wd = db_select_m('*', 'w_words', "1 ORDER BY `word` LIMIT $n,$p;");

header("Content-Type: text/html; charset=windows-1251");

$cols = 6; $k = 1;
$a = count($wd)/$cols; 
$pr = $n-$p; if ($pr<0) $pr=0;
$nx = $n+$p; if ($nx>$c) $nx=$n;
echo '<div style="overflow-y: hidden;">
<p style="margin:10px; padding:0;"><strong>
<a href="" onclick="abrev_click('.$pr.');return false;"><</a>   
<a href="" onclick="abrev_click('.$nx.');return false;">></a></strong></p>
<div style="float: left; margin:10px;">'."\n";
foreach($wd as $i => $w){
  echo '<a href="" onclick="word_click('.$w['ID'].');return false;">'.$w['word'].'</a>';
  if (($i+1)>=round($k*$a)){ $k++; echo '</div><div style="float: left; margin:10px;">'."\n"; }
  else echo "<br>\n";
}
echo "</div></div>\n"
?>
