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

$idir = dirname(dirname(dirname(__FILE__))).'/';

include($idir.'lib/f_db_select_1.php');
include('f_form_string.php');
include('f_word_forms.php');

$id = 1*$_GET['i'];

$w = db_select_1('*', 'w_words', "`ID`=$id");
$ti = db_select_1('*', 'w_table_props', "`table`=".$w['table'] );

header("Content-Type: text/html; charset=windows-1251");

echo '<strong>'.$w['word'].'</strong> - '.form_string($ti['form_id']).
' <em>'.$w['note'].'</em> <a href="http://google.bg/search?q='.urlencode(iconv('cp1251','UTF-8',$w['word'])).'" target="_blank">google</a><br>
Таблица: '.$w['table']."\n";

echo word_forms($w['word'],$w['table']);

?>
