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

// Скрипт, който отговаря на ajax заявка.
// Връща html код за показване на падащ списък от стойности на свойството $_GET['n']

$idir = dirname(dirname(dirname(__FILE__))).'/';
$ddir = $idir;

include($idir."lib/f_db_field_values.php");
include("f_combo_box.php");
include('f_to_javascript.php');

header("Content-Type: text/html; charset=windows-1251");

$n = addslashes($_GET['n']); // Име на свойството

$va = array(); // Масив със стойностите
$aa = array(); // Масив със съкращения

// Четене на данните за свойството с име $n
$da = db_select_m('*','w_properties',"`name`='$n' ORDER BY `value`");// print_r("|$n"); die;

foreach($da as $d){
  $va[] = $d['value'];
  $aa[] = $d['abrev'];
}
//print_r($aa); die;
// Изпращане на резултата
echo to_javascript($aa,'abrev') . '|' . combo_box($va, 'prop_value', 'onPropValueChanged();');

?>
