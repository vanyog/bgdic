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
$ddir = $idir;

include($idir."lib/f_db_select_1.php");

//$db_link=get_db_link();

if ( isset($_POST['autocorrect']) ) $correct = $_POST['autocorrect'];
else $correct = $_POST['correct'];

$q = "UPDATE $tn_prefix"."w_misspelled_bg_words SET correct='$correct'  WHERE word='".$_POST['word']."';";

if ($_POST['toadd'])
   $q = "UPDATE $tn_prefix"."w_misspelled_bg_words SET status=1 WHERE word='".$_POST['word']."';";

if ($_POST['toregect'])
   $q = "UPDATE $tn_prefix"."w_misspelled_bg_words SET status=2 WHERE word='".$_POST['word']."';";

if ($_POST['todel'])
   $q = "DELETE FROM $tn_prefix"."w_misspelled_bg_words WHERE word='".$_POST['word']."';";

//echo $q;

mysqli_query($db_link,$q);

mysqli_close($db_link);

header('Location: '.$_SERVER['HTTP_REFERER']);

?>
