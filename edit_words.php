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

// Страница за редактиране на думи

$exe_time = microtime(true);

$idir = dirname(dirname(dirname(__FILE__))).'/';
$ddir = $idir;

include_once($idir."conf_paths.php");
include_once($mod_apth."user/f_user.php");
include_once("f_insert_forms.php");

user();

process_data(); // Обработка на изпратените с POST данни

// Чете се следващата, предложена за добавяне дума
$nw = db_select_1('*','w_misspelled_bg_words','`status`=1 ORDER BY `date_0` DESC');
if ($nw) $nw = $nw['word'];

// Брой на оставащите за добавяне думи
$nc = db_table_field('COUNT(*)', 'w_misspelled_bg_words', '`status`=1');

$rpth = $pth.'mod/bgdic/';

$tb = ''; // Номер на таблица за добавяне на дума

$page_title = 'Редактиране на думи';

$page_header = '<script>

// Саздаване на обект за ajax заявки
if (window.XMLHttpRequest) ajaxO=new XMLHttpRequest();
else ajaxO=new ActiveXObject("Microsoft.XMLHTTP");

// Изпълнява се при щракване на бутона "Намиране"
function fingTable(){
var s = document.getElementById("ex_word");
ajaxO.open("GET","'.$rpth.'ajax_word_table.php?w="+s.value+"&z="+Math.random(),false);
ajaxO.send(null);
var t = ajaxO.responseText;
var f = document.getElementById("table");
if (t){
  f.value = t;
  document.getElementById("new_word").focus();
}
else {
  f.value = "";
  document.getElementById("test_result").innerHTML="Думата не е намерена";
}
}

function enterPressed(e){
if (e.keyCode==13) fingTable();
}

// Изпълнява се при щракване на бутона "Изтриване"
function deleteWord(){
var s = document.getElementById("ex_word");
var t = document.getElementById("table");
ajaxO.open("GET","'.$rpth.'ajax_word_delete.php?w="+s.value+"&t="+t.value+"&z="+Math.random(),false);
ajaxO.send(null);
var r = ajaxO.responseText;
if (r) alert("Думата "+r+" беше изтрита.");
else alert("Не беше изтрита дума, защото\nдумата не съществува\nили трябва да уточните думата от коя таблица да се изтрие.");
}

// Изпълнява се при щракване на бутона "Проба"
function onWordTest(){
var f = document.getElementById("new_word");
if(!f.value) onCopy();
var w = f.value;
if (w){
  var s = document.getElementById("table");
  var t = s.value;
  ajaxO.open("GET", "'.$rpth.'ajax_word_test.php?w="+w+"&t="+t+"&z="+Math.random(), false);
  ajaxO.send(null);
  document.getElementById("test_result").innerHTML=ajaxO.responseText;
}
}

function onCopy(){
var n = document.getElementById("new_word");
var s = document.getElementById("sugestion");
n.value = s.value;
}

</script>';

$page_content = '<p>Съществуваща дума: <input type="text" id="ex_word" onkeypress="enterPressed(event);">
<input type="button" value="Намиране" onclick="fingTable();"> 
<input type="button" value="Изтриване" onclick="deleteWord();"> 
<br></p>

<form action="'.$_SERVER['PHP_SELF'].'" method="POST">
<p>Таблица: <input type="text" name="table" id="table" value="'.$tb.'"> 
нова таблица: <input type="text" name="new_table" id="new_table">
</p>

<p>Нова дума: <input type="text" name="new_word" id="new_word"> 
<input type="button" value="Проба" onclick="onWordTest();"> 
<input type="submit" value="Добавяне или променяне на таблицата"> 
</p>
</form>

<p>Предложение: <input type="text" id="sugestion" value="'.$nw.'"> 
<input type="button" value="Копиране" onclick="onCopy();"><br>
Остават: '.$nc.' <a href="http://google.bg/search?q='.urlencode($nw).'" target="_blank">google</a>
</p>

<p><a href="editing.php">Администриране</a></p>

