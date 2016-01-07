<?php
/*
bg-online - open source bulgarian on-line spell checker
Copyright (C) 2008  Vanyo Georgiev <info@vanyog.com>

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Показване на предложения за нови думи с много грешки

if (!isset($idir)){
   $idir = dirname(dirname(dirname(dirname(__FILE__)))).'/';
   $ddir = $idir;
}

include_once($idir."lib/f_db_select_m.php");

header("Content-Type: text/html; charset=windows-1251");

echo bg_spell_errors();

function bg_spell_errors(){
$r0 = db_select_m("correct, COUNT(*)", "w_misspelled_bg_words", "correct>'' GROUP BY correct HAVING COUNT(*) > 1"); 
$r2 = array();
foreach($r0 as $r1){
   $r2[$r1['correct']] = $r1['COUNT(*)'];
}
arsort($r2);// print_r($r2); die;
$ka = array_keys($r2);
$rz = '
<h1>20 думи с най-много грешни предложения</h1>
<p><table>
<tr><th align="right">Дума</th><th>Грешки</th></tr>';
$c = 0;
foreach($ka as $k){
   $c++;
   if ($c>20) break;
   $w = db_select_m("word","w_misspelled_bg_words","correct='$k'");
   $rz .= "\n".'<tr valign="top"><td align="right">';
//   $rz .= $c.' ';
   $rz .= $k.'  </td><td>';
   foreach($w as $w1){
      $rz .= $w1['word'].'<br />';
   }
   $rz .= '</td></tr>';
}
$rz .= "\n".'</table>
';
return $rz;
}

?>
