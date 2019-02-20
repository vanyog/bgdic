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

// Връща html код, представящ всички форми на дума $w, 
// която образува формите си по таблица с номер $id

function word_forms($w,$id){
global $database, $user, $password, $db_link, $tn_prefix, $idir;
include_once($idir.'lib/f_db_select_m.php');
include_once('f_form_string.php');
$td = db_select_m('*', 'w_tables', "`table`=$id ORDER BY `place`");
$rz = '<div style="column-width: 300px;">'."\n";
$j = strpos($td[0]['new'],'?'); $a = '';
if (!($j===false)) $a = $w[strlen($w)-$td[0]['old']+$j];
$j = 0;
foreach($td as $t){
  if ($a) $t['new'] = str_replace('?',$a,$t['new']);
  if ($a) $t['new'] = str_replace('?',$a,$t['new']);
  $rz .= word_form($w,$t['old'],$t['new'])." - ".form_string($t['form_id'])."<br> ";
  $j++;
}
return $rz."</div>\n";
}

function word_form($w,$i,$p){
$rz = substr($w,0,strlen($w)-$i).$p;
return $rz;
}
?>
