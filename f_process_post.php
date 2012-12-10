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

// Функции, които се използват от property_editor.php
// за обработка от сървъра на изпратени с $_POST данни

include_once($idir.'lib/f_db_select_1.php');
include_once('f_insert_forms.php');

// Главна функция
function process_posted(){
//print_r($_POST); die;
if (isset($_POST['sended_form_props'])) return process_form_data();
if (isset($_POST['prop_name'])) return process_prop_data();
if (isset($_POST['table_ids'])) return process_table_form();
if (isset($_POST['words'])) return process_words_data();
if (isset($_POST['table_by_word'])) return process_table_by_word();
return '<p>Не е програмирана функция за обработка на такъв набор от данни.</p>';
}

// Обработване на данни за свойство на дума
function process_prop_data(){
global $tn_prefix, $db_link;
include_once("f_db_select_1.php");
$n = addslashes($_POST['new_name']); // Ново име на свойство
$v = addslashes($_POST['new_value']);// Нова стойност на свойство
$a = addslashes($_POST['abrev']);    // Съкращение
if (!(strlen($n)*strlen($v))) return '<p>Името и стойността не може да са празни.</p>';
switch ($_POST['action']){
// Ако е натиснат бутон "Вмъкване"
case 'insert': 
  $ch = db_select_1('*','w_properties',"`name`='$n' AND `value`='$v'");
  if ($ch) return '<p>Вече има запис с такива стойности</p>';
  $q = "INSERT INTO `$tn_prefix"."w_properties` SET `name`='$n', `value`='$v', `abrev`='$a';";
  mysql_query($q,$db_link);
  break;
// Ако е натиснат бутон "Променяне"
case 'update':
  $on = addslashes(urldecode($_POST['prop_name']) );
  $ov = addslashes(urldecode($_POST['prop_value']));
  $ch = db_select_1('*','w_properties',"`name`='$on' AND `value`='$ov'");
  $q = "UPDATE `$tn_prefix"."w_properties` SET `name`='$n', `value`='$v', `abrev`='$a' WHERE `ID`=".$ch['ID'].";";
  mysql_query($q,$db_link);
  break;
}
}

// Обработка на данни за форма (група свойства) на дума
function process_form_data(){
//print_r($_POST); die;
global $tn_prefix, $db_link;
include_once("f_db_select_1.php");
include_once("f_db_table_field.php");
$pda = explode(';',$_POST['sended_form_props']); // Масив с изпратените двойки "име: стойност"
$fnu = 1*$_POST['form_ids'];                     // Номер на формата
$fda = array();                                  // Масив от свойства на формата
switch ($_POST['action']){
// Ако се вмъква нова форма
case 'insert':
  // Определя се следващия свободен номер на форма
  $fnu = db_table_field('MAX(`form`)', 'w_forms', '1') + 1;
  break;
// Ако се променя форма
case 'update':
  // Чете се масива от свойства на формата
  include_once('f_db_field_values.php');
  $fda = db_field_values('prop_id', 'w_forms', "`form`=".$fnu);
  break;
}
// Цикъл за обработка на всяка изпратена двойка "име: стойност"
foreach($pda as $p){
 // Разделяне на името на свойството от стойността му
 $pa = explode(': ',$p);
 // Определяне на номера на двойката "име: стойност" в таблица w_properties
 $pid = db_select_1('ID', 'w_properties', "`name`='".addslashes($pa[0])."' AND `value`='".addslashes($pa[1])."'");
 // Съставяне на SQL заявка
 $q = ';'; 
 switch ($_POST['action']){
 // Ако се вмъква нова форма
 case 'insert':
   $p = db_table_field('MAX(`place`)', 'w_forms', '1') + 10;
   $q = "INSERT INTO `$tn_prefix"."w_forms` SET `place`=$p, `form`=$fnu, `prop_id`=".$pid['ID'].";";
   mysql_query($q,$db_link); // echo "$q<br>";
   break;
 // Ако се променя форма
 case 'update':
   // Номер на записа със свойството номер $pid['ID'] на форма номер $fnu
   $rid = db_select_1('ID', 'w_forms', "`form`=$fnu AND `prop_id`=".$pid['ID']);
   // Ако няма такъв запис се добавя, а ако има се променя
   if (!$rid){
     $p = db_table_field('MAX(`place`)', 'w_forms', '1') + 10;
     $q = $q = "INSERT INTO `$tn_prefix"."w_forms` SET `place`=$p, `form`=$fnu, `prop_id`=".$pid['ID'].";";
   }
   else {
     $q = "UPDATE `$tn_prefix"."w_forms` SET `form`=$fnu, `prop_id`=".$pid['ID']." WHERE `ID`=".$rid['ID'].";";
     $k = array_search($pid['ID'],$fda);
     unset($fda[$k]);
   }
   mysql_query($q,$db_link); // echo "$q<br>";
   break;
 }
} // Край на цикъла за обработка на всяка изпратена двойка "име: стойност"
// Изтриване на стари свойства на формата
foreach($fda as $fd){
  $q = "DELETE FROM `$tn_prefix"."w_forms` WHERE `form`=$fnu AND `prop_id`=$fd;";
  mysql_query($q,$db_link); 
//  echo "$q<br>";
}
//die;
setcookie('form_id',$fnu,0,'/');
//die;
return '';
}

