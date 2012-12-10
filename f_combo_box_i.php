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

// Функцията combo_box_i($va,$n,$js) генерира html код, който показва падащ списък.
// $va е масив за редовете на списъка,
// $vv - масив за стойностите на option елементите
// $n - име на списъка,
// $js - javscript, който се изпълнява при смяна на избрания ред в списъка

function combo_box_i($va,$vv,$n,$js){
$rz = "<select name=\"$n\" onchange=\"$js\">\n";
if (count($va)) foreach($va as $i => $v){
 $rz .= '<option value="'.$vv[$i].'">'."$v\n";
}
$rz .= '</select>';
return $rz;
}

?>
