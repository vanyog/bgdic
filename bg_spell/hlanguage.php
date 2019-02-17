<?php
/*
BGphpBible - php version of CD Bible project (www.vanyog.com/bible)
Copyright (C) 2006  Vanyo Georgiev <info@vanyog.com>

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

// Клас със зявисещи от езика функции 
class HLanguage{

var $lc_l = array(); 
var $uc_l = array();
var $sro = array();
var $sro1 = array();

function __construct($hl){
 switch ($hl){
  case 'en0': // английски + числа
   $lc='0123456789abcdefghijklmnopqrstuvwxyz';
   $uc='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   break;
  case 'bg': // български
   $lc='абвгдежзийклмнопрстуфхцчшщъьюя';
   $uc='АБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЬЮЯ';
   break;
  case 'ma': // македонски
   $lc='абвгдѓежзѕијклљмнњопрстќуфхцчџш';
   $uc='АБВГДЃЕЖЗЅИЈКЛЉМНЊОПРСТЌУФХЦЧЏШ';
   break;
  case 'sec': // сръбски на кирилица
   $lc='абвгдђежзијклљмнњопрстћуфхцчџш';
   $uc='АБВГДЂЕЖЗИЈКЛЉМНЊОПРСТЋУФХЦЧЏШ';
   break;
  case 'ru': // руски
   $lc='абвгдежзийклмнопрстуфхцчшщъыьэюя';
   $uc='АБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ';
   break;
 }
 for($i=0;$i<strlen($lc);$i++){
  $this->lc_l[$uc[$i]]=$lc[$i];
  $this->uc_l[$lc[$i]]=$uc[$i];
  $this->sro[$lc[$i]]=1001+$i;
  $this->sro[$uc[$i]]=1001+$i;
  $this->sro1[$lc[$i]]=1001+2*$i+1;
  $this->sro1[$uc[$i]]=1001+2*$i;
 }
}

function lc_letter($c){
if (array_key_exists($c,$this->lc_l)) return $this->lc_l[$c];
if (array_key_exists($c,$this->uc_l)) return $c;
else return -1;
}

function compare($s1,$s2){  // case insesitive 
$n1=strlen($s1); $n=$n1;
$n2=strlen($s2);
if ($n2<$n) $n=$n2; 
$r=0; $i=0;
while (($i<$n)&&($r==0)){
 if ($this->sro[$s1[$i]] < $this->sro[$s2[$i]]) $r=-1;
 else { if ($this->sro[$s1[$i]] > $this->sro[$s2[$i]]) $r=1;
      else $r=0; }
// echo $s1[$i]." ".$s2[$i]." $r<BR>";
 $i++;
}
if (($r==0) && ($n1<$n2)) return -1;
if (($r==0) && ($n1>$n2)) return 1;
return $r;
}

function compare1($s1,$s2){  // case sensitive
$n1=strlen($s1); $n=$n1;
$n2=strlen($s2);
if ($n2<$n) $n=$n2; 
$r=0; $i=0;
while (($i<$n)&&($r==0)){
 if ($this->sro1[$s1[$i]] < $this->sro1[$s2[$i]]) $r=-1;
 else { if ($this->sro1[$s1[$i]] > $this->sro1[$s2[$i]]) $r=1;
      else $r=0; }
// echo $s1[$i]." ".$s2[$i]." $r<BR>";
 $i++;
}
if (($r==0) && ($n1<$n2)) return -1;
if (($r==0) && ($n1>$n2)) return 1;
return $r;
}

} // class HLanguage

?>