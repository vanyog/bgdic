<?php
/*
MyCMS - a simple Content Management System
Copyright (C) 2019  Vanyo Georgiev <info@vanyog.com>

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

// Генериране на страниците за администриране на речника

include_once($idir."lib/f_adm_links.php");

if (!isset($page_header)) $page_header = '';
$page_header .= "\n".'<link href="'.$adm_pth.'style.css" rel="stylesheet" type="text/css">';

$page_content = adm_links().'
'.$page_content;

include($idir."lib/build_page.php");
?>