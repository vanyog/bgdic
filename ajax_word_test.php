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

// Показване формите на думата $_GET['w']

$idir = dirname(dirname(dirname(__FILE__))).'/';

include('f_word_forms.php');
include_once('f_form_string.php');

header("Content-Type: text/html; charset=windows-1251");

//$w = addslashes(utf8_to_cp1251($_GET['w']));
$w = addslashes(check_cp1251($_GET['w']));
//$w = addslashes($_GET['w']);
$t = 1*$_GET['t'];
$p = db_table_field('form_id', 'w_table_props', "`table`=$t");
echo "<strong>".form_string($p)."</strong><br>".word_forms($w, $t);

function utf8_to_cp1251($t){
$r='';
$i=0;
$l=strlen($t);
do{
 $ch=$t[$i];
 $c=ord($ch);
 $u=$c; $uu=0;
 switch ($c){
 case ($c<0x80): $b=1; break;
 case (($c>0x7F)&&($c<0xE0)): $b=2; $u=$u&0x31; break;
 case (($c>0xDF)&&($c<0xF0)): $b=3; $u=$u&0x15; break;
 case (($c>0xEF)&&($c<0xF8)): $b=4; $u=$u&0x7;  break;
 case (($c>0xF7)&&($c<0xFC)): $b=5; $u=$u&0x3;  break;
 case (($c>0xFB)&&($c<0xFD)): $b=6; $u=$u&0x1;  break;
 }
 while ($b>1){
  $i++;
  $uu=(ord($t[$i])&0x3F);
  $u=($u<<6) + $uu;
  $b--;
 }
 switch ($u){
 case (($u>0x40F)&&($u<0x450)): $ch=chr($u-0x410+192); break;
 }
 $r=$r.$ch;// echo "$r ";
 $i++;
} while ($i<$l);
return $r;
}

function check_cp1251($w){
for($i=0; $i<strlen($w); $i++) if (ord($w[$i])<ord('А')) return utf8_to_cp1251($w);
return $w;
}

?>
