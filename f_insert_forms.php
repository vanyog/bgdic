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

// Вмъкване формите на дума в таблица w_word_forms
// $w е асоциативен масив на записа на думата в таблица w_words

include_once($idir."lib/f_db_select_m.php");

function insert_forms($w){

global $tn_prefix, $db_link;

$w0= $w['word'];
$i = $w['table'];
$fs = db_select_m('*', 'w_tables', "`table`=$i ORDER BY `place`");

$j = strpos($fs[0]['new'],'?');
$a = '';
if (!($j===false)) $a = $w0[strlen($w0)-$fs[0]['old']+$j];

$q = "INSERT INTO `$tn_prefix"."w_word_forms` (`word_id`,`form_id`,`word_form`) VALUES\n";

foreach($fs as $f){
  if ($a) $f['new'] = str_replace('?',$a,$f['new']);
  $wf = substr($w0, 0, strlen($w0)-$f['old']).$f['new'];
  $q .= "(".$w['ID'].", ".$f['form_id'].", '".$wf."'),\n";
}
$q = substr($q,0,strlen($q)-2).';';

mysql_query($q,$db_link);

}

?>