// Обработка на данни за таблица от форми на дума
function process_table_form(){
global $tn_prefix,$db_link;
$t = 1*$_POST['table_ids'];
switch ($_POST['action']){
case 'insert': // Вмъкване на нова форма в таблицата
  $o = 1*$_POST['old'];
  $n = addslashes($_POST['new']);
  $f = 1*$_POST['form_id'];
  $p = db_table_field('MAX(`place`)', 'w_tables', '1')+10;
  $q = "INSERT INTO `$tn_prefix"."w_tables` SET `place`=$p, `table`=$t, `old`=$o, `new`='$n', `form_id`=$f;";
  mysql_query($q,$db_link);
  break;
case 'save': // Вмъкване на запис за таблицата в w_table_props
  $f = 1*$_POST['table_form_id'];
  $q = "INSERT INTO `$tn_prefix"."w_table_props` SET `table`=$t, `form_id`=$f;";
  mysql_query($q,$db_link);
  break;
case 'new': // Създаване на нова таблица
  $t = db_table_field('MAX(`table`)', 'w_tables', '1')+1;
  $o = 1*$_POST['old'];
  $n = addslashes($_POST['new']);
  $f = 1*$_POST['form_id'];
  $p = db_table_field('MAX(`place`)', 'w_tables', '1')+10;
  $q = "INSERT INTO `$tn_prefix"."w_tables` SET `place`=$p, `table`=$t, `old`=$o, `new`='$n', `form_id`=$f;";
  mysql_query($q,$db_link);
  $f = 1*$_POST['table_form_id'];
  $q = "INSERT INTO `$tn_prefix".
       "w_table_props` SET `table`=$t, `form_id`=$f, `file`='".addslashes($_POST['file'])."';";
  mysql_query($q,$db_link);
//  print_r($_POST); die;
  break;
case 'similar':
  $da = db_select_m('*', 'w_tables', "`table`=$t ORDER BY `place`");
  $p = db_table_field('MAX(`place`)', 'w_tables', '1');
  $t = db_table_field('MAX(`table`)', 'w_tables', '1')+1;
  foreach($da as $d){
    $p += 10;
    $o = $d['old'];
    $n = $d['new'];
    $f = $d['form_id'];
    $q = "INSERT INTO `$tn_prefix"."w_tables` SET `place`=$p, `table`=$t, `old`=$o, `new`='$n', `form_id`=$f;";
    mysql_query($q,$db_link);
//    echo "$q<br>";
  }
  $f = 1*$_POST['table_form_id'];
  $q = "INSERT INTO `$tn_prefix".
       "w_table_props` SET `table`=$t, `form_id`=$f, `file`='".addslashes($_POST['file'])."';";
    mysql_query($q,$db_link);
//    echo "$q<br>";
//  die;
  break;
case 'update': // Променяне на данните за формата на дума
  $i = 1*$_POST['table_forms'];
  $o = 1*$_POST['old'];
  $n = addslashes($_POST['new']);
  $f = 1*$_POST['form_id'];
  $p = 1*$_POST['place'];
  $q = "UPDATE `$tn_prefix"."w_tables` SET `place`=$p, `old`=$o, `new`='$n', `form_id`=$f WHERE `ID`=$i;";
  mysql_query($q,$db_link);
//  print_r($q); die;
  break;
case 'delete': // Изтриване форма на дума от таблица с форми
  $i = 1*$_POST['table_forms'];
  $q = "DELETE FROM `$tn_prefix"."w_tables` WHERE `ID`=$i;";
  mysql_query($q,$db_link);
//  print_r($q); die;
  break;
}
setcookie('table_id',$t,0,'/');
setcookie("anchor","tables",0,'/');
return '';
}

// Вмъкване на думи в базата данни
function process_words_data(){
//print_r($_POST); die;
global $tn_prefix, $db_link, $idir;
include_once($idir.'lib/f_db_select_1.php');
if ($_POST['correct']){ // Ако поредната, предложена дума е грешна и е поправена
  $q = "UPDATE `$tn_prefix"."w_misspelled_bg_words` SET `correct`='".$_POST['correct']."', `status`=0 WHERE `word`='".
       $_POST['new_word']."';";
  mysql_query($q,$db_link);
}
$t = 1*$_POST['table'];
$wa = explode("\n",$_POST['words']);
if (!$_POST['words']) { // Ако не са предложени думи в полето за нови думи, се добавя поредната дума от предложените
  $q = "UPDATE `$tn_prefix"."w_misspelled_bg_words` SET `status`=3 WHERE `word`='".$_POST['new_word']."';";
  mysql_query($q,$db_link);
  $wa[] = $_POST['new_word'];
}
foreach($wa as $w){
  $w0 = addslashes(trim($w));
  if ($w0){
    // За проверка дали думата вече е вмъкната
    $r = db_select_1('*', 'w_words', "`word`='$w0' AND `table`=$t");
    // Ако не е вмъкната се вмъква
    if (!$r){
      $q = "INSERT INTO `$tn_prefix"."w_words` SET `word`='$w0', `table`=$t;";
      mysql_query($q,$db_link);
      $id = mysql_insert_id();
      $w = db_select_1('*', 'w_words', "`ID`=$id");
      insert_forms($w);
    }
  }
}
//die;
}

// Намиране на таблицата на думата $_POST['table_by_word']
// номера на таблицата се изпраща с бисквитка
function process_table_by_word(){
global $tb_prop_form_id;
$w = addslashes($_POST['table_by_word']);
if ($w){
  $d = db_select_1('*', 'w_words', "`word`='$w'");
  if ($d) setcookie('table_id',$d['table'],0,'/');
  $tp = db_select_1('*', 'w_table_props', "`table`=".$d['table']);
//  $GLOBALS['tb_prop_form_id'] = "`form_id`=".$tp['form_id'];
}
else{
  $GLOBALS['tb_prop_form_id'] = "`form_id`=".(1*$_POST['table_prop']);
}
}

?>
