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

// Функцията list_box($va,$n,$js) генерира html код, който показва списък.
// $va е масив за редовете на списъка,
// $vi - масив от стойности
// $n  - име на списъка,
// $js - javscript, който се изпълнява при смяна на избрания ред в списъка

function list_box_i($va,$vi,$n,$js){
$sz = count($va) / 2;
if ($sz<10) $sz = 10;
$rz = "<select name=\"$n\" onchange=\"$js\"  multiple=\"multiple\" style=\"vertical-align:top;\" size=\"$sz\">\n";
if (count($va)) foreach($va as $i => $v){
 $rz .= '<option value="'.$vi[$i].'">'."$v\n";
}
$rz .= '</select>';
return $rz;
}


?>
