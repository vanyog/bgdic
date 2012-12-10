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

// Скриптът чете поправките от таблицата с новите предложени думи
// и показва грешните поправки

error_reporting(E_ALL); ini_set('display_errors',1);

$idir = dirname(dirname(__FILE__)).'/';

include($idir.'conf_paths.php');
include($idir.'lib/f_db_select_m.php');
include("bg_spell/f_check.php");

$wd = db_select_m('*','w_misspelled_bg_words',"`correct`>'' AND `status`=0");

header("Content-Type: text/html; charset=windows-1251");

foreach($wd as $w){
  $wa = explode(' ',$w['correct']);
  foreach($wa as $p) { 
    if (!isCorrect($p)){
      if (substr($p,0,3)=='по-'){
        $p = substr($p,3,strlen($p)-3);
        if (!isCorrect($p)) echo '<a href="'.$adm_pth.'">'.$p."</a><br>\n";
      }
      else{
        if (substr($p,0,4)=='най-'){
          $p = substr($p,4,strlen($p)-4);
          if (!isCorrect($p)) echo "$p<br>";
        }
        else echo '<a href="'.$adm_pth.'edit_record.php?t=w_misspelled_bg_words&r='.$w['ID'].'">'.$p."</a><br>\n";;
      }
    }
  }
}

echo "===";

?>
