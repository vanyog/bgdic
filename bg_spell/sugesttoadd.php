<script language="php">
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

include("f_check.php");
include("../../cms/options.php");
include("../../cms/f_db_select_1.php");

$rfr = $_SERVER['HTTP_REFERER'];
$rf0 = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php';
//echo "$rfr<br />$rf0";
//print_r($_POST); //die;

if ($rfr==$rf0){
  $w = isBG($_POST['wordtoadd']);
  if ($isBG){
     $db_link = get_db_link();
     $wr = db_select_1("*","misspelled_bg_words","word='$w'");
     if (!$wr)
        $q="INSERT INTO misspelled_bg_words (word,date_0,date_1,IP) VALUES ('$w', NOW(), NOW(), '".$_SERVER['REMOTE_ADDR']."');";
     else{
        $c=$wr['count']+1;
        $q="UPDATE misspelled_bg_words SET date_1=NOW(), count=$c WHERE word='$w' AND NOT ip='".$_SERVER['REMOTE_ADDR']."';";
     }
//     echo $q;
     mysql_query($q,$db_link);
  }
  header("Location: $rfr?thank");
}

</script>