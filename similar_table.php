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

// Намира таблици подобни на $_GET['t']

error_reporting(E_ALL); ini_set('display_errors',1);

$idir = dirname(dirname(__DIR__)).'/';
$ddir = $idir;

include($idir.'lib/f_db_table_field.php');
include($idir.'lib/f_db_select_m.php');
include($idir.'lib/f_adm_links.php');

if (!isset($_GET['t'])) die("На този скрипт трябва да се изпрати с ?t= номера на таблицата, която ще се сравни с други таблици"); 
$t = 1*$_GET['t']; // Номер на таблицата

$fc = db_table_field( 'COUNT(*)', 'w_tables', "`table`=$t");    // Брой на формите в таблицата
$tf = db_table_field('form_id', 'w_table_props', "`table`=$t"); // Номер на групата общи свойства на думите от таблицата

$tt = db_select_m('*', 'w_table_props', "`form_id`=$tf");       // Номера на останалите таблици със същите общи свойства на думите

$rz = '<td>';
for($i=1; $i<=$fc; $i++) $rz .= "$i<br>";
$rz .= "</td>";
$th = '<table border="1"><tr><th>№</th>';
foreach($tt as $t){
  $fc1 = db_table_field( 'COUNT(*)', 'w_tables', '`table`='.$t['table']); // Брой на формите от поредната таблица
  if ($fc1==$fc){  // Поредната таблица се обработва ако има същия брой форми на думи
    $th .= '<th>'.$t['table'].'</th>';
    $rz .= '<td nowrap>';
    $fd = db_select_m('*', 'w_tables', '`table`='.$t['table'].' ORDER BY `place`');
    foreach($fd as $f) $rz .= $f['old']." ".$f['new']." ".$f['form_id']."<br>";
    $rz .= '</td>';
  }
}
$rz .= '</tr></table>';

header("Content-Type: text/html; charset=windows-1251");

echo adm_links()."$th</tr>\n<tr>$rz";

?>