<div id="test_result" style="width:600px"></div>

<div style="position:absolute; top:50px; left:650px;">
<p><strong>Намиране</strong>. При щракване на този бутон, ако в поле "Съществуваща дума" е написана съществуваща в речника основна форма на дума в поле "Таблица" се показват таблиците на всички омоними на тази дума.</p>
<p><strong>Изтриване</strong>. При щракване на бутона от речника се изтрива думата, написана в поле "Съществуваща дума" и номера на таблица от поле "Таблица". Ако в "Таблица" има повече номера, не се случва нищо.</p>
<p><strong>Преместване на дума в нова таблица</strong>. Думата трябва да е написана в поле "Нова дума", таблицата й, която ще се смени, трябва да е написана в поле "Таблица", а новата и таблица в поле "Нова таблица". Щраква се бутона "Добавяне или променяне на таблица".</p>
<p><strong>Добавяне на нова дума</strong>. Първо се намира съществуваща дума, която образува форми със същите окончания. Новата дума трябва да е написана в "Нова дума", а таблицата, която ще получи - в "Таблица". Щраква се бутона "Проба", за да се провери какви форми ще образува. Ако формите се образуват правилно се щраква бутона "Добавяне или променяне на таблица". В противен случай се търси друга съществуваща дума с друга подходяща таблица.</p>
</div>

';

// Показване на страницата
include(__DIR__.'/build_page.php');

// Обработка на изпратените с POST данни
function process_data(){
global $tn_prefix, $db_link, $tb;
if (count($_POST)!=3) return;
$w = addslashes($_POST['new_word']);// Изпратена дума
$t = 1*$_POST['table']; $tb = $t;   // Изпратен номер на таблица
$nt = 1*$_POST['new_table'];        // Изпратен нов номер на таблица
if ($nt){ // Ако е изпратен нов номер на таблица се сменя таблицата на думата
  // Четене на съществуваща дума $w с таблица $t
  $d = db_select_1('*', 'w_words', "`word`='$w' AND `table`=$t"); //print_r($d); die;
  // Ако има такава дума се сменя таблицата й на $nt
  if ( $d ) update_word($d,$nt);
  return;
}
// Вмъкване на нова дума
$q = "INSERT INTO `$tn_prefix"."w_words` SET `word`='$w', `table`=$t;";
mysqli_query($db_link, $q);
$i = mysqli_insert_id($db_link);
$w = db_select_1('*', 'w_words', "`ID`=$i");
insert_forms($w);
remove_sugestions($w['ID']);
}

// Обновяване на формите на думата при смяна на таблицата й
// $w - асоциативен масив с данните на думата
// $v - номер на новата таблица
function update_word($w,$v){
// Ако таблицата не е друга, не се прави нищо 
if ($w['table']==$v) return;
global $tn_prefix, $db_link;
// Изтриване на старите форми
$q = "DELETE FROM `$tn_prefix"."w_word_forms` WHERE `word_id`=".$w['ID'].";";
mysqli_query($db_link, $q);
// Смяна на таблицата на думата
$q = "UPDATE `$tn_prefix"."w_words` SET `table`=$v WHERE `ID`=".$w['ID'].";";
mysqli_query($db_link, $q);
// Генериране на нови формите
$w['table']=$v;
insert_forms($w);
}

// Отбелязване формите на думата като приети в таблицата с новопредложени думи
// $i - номер на новата дума
function remove_sugestions($i){
global $tn_prefix, $db_link;
// Четене на формите на думата
$fs = db_select_m('word_form','w_word_forms',"`word_id`=$i");
// Съставяне на SQL заявка
$q = "UPDATE `$tn_prefix"."w_misspelled_bg_words` SET `status`=3 WHERE ";
foreach($fs as $f) $q .= "`word`='".$f['word_form']."' OR ";
$q = substr($q,0,strlen($q)-4).';';
// Изпълнение на SQL заявката
mysqli_query($db_link, $q);
};


?>
