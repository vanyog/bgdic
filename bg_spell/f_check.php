<?php
/*
Bulgarian online spelling dictionary - open source 
Copyright (C) 2011  Vanyo Georgiev <info@vanyog.com>

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

include_once($idir.'lib/f_db_select_m.php');
include_once($idir.'lib/f_stored_value.php');

global $dicurl;

$dicurl = stored_value('bgdic_url', 'http://physics-bg.org/z/');

//--------дефиниции на функции и класове------

// Връща true ако думата $w присъства в базата данни
function isCorrect($w){
$c = db_select_m('*','w_word_forms',"`word_form`='$w'");
if (count($c)){
 include_once("hlanguage.php");
 $hlang = new HLanguage('bg');
 foreach($c as $c1){
   $w1 = $c1['word_form'];
   if ($w==$w1) return true;
   if ( in_array($w1[0], $hlang->lc_l) ){ // ако думата в базата не започва с главна буква
     $w1[0]=$hlang->uc_l[$w1[0]];         // първата и буква се прави главна
   }
   if ($w==$w1) return true;
 }
}
else return false;
}

// Връща false ако думата $w съдържа друг символ освен български букви
// иначе връща самата дума
function isBG($w){
$w = trim($w);
include_once("hlanguage.php");
$hlang = new HLanguage('bg');
global $isBG;
$isBG = true;
for($i=0; $i<strlen($w); $i++){
  if ($i==0){
     if (!( in_array($w[$i],$hlang->lc_l) || in_array($w[$i],$hlang->uc_l) )){
        $isBG = false;
        return false;
        break;
     }
   }
   else {
     if (!in_array($w[$i],$hlang->lc_l)){
        $isBG = false;
        return false;
        break;
     }
   }
}
return trim($w);
}

?>
