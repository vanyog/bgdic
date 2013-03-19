<?php
/*
Free Bulgarian Dictionary Database
Copyright (C) 2013  Vanyo Georgiev <info@vanyog.com>

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

// Проверка на правописа на текст

include($idir.'lib/o_form.php');
include(dirname(dirname(__FILE__)).'/bg_spell/f_check.php');

function spell_check_text(){
global $page_header, $tn_prefix, $db_link;

// Форма за задаване текста за проверяване
$txtf = new HTMLForm('txtch_form');
$te = new FormTextArea(translate('bgdic_web_text'),'texttch');
$txtf->add_input( $te );
$txtf->add_input( new FormInput('','','submit',translate('bgdic_web_submit')) );

// Ако вече е изпратен текст, той се проверява
$rz = check_text();

$n = '';

// Ако не е изпратен текст се показва формата за въвеждане на текст
if (!$rz) $rz = $txtf->html(); 
else {
  // Записване на проверения текст в таблица $tn_prefix.'w_checked_texts"
  if (!show_adm_links()){
    $q = "INSERT INTO `$tn_prefix"."w_checked_texts` SET `datetime_0`=NOW(), `IP`='".$_SERVER['REMOTE_ADDR'].
       "', `text`='".addslashes($rz)."';";
//    mysql_query($q,$db_link);
  }
  $rz = "<p>".translate('bgdic_web_result')."</p><div>".nl2br($rz)."</div>";
  $n = '<p><a href="'.$_SERVER['REQUEST_URI'].'">'.translate('bgdic_web_again').'</a></p>';
}

return '<div id="bgspellchecker">
'.$rz.'
</div>
'.$n;

}

// Функцията check_text() проверява правописа на текста $_POST['texttch']
function check_text(){
// Ако не е изпратен текст се връща празен низ
if (!isset($_POST['texttch'])) return '';
// Намиране и проверявана не всяка дума, написана на кирилица
$search = '/[А-Яа-я]+/is';
$GLOBALS['wrd'] = array();  // Асоциативен масив на срещащите се в текста думи
// Индекси на този масив са думите, а стойностите показват дали думите са правилно написани
$m = preg_replace_callback($search, 'check_word', $_POST['texttch']);
return $m;
}

function check_word($a){
global $wrd;
if (!array_key_exists($a[0],$wrd)) $wrd[$a[0]]=isCorrect($a[0]);
if ($wrd[$a[0]]) return $a[0];
else return '<span>'.$a[0].'</span>';
}

?>
