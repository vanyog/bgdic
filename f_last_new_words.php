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

// Показване на последните 100 одобрени за добавяне или добавени думи

$idir = dirname(dirname(dirname(__FILE__))).'/';
$ddir = $idir;

include_once($idir.'lib/f_db_table_field.php');
include_once($idir.'lib/f_db_select_m.php');
include_once($idir.'lib/translation.php');

function last_new_words(){
$c0 = db_table_field("COUNT(*)","w_misspelled_bg_words","status=1 OR status=3");
$ct = db_table_field("COUNT(*)","w_misspelled_bg_words","1");
$cb = db_table_field("COUNT(*)","w_misspelled_bg_words","status>0 OR correct>''");
$r0 = db_select_m("word,status","w_misspelled_bg_words",
      "(`status`=1 OR `status`=3) AND (`count`>`no`) ORDER BY `status`, date_0 DESC LIMIT 0,100");
$c = count($r0);
$cols = 4;
$c1=$c/$cols; $f=true;
$dicurl = stored_value('bgdic_url', 'http://physics-bg.org/z/');
$rz = '
<h1>Най-новите 100 от общо '.$c0.' добавени думи</h1>
<p>След като проверите дума в <a href="http://vanyog.com/_new/index.php?pid=8">правописния речник</a>, ако тя не присъства в речника и ако не се открият предложения за близки думи, има възможност с едно кликване на мишката да добавите думата в таблица с предложения. До момента по този начин са предложени '.$ct.' думи. Прегледът на '.$cb.' от тях показва, че много по-голямата част са грешни. (Приети са за добавяне '.$c0.'.) <strong>Предстои да се проверят още '.($ct-$cb).' думи, за която работа се търсят доброволци</strong>. Моля, който има желание да участва <a href="http://vanyog.com/_new/index.php?pid=13">да пише</a>. В таблицата по-долу виждате последните 100 предложени думи.</p>
<p>Последните реално добавени в речника думи може да видите като щракнете върху бутона "Показване" на последните 100 добавени думи на страницата на <a href="'.$dicurl.'index.php?pid=2">Речник на българския език</a>.</p>
<table><tr><td><p>';
foreach($r0 as $r1){
   if ($r1['status']==1){
      $rz .= '<span style="color:gray;">'.$r1['word'];
      if ($f) $rz .= '<sup>*</sup>'; $f=false;
      $rz .= "  ";
      $rz .= '</span>';
   }
   else $rz .= $r1['word'];
   if(in_edit_mode()){
     $rz .= ' <a href="http://google.bg/search?q='.urlencode($r1['word']).'">g</a>';
   }
   $rz .= " <br>";
   $c1--;
   if ($c1<=0){  $c1=$c/$cols; $rz .= '</p></td><td><p>'; } 
}
$rz .= '</p></td></tr></table>
';
if (!$f) $rz .= '<p><span style="color:gray;"><sup>*</sup> Думите в сиво са одобрени, но още не са добавени в речника.</span></p>
';
$rz .= '<hr>';
return $rz;
}

?>