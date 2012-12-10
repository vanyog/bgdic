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

// Функцията връща кратко описание на форма на дума с номер $i
// Ако $y == true се добавя и номера на формата

include_once($idir.'lib/f_db_select_m.php');
include_once($idir.'lib/f_db_table_field.php');

function form_string($i, $y = false){
$da = db_select_m('*', 'w_forms', "`form`=$i ORDER BY `place`");
$rz = "";
foreach($da as $d) $rz .= db_table_field( 'abrev', 'w_properties', "`ID`=".$d['prop_id'] )." ";
if ($y) return $rz." - $i";
else return $rz;
}

?>
