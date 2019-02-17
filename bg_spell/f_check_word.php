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

// Скрипт Правописен речник

$idir = dirname(dirname(dirname(dirname(__FILE__)))).'/';
$ddir = $idir;

include_once($idir.'lib/translation.php');
include_once('f_check.php');

function check_word(){

$rz = '';
if (isset($_POST['bg_word'])) $rz = check_1word();
return '<style>
#word_check { font-family: arial, sans-serif; }
#word_check form { display:inline-block;  padding:1em; margin-bottom:0; }
#word_check div.r { display:inline-block; float:right; padding:1em; }
#word_check div { overflow:auto; }
#word_check hr { border-top: none; }
</style>
<div id="word_check">'.$rz.'<p>'.translate('bg_spell_1').'</p>
<div>
<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
<input type="text" name="bg_word">
<input type="submit" value="'.translate('bg_spell_b').'">
</form>
<div class="r">'.translate('bg_spell_dl').'</div>
</div>
'.translate('bg_spell_2').'
</div>';
}

function check_1word(){
global $dicurl;
$w = isBG($_POST['bg_word']);
$rz = '';
if ($w){
  $rz = '<p>'.translate('bg_spell_word')." \"$w\" ";
//  $c = db_select_1('*', 'w_word_forms', "`word_form`='".addslashes($w)."'");
  $c = isCorrect($w);
  if ($c) $rz .= translate('bg_spell_ok').
          ' <a href="'.$dicurl.'?pid=2&wf='.urlencode($w).'" target="_blanc">'.
          translate('bg_spell_more').'</a></p>';
  else {
    $p = current_pth(__FILE__);
    $rz .= translate('bg_spell_nok').'<br>
<script type="text/javascript">
function getSugestions(){
  if (window.XMLHttpRequest) aj=new XMLHttpRequest();
  else aj=new ActiveXObject("Microsoft.XMLHTTP");
  aj.open("GET","'.$p.'proposals.php?for='.urlencode($w).'"+"&z="+Math.random(),false);
  aj.send(null);
  document.getElementById("sugestions").innerHTML = aj.responseText;
}
function addSugestions(){
  if (window.XMLHttpRequest) aj=new XMLHttpRequest();
  else aj=new ActiveXObject("Microsoft.XMLHTTP");
  aj.open("GET","'.$p.'addsugestion.php?for='.urlencode($w).'"+"&z="+Math.random(),false);
  aj.send(null);
  document.getElementById("sugestions").innerHTML = aj.responseText;
}
</script>
'.translate('bg_spell_pr').' <input type="button" value="'.translate('bg_spell_cr').
'" onclick="getSugestions();">.</p>
<div id="sugestions"></div>';
  }
  $rz .= '<hr>';
}
return $rz;
}

?>