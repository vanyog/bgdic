<?php
/*
bg-online - open source bulgarian on-line spell checker
Copyright (C) 2008  Vanyo Georgiev <info@vanyog.com>

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

error_reporting(E_ALL); ini_set('display_errors',1);

$idir = dirname(dirname(dirname(dirname(__FILE__)))).'/';
$ddir = $idir;

include("f_proposals.php");

header("Content-Type: text/html; charset=windows-1251");

$w = isBG($_GET['for']);

$s = proposals($w);

echo '<p><strong>';
if (!count($s)) echo 'Няма предложения.';
else foreach($s as $w){
  echo "$w<br>";
}
echo '</strong></p>
'; 

if (!count($s) && $w){
$p = dirname($_SERVER['PHP_SELF']);
echo '<p>Моля, проверете правописа на думата "<strong>'.$w.'</strong>" в друг речник или я потърсете в <a href="http://google.bg/search?q='.urlencode(iconv('cp1251','UTF-8',$w)).'" target="_blank">google</a>.
Ако се уверите, че я пишете правилно, натиснете бутона <input type="submit" value="Предлагам да се добави" onclick="addSugestions();">. Избягвайте предложения, <a href="http://vanyog.com/_new/index.php?pid=12" target="_blank">подобни на тези</a>. 
Имайте предвид, че вулгарни, жаргонни и диалектни думи не се приемат за добавяне.
</p>
<div id="thanks"></div>';
}

?>