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

// Този скрипт вече не е необходим.

// Проверяване дали думите от файл proba1.txt са налични в речника
// При откриване на липсваща дума, тя се изписва и скриптът спира да проверява повече

include('../f_db_select_m.php');

$ws = file('proba1.txt');

$c = 0;
foreach($ws as $i => $w){
 $wd = db_select_m('*','w_word_forms',"`word_form`='".trim($w)."'");
 if (!count($wd)){ echo "$w<br>"; $c++; }
}

echo "All is OK";

?>