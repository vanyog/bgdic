<?php
// Copyright: Vanyo Georgiev info@vanyog.com

$idir = dirname(dirname(__FILE__)).'/';

include($idir."lib/f_db_select_m.php");
include($idir."lib/f_db_table_field.php");

$t = 1*$_GET['t'];

$wa = db_select_m('word', 'w_words', "`table`=$t LIMIT 0,10");
$c = db_table_field('COUNT(*)', 'w_words', "`table`=$t"); 

header("Content-Type: text/html; charset=windows-1251");
echo '<p><strong>Примерни думи:</strong></p>
<p>';
foreach($wa as $w) echo $w['word']."<br>\n";
echo "</p>
<p>$c думи в таблицата</p>";
?>