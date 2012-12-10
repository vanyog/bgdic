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

// Изтриване на неизползвани групи свойства (форми) на думи

include('../f_db_field_values.php');
include('f_form_string.php');

die("Преди да изпълните този скрипт, го отворете и превърнете в коментар die командата, която го прекратява и показва настоящото  съобщение.");

// Четене на съществуващите номера на групи свойства (форми)
$ra = db_field_values('form','w_forms','1');

// За всеки номер на група свойства (форма):
foreach($ra as $r){
 // Четат се идентификаторите на таблиците, в които има форма $r
 $f = db_select_m('ID','w_tables',"`form_id`=$r");
 // Ако няма таблица, в която се използва формата
 if (!count($f)){
   // Четат се идентификаторите на таблиците, на които е приписана групата свойства
   $f = db_select_m('ID','w_table_props',"`form_id`=$r");
   // Ако групата свойства не е приписана и на основна форма на дума
   if (!count($f)){
     $q = "DELETE FROM `$tn_prefix"."w_forms` WHERE `form`=$r;";
     echo form_string($r,true)." <br>$q<p>";
     mysql_query($q,$db_link);
   }
 }
}

?>
