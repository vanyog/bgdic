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

// Проверка на правописа на интернет страница

$idir = dirname(dirname(dirname(dirname(__FILE__)))).'/';

include($idir.'lib/o_form.php');
include('../bg_spell/f_check.php');

// Форма за задаване адреса на страницата
$urlf = new HTMLForm('url_form');
$urlf->add_input( new FormInput('bgdic_web_url','url','text','http://') );
$urlf->add_input( new FormInput('','','submit','bgdic_web_submit') );

$purl = ''; // Глобална променлива - url на проверяваната страница
$wrd = array(); // Асоциативен масив на срещащите се на страницата думи
// Индекси на този масив са думите, а стойностите показват дали думите са правилни

// Ако вече е изпратен адрес, той се обработва
$r = false;
if (isset($_POST['url'])) $r = check_url($_POST['url']);

// Ако адресът е невалиден или не е изпратен, се показва формата за задаване на адрес
if ($r!==false) echo $r;
else echo $urlf->html();


// Функцията check_url($u) проверява правописа на страница с адрес $u
function check_url($u){
// Изпратеният адрес трябва да започва с 'http://'
// в противен случай функцията връща false
if (substr($u,0,7)!='http://') return false;
global $purl;
$purl = $u;
// Четене на данните от адреса
$c = file_get_contents($u);
// Заменяне на относителните хипервръзки с абсолютни
$search = '/\s+(?:href|src)\s*=\s*"([^"]+)"/is';
$n = preg_replace_callback($search, 'make_absolute_links', $c);
// Отделяне на тялото на страницата
$search = '/(?:<body>|<\/body>)/is';
$pp = preg_split($search,$n);
// Добавяне на стил за показване на сгрешените думи
$pp[0] = str_replace('</head>','<style>.mspld {background-color:yellow; border-bottom:solid 1px red;} </style></head>',$pp[0]);
// Намиране и проверявана не всяка дума, написана на кирилица
$search = '/[А-Яа-я]+/is';
$wrd = array();
$m = preg_replace_callback($search, 'check_word', $pp[1]);
return $pp[0].'<body>'.$m.'</body>'.$pp[2];
}

function make_absolute_links($a){
global $purl;
$r = $a[1];
if ($a[1][0]=='/') $r = $purl.$r;
return str_replace($a[1],$r,$a[0]);
}

function check_word($a){
global $wrd;
if (!array_key_exists($a[0],$wrd)) $wrd[$a[0]]=isCorrect($a[0]);
if ($wrd[$a[0]]) return $a[0];
else return '<span class="mspld">'.$a[0].'</span>';
}

?>
