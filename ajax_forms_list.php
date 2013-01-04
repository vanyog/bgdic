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

// Връща html код за показване на списък със свойствата на дума.
// Трябва да получи в $_GET['n'] стойност на поле `form` от таблица `w_forms`.

$idir = dirname(dirname(dirname(__FILE__))).'/';

include($idir."lib/f_db_select_m.php");
include($idir."lib/f_db_select_1.php");
include("f_list_box.php");

$n = 1*($_GET['n']);

header("Content-Type: text/html; charset=windows-1251");

$va = db_select_m('prop_id','w_forms',"`form`='$n' ORDER BY `place`");

$ar = array();
foreach($va as $r){
  $pv = db_select_1('*', 'w_properties', "`ID`=".$r['prop_id']);
  $ar[] = $pv['name'].': '.$pv['value'];
}

echo list_box($ar, 'form_prop', '');

?>
