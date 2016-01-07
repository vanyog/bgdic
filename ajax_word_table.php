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

// Скриптът отговаря на ajax заявка, в която с $_GET['w'] e изпратена дума
// и в отговор връща номера/та на таблицата/ите, по която/ите се образуват формите на думата

error_reporting(E_ALL); ini_set('display_errors',1);

$idir = dirname(dirname(dirname(__FILE__))).'/';
$ddir = $idir;

include($idir."lib/f_db_select_m.php");
include($idir.'lib/f_utf8_to_cp1251.php');

$w = addslashes($_GET['w']);

$da = db_select_m('*','w_words',"`word`='".$w."'");
if (!count($da)){
  $w = utf8_to_cp1251($w);
  $da = db_select_m('*', 'w_words',"`word`='".$w."'");
}

header("Content-Type: text/html; charset=windows-1251");

if (!$da) echo '';
else for($i=0; $i<count($da); $i++){
 echo $da[$i]['table'];
 if ($i<count($da)-1) echo ',';
}


?>
