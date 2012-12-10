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

// Показване на html код за редактиране на форма на дума от таблица

$idir = dirname(dirname(__FILE__)).'/';

include($idir.'lib/f_db_select_1.php');

$t = 1*$_GET['t']; // Номер на таблицата
$n = 1*$_GET['n']; // Номер на формата

$d = db_select_1('*', 'w_tables', "`table`=$t AND `ID`=$n"); 

header("Content-Type: text/html; charset=windows-1251");

echo 'Заместване на <input type="text" size="2" name="old" value="'.$d['old'].'"> букви<br>
с окончание <input type="text" size="10" name="new" value="'.$d['new'].'"><br>
за образуване на форма <input type="text" size="3" name="form_id" value="'.$d['form_id'].'">.<br>
place = <input type="text" size="3" name="place" value="'.$d['place'].'"><br><br>

<input type="button" value="Променяне" onclick="onChangeTableForm();">
<p><input type="button" value="Добавяне на форма" onclick="onAddTableForm();">
<p><input type="button" value="Изтриване на форма" onclick="onDeleteTableForm();">

';

?>
