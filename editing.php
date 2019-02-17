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

// Главна страница за администриране, която показва линкове към други страници

$exe_time = microtime(true);

$idir = dirname(dirname(dirname(__FILE__))).'/';
$ddir = $idir;

include_once($idir.'conf_paths.php');
include_once($mod_apth.'user/f_user.php');

user();

$page_content = '<h1>Администриране на речника</h1>
<p>
<a href="'.$pth.'index.php?pid=2">Речник</a>
</p>
<p>
<a href="db.php">Преглеждане на новопредложените думи</a><br>
<a href="check_new.php">Проверяване на приетите думи</a><br>
<a href="check_corrections.php">Проверяване на поправките</a><br>
</p>

<p>
<a href="edit_words.php">Добавяне, изтриване, променяне на таблиците на думи</a><br>
</p>
<p>
<a href="'.$adm_pth.'edit_file.php?f=mod/bgdic">Файлове</a><br>
</p>
<p>
<a href="edit_properties.php">Свойства и таблици</a><br>
</p>
';

include(__DIR__.'/build_page.php');

?>
