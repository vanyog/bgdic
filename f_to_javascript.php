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

// Връща стриг, представляващ дефиниция на масив с име $n на javascrip
// със стойностите от php масив $a

function to_javascript($a,$n){
$rz = "$n = Array( ";
foreach($a as $b){
  $rz .= "\"$b\",";
}
$rz = substr($rz, 0, strlen($rz)-1).");";
return $rz;
}

?>
