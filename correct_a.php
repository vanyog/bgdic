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

include('../f_db_select_m.php');

$ws = db_select_m('*','w_word_forms',"`word_form` LIKE '%a%' LIMIT 0,2000");

foreach($ws as $w){
  $q = "UPDATE `$tn_prefix"."w_word_forms` SET `word_form`='".str_replace('a','à',$w['word_form']).
       "' WHERE `ID`=".$w['ID'].";";
  mysql_query($q,$db_link);
  echo "$q<br>"; 
}

echo '<a href="correct_a.php">Next</a>';
?>
