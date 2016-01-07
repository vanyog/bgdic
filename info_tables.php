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

// Показване на информация за таблиците за форми на думи

error_reporting(E_ALL); ini_set('display_errors',1);

$idir = dirname(dirname(dirname(__FILE__))).'/';
$ddir = $idir;

include($idir.'lib/f_db_field_values.php');
include($idir.'lib/f_db_select_1.php');
include('f_form_string.php');

// Четене на информацията за всички таблици от $tn_prefix.'table'
$ti = db_field_values('table','w_tables','1');

$page_title = 'Таблици';

$page_content = '<table border="1"><tr><th>№</th><th>Таблица</th><th>Произход</th><th>Брой форми</th><th>Думи</th></tr>
';

foreach($ti as $t){
 $td = db_select_1('*','w_table_props',"`table`=$t");
 $fs = form_string($td['form_id']); 
 $fc = db_table_field('COUNT(*)','w_tables',"`table`=$t");
 $ws = db_select_m('*','w_words',"`table`=$t LIMIT 0,3");
 $ew = '';
 foreach($ws as $w) $ew .= '<a href="ajax_word_test.php?w='.$w['word'].'&t='.$t.'">'.$w['word'].'</a> ';
 $page_content .= "<tr> <td>$t</td> <td>$fs</td> <td>".$td['file']."</td> <td>$fc</td> <td>$ew</td> </tr>\n";
}

$page_content .= '</table>';

include($idir.'/lib/build_page.php');
?>
