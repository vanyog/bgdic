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

// Масово прехвърляне на думи от една таблица в друга

error_reporting(E_ALL); ini_set('display_errors',1);

$idir = dirname(dirname(dirname(__FILE__))).'/';
$ddir = $idir;

include($idir.'lib/f_db_field_values.php');
include($idir.'lib/f_db_table_field.php');
include($idir.'lib/f_db_select_1.php');
include('f_form_string.php');
include('f_insert_forms.php');

$id = db_table_field('MAX(`ID`)', 'w_words', '1'); // Номер на последната въведена дума

header("Content-Type: text/html; charset=windows-1251");

// Обработка на данните изпратени с $_POST
if (isset($_POST['next'])){
  // Ако е изпратен номер на дума
  if ($_POST['next']<$id) $id = 1*$_POST['next'];
  // Ако е изпратена дума
  $i = 0;
  if ($_POST['fword']) $i = 1*db_table_field('ID','w_words', "`word`='".addslashes($_POST['fword'])."'");
  if ($i) $id = $i;
  // Променяне на данните в таблиците
  foreach($_POST as $n => $v) if (1*$n) {
     $w = db_select_1('*', 'w_words', "`ID`=$n");
     if ($w['table']!=$v) update_word($w,$v);
  }
}
else if (isset($_COOKIE['last_word_id'])) $id = $_COOKIE['last_word_id'];

setcookie('last_word_id', $id, time()+60*60*24*30, '/');

$lm = 30;
$ws = db_select_m('*', 'w_words', "`ID`<=$id ORDER BY `ID` DESC LIMIT 0,$lm");

$ts = array();
echo '<script type="text/javascript"><!--

function goFind(){
var f = document.forms.word_tables;
var n = f.fword;
n.value = f.word.value; //alert(n.value);
f.submit();
}

function goBack(){
var f = document.forms.word_tables;
var n = f.next;
n.value = 1*n.value + '.$lm.'; //alert(n.value);
f.submit();
}

function goThis(){
document.forms["word_tables"].submit();
}

function goForward(){
var f = document.forms.word_tables;
var n = f.next;
n.value = n.value - '.$lm.';
f.submit();
}

--></script><form name="word_tables" method="POST">
<input type="hidden" name="next" value="'.$id.'">
<input type="hidden" name="fword" value="">
<table>';

foreach($ws as $w){
   if (!count($ts)){
     echo '<tr>
<td valign="top">
<input type="text" name="word" value="'.$w['word'].'"><br>
<input type="button" value="Find" onclick="goFind();"><br> 
<input type="button" value="<" onclick="goBack();"> 
<input type="button" value="These" onclick="goThis();">
<input type="button" value=">" onclick="goForward();"><br> 
';
     $t = $w['table'] - 4;
     $ts = db_field_values('table', 'w_table_props', "`table`>$t", "LIMIT 0,8");
     foreach($ts as $t) echo "$t - ".form_string( db_table_field('form_id', 'w_table_props', "`table`=$t") )."<br>\n";
     echo "</td>\n<td><table>\n";
   }
   echo '<tr><td style="font-size:60%;">'.$w['ID'].'</td><td>'.$w['word']."</td>\n";
   foreach($ts as $t){
     echo '<td><input type="radio" name="'.$w['ID'].'" value="'.$t.'"';
     if ($t==$w['table']) echo " checked";
     echo '> '.$t."</td>\n";
   }
   echo "</tr>\n";
}
echo '</table>
</td></tr></table>
</form>';

function update_word($w,$v){
global $tn_prefix, $db_link;
// Изтриване на старите форми
$q = "DELETE FROM `$tn_prefix"."w_word_forms` WHERE `word_id`=".$w['ID'].";";
mysql_query($q,$db_link);
// Смяна на таблицата на думата
$q = "UPDATE `$tn_prefix"."w_words` SET `table`=$v WHERE `ID`=".$w['ID'].";";
mysql_query($q,$db_link);
// Генериране на нови формите
$w['table']=$v;
insert_forms($w);
}

?>
