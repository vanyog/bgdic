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

// Добавяне на думи от файл w_words_local.csv на програмата grammar-bg

$idir = dirname(dirname(dirname(__FILE__))).'/';
$ddir = $idir;

include($idir.'lib/o_form.php');
include('f_insert_forms.php');

if (isset($_POST['wdata'])) process_data();

$tef = new HTMLForm('te_form');
$tef->add_input( new FormTextArea('','wdata',50,30) );
$tef->add_input( new FormInput('','','submit') );

$page_content = $tef->html();

include($idir.'lib/build_page.php');

function process_data(){
$a = explode("\n",stripslashes($_POST['wdata']));
foreach($a as $l){
  $d = explode(",",trim($l));
  if (count($d)==5){
    $w = substr($d[1],1,strlen($d[1])-2);
    $t = substr($d[2],1,strlen($d[2])-2);
    insert_word($w,$t);
    echo "$w $t<br>";
  }
}
}

?>
