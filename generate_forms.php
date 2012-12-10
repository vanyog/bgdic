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

// Скриптът генерира основните форми на думите и ги записва в таблица w_table_forms

$idir = dirname(dirname(__FILE__)).'/';

include($idir.'lib/f_db_select_m.php');
include($idir.'lib/f_db_table_field.php');
include('f_insert_forms.php');

// Номер на последната дума, на която са въведени формите
$id = 1*db_table_field('MAX(`word_id`)','w_word_forms','1');

// Ако няма думи, номера се прави 0
if (!$id) $id = 0;

// Лимит за броя на думите, чиито форми ще се генерират при едно изпълнение на скрипта
$lm = 5000;

// Четене на думите
$wa = db_select_m('*', 'w_words', "`ID`>$id ORDER BY `ID` LIMIT 0,$lm");


if (!count($wa)) echo "No more words<br>";

foreach($wa as $w) insert_forms($w);

echo "Done from ID = $id";

?>
