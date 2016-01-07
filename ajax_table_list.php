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

// Показва списък на формите на дума от таблица номер $_GET['n']

$idir = dirname(dirname(dirname(__FILE__))).'/';
$ddir = $idir;

include($idir."lib/f_db_select_m.php");
include($idir."lib/f_db_select_1.php");
include('f_form_string.php');
include('f_list_box_i.php');

$n = 1*$_GET['n']; // Номер на таблицата

$da = db_select_m('*', 'w_tables', "`table`=$n ORDER BY `place`");
$fd = db_select_1('*', 'w_table_props', "`table`=$n");

$fid = ''; $ft = ''; $fl = '';
if ($fd){ $fid = $fd['form_id']; $ft = form_string($fd['form_id']); $fl = $fd['file']; }

header("Content-Type: text/html; charset=windows-1251");

$sl = array(); // Редове в списъка, описващи формите
$il = array(); // Индекс на формите

foreach($da as $d){
$sl[] = $d['old'].', '.$d['new'].' - '.form_string($d['form_id']);
$il[] = $d['ID'];
}

echo 'file: <input type="text" value="'.$fl.'" name="file" size="4"> '."<br>\n".
  'form_id: <input type="text" value="'.$fid.'" name="table_form_id" size="4"><br><strong>'.$ft."</strong><br>\n".
  list_box_i($sl, $il, 'table_forms', 'onTableFormChange();').'<br>
<input type="button" value="Примерни думи" onclick="showWords();">';

?>
