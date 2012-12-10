<?php
/*
Bulgarian Spelling Dictionary based on Free Bulgarian Dictionary Database
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

// Добавяне на дума $_GET['for'] в таблица w_misspelled_bg_words

$idir = dirname(dirname(dirname(__FILE__))).'/';

include($idir.'lib/f_db_select_1.php');

$w = addslashes($_GET['for']);

$c = db_select_1('*','w_misspelled_bg_words',"`word`='$w'");

$q1 = ';';
$y = true;
if ($c){
 $q = "UPDATE `$tn_prefix"."w_misspelled_bg_words` SET `count`=`count`+1, ";
 $q1 = " WHERE `word`='".$c['word']."';";
 $y = ($c['IP']!=$_SERVER['REMOTE_ADDR']);
}
else $q = "INSERT INTO `$tn_prefix"."w_misspelled_bg_words` SET `word`='$w', `date_0`=NOW(), ";
$q .= "`date_1`=NOW(), `IP`='".$_SERVER['REMOTE_ADDR']."'$q1";

if ($y) mysql_query($q,$db_link);

header("Content-Type: text/html; charset=windows-1251");
echo "<p>Благодаря! Думата е добавена към новите предложения.</p>";

?>
