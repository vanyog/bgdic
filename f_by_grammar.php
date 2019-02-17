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

include_once($idir.'lib/f_db_field_values.php');
include_once('f_combo_box_2.php');

function by_grammar(){
global $page_header, $body_adds;

$bpth = dirname($_SERVER['PHP_SELF']).'/';
$page_header .= '<script>

// Обект за ajax заявки
if (window.XMLHttpRequest) ajaxO=new XMLHttpRequest();
else ajaxO=new ActiveXObject("Microsoft.XMLHTTP");

function onPageLoad(){
onPropNameChanged();
}

function selectedValue(f){
var i = f.selectedIndex;
if ((i<0)||(i>=f.length)) return "";
else return f.options[i].value;
}

function onPropNameChanged(){
var v = selectedValue(document.getElementById("prop_name"));
ajaxO.open("GET","'.$bpth.'ajax_values_combo_box.php?n="+v+"&z="+Math.random(),false);
ajaxO.send(null);
var t = ajaxO.responseText.split("|");
eval(t[0]);
document.getElementById("prop_values").innerHTML=t[1];
onPropValueChanged();
}

function onPropValueChanged(){
var n = selectedValue(document.getElementById("prop_name"));
var v = selectedValue(document.forms.form_1.prop_value);
ajaxO.open("GET","'.$bpth.'ajax_words_by_props.php?n="+n+"&v="+v+"&z="+Math.random(),false);
ajaxO.send(null);
document.getElementById("words").innerHTML=ajaxO.responseText;
}
</script>';

$body_adds .= ' onload="onPageLoad();"';

$pa = db_field_values('name', 'w_properties', "1"); //die(print_r($pa,true));

$rz = '<form name="form_1">'.
combo_box($pa,array('id'=>'prop_name','onchange'=>'onPropNameChanged();')).
' <span id="prop_values"></span></form>
<div id="words"></div>
';

return $rz;

}

?>
