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

include($idir."lib/f_db_select_m.php");
include($idir."lib/f_db_table_field.php");

$t = 1*$_GET['t'];

$wa = db_select_m('word', 'w_words', "`table`=$t LIMIT 0,10");
$c = db_table_field('COUNT(*)', 'w_words', "`table`=$t"); 

header("Content-Type: text/html; charset=windows-1251");
echo '<p><strong>Примерни думи:</strong></p>
<p>';
foreach($wa as $w) echo $w['word']."<br>\n";
echo "</p>
<p>$c думи в таблицата</p>";
?>