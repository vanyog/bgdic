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

// Страница за редактиране на възможните ствоства и таблици от свойства на думите

$exe_time = microtime(true);

$idir = dirname(dirname(dirname(__FILE__))).'/';
$ddir = $idir;

include('f_property_editor.php');
include($idir.'conf_paths.php');
include($mod_apth.'user/f_user.php');

user();

$page_content = '<p><a href="'.current_pth(__FILE__).'">Home</a></p>
'.property_editor();

include(__DIR__.'/build_page.php');
?>
