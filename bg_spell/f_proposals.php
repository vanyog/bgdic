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

include("f_check.php");

function proposals($w){

$w = addslashes($w);

$s=array();

$w1 = maybe_up($w); if ($w1) $s[]=$w1;

$w1 = maybe_changed($w, 'у', 'о'); if ($w1) $s[]=$w1; //143 авгост
$w1 = maybe_changed($w, 'о', 'у'); if ($w1) $s[]=$w1; //129 аксесуари
$w1 = maybe_changed($w, 'ъ', 'а'); if ($w1) $s[]=$w1; //96 аганце
$w1 = maybe_changed($w, 'а', 'ъ'); if ($w1) $s[]=$w1; //66 бакълавър
$w1 = maybe_changed($w, 'и', 'е'); if ($w1) $s[]=$w1; //50 аперетив
$w1 = maybe_changed($w, 'е', 'и'); if ($w1) $s[]=$w1; //47 барилеф
$w1 = maybe_changed($w, 'е', 'я'); if ($w1) $s[]=$w1; //34 англоговорящи
$w1 = maybe_changed($w, 'с', 'з'); if ($w1) $s[]=$w1; //32 визкозитет
$w1 = maybe_changed($w, 'з', 'с'); if ($w1) $s[]=$w1; //31 беспокоен
$w1 = maybe_changed($w, 'й', 'и'); if ($w1) $s[]=$w1; //24 воивода
$w1 = maybe_changed($w, 'д', 'т'); if ($w1) $s[]=$w1; //23 арента
$w1 = maybe_changed($w, 'а', 'я'); if ($w1) $s[]=$w1; //22 айрян
$w1 = maybe_changed($w, 'и', 'й'); if ($w1) $s[]=$w1; //18 батерий
$w1 = maybe_changed($w, 'я', 'а'); if ($w1) $s[]=$w1; //16 визиа
$w1 = maybe_changed($w, 'в', 'ф'); if ($w1) $s[]=$w1; //16 фсичко
$w1 = maybe_changed($w, 'т', 'д'); if ($w1) $s[]=$w1; //15 бисквидена
$w1 = maybe_changed($w, 'я', 'е'); if ($w1) $s[]=$w1; //12 влекъл
$w1 = maybe_changed($w, 'ф', 'в'); if ($w1) $s[]=$w1; //10 автограв
$w1 = maybe_changed($w, 'а', 'е'); if ($w1) $s[]=$w1; //9 апендисит
$w1 = maybe_changed($w, 'г', 'к'); if ($w1) $s[]=$w1; //7 белек
$w1 = maybe_changed($w, 'ь', 'и'); if ($w1) $s[]=$w1; //6 Валио
$w1 = maybe_changed($w, 'ъ', 'ь'); if ($w1) $s[]=$w1; //6 зорьк
$w1 = maybe_changed($w, 'щ', 'ш'); if ($w1) $s[]=$w1; //6 плошта
$w1 = maybe_changed($w, 'ь', 'й'); if ($w1) $s[]=$w1; //5 асансйор
$w1 = maybe_changed($w, 'н', 'м'); if ($w1) $s[]=$w1; //5 бемка
$w1 = maybe_changed($w, 'ж', 'ш'); if ($w1) $s[]=$w1; //5 белешка
$w1 = maybe_changed($w, 'е', 'а'); if ($w1) $s[]=$w1; //5 водочерпане
$w1 = maybe_changed($w, 'а', 'о'); if ($w1) $s[]=$w1; //5 кото
$w1 = maybe_changed($w, 'я', 'ъ'); if ($w1) $s[]=$w1; //4 леярът
$w1 = maybe_changed($w, 'ь', 'ъ'); if ($w1) $s[]=$w1; //4 белъо
$w1 = maybe_changed($w, 'ш', 'ж'); if ($w1) $s[]=$w1; //4 афиж
$w1 = maybe_changed($w, 'п', 'б'); if ($w1) $s[]=$w1; //4 гибс
$w1 = maybe_changed($w, 'о', 'и'); if ($w1) $s[]=$w1; //4 мимче
$w1 = maybe_changed($w, 'о', 'а'); if ($w1) $s[]=$w1; //4 бежав
$w1 = maybe_changed($w, 'к', 'г'); if ($w1) $s[]=$w1; //4 егземпляр
$w1 = maybe_changed($w, 'ъ', 'о'); if ($w1) $s[]=$w1; //3 возкресе
$w1 = maybe_changed($w, 'щ', 'шт'); if ($w1) $s[]=$w1; //3 ништо
$w1 = maybe_changed($w, 'с', 'ц'); if ($w1) $s[]=$w1; //3 отцъствам
$w1 = maybe_changed($w, 'ръ', 'ър'); if ($w1) $s[]=$w1; //3 гърк
$w1 = maybe_changed($w, 'р', 'л'); if ($w1) $s[]=$w1; //3 болдюри
$w1 = maybe_changed($w, 'обу', 'убо'); if ($w1) $s[]=$w1; //3 неубоздан
$w1 = maybe_changed($w, 'м', 'н'); if ($w1) $s[]=$w1; //3 бонбардира
$w1 = maybe_changed($w, 'к', 'ч'); if ($w1) $s[]=$w1; //3 влечат
$w1 = maybe_changed($w, 'й', 'ь'); if ($w1) $s[]=$w1; //3 Българиьо
$w1 = maybe_changed($w, 'иа', 'я'); if ($w1) $s[]=$w1; //3 вегетарянска
$w1 = maybe_changed($w, 'и', 'ь'); if ($w1) $s[]=$w1; //3 интерьор
$w1 = maybe_changed($w, 'а', 'и'); if ($w1) $s[]=$w1; //3 вслушило
$w1 = maybe_changed($w, 'я', 'иа'); if ($w1) $s[]=$w1; //2 акомпаниатор
$w1 = maybe_changed($w, 'ъз', 'ос'); if ($w1) $s[]=$w1; //2 воскресе
$w1 = maybe_changed($w, 'ъ', 'я'); if ($w1) $s[]=$w1; //2 катинарят
$w1 = maybe_changed($w, 'ъ', 'е'); if ($w1) $s[]=$w1; //2 мениджер
$w1 = maybe_changed($w, 'ш', 'щ'); if ($w1) $s[]=$w1; //2 потърпевщ
$w1 = maybe_changed($w, 'ц', 'чк'); if ($w1) $s[]=$w1; //2 именничка
$w1 = maybe_changed($w, 'ц', 'тс'); if ($w1) $s[]=$w1; //2 отселеем
$w1 = maybe_changed($w, 'ц', 'с'); if ($w1) $s[]=$w1; //2 пинсета
$w1 = maybe_changed($w, 'у', 'ю'); if ($w1) $s[]=$w1; //2 кюртоазия
$w1 = maybe_changed($w, 'у', 'от'); if ($w1) $s[]=$w1; //2 отдържани
$w1 = maybe_changed($w, 'тс', 'ц'); if ($w1) $s[]=$w1; //2 децка
$w1 = maybe_changed($w, 'оу', 'уо'); if ($w1) $s[]=$w1; //2 двуомях
$w1 = maybe_changed($w, 'от', 'у'); if ($w1) $s[]=$w1; //2 учайване
$w1 = maybe_changed($w, 'око', 'уку'); if ($w1) $s[]=$w1; //2 кукушарник
$w1 = maybe_changed($w, 'иден', 'еди'); if ($w1) $s[]=$w1; //2 конфедициална
$w1 = maybe_changed($w, 'ече', 'яка'); if ($w1) $s[]=$w1; //2 навлякан
$w1 = maybe_changed($w, 'еле', 'или'); if ($w1) $s[]=$w1; //2 тилифон
$w1 = maybe_changed($w, 'е', 'ъ'); if ($w1) $s[]=$w1; //2 отвъргнат
$w1 = maybe_changed($w, 'г', 'х'); if ($w1) $s[]=$w1; //2 контрахент
$w1 = maybe_changed($w, 'вт', 'ф'); if ($w1) $s[]=$w1; //2 космонаф
$w1 = maybe_changed($w, 'б', 'п'); if ($w1) $s[]=$w1; //2 корап

$w1 = maybe_dropped($w, 'т'); if ($w1) $s[]=$w1; //57
$w1 = maybe_dropped($w, 'н'); if ($w1) $s[]=$w1; //28
$w1 = maybe_dropped($w, 'и'); if ($w1) $s[]=$w1; //17
$w1 = maybe_dropped($w, 'з'); if ($w1) $s[]=$w1; //15
$w1 = maybe_dropped($w, 'с'); if ($w1) $s[]=$w1; //14
$w1 = maybe_dropped($w, 'д'); if ($w1) $s[]=$w1; //11
$w1 = maybe_dropped($w, 'в'); if ($w1) $s[]=$w1; //11
$w1 = maybe_dropped($w, 'е'); if ($w1) $s[]=$w1; //9
$w1 = maybe_dropped($w, 'й'); if ($w1) $s[]=$w1; //7
$w1 = maybe_dropped($w, 'а'); if ($w1) $s[]=$w1; //7
$w1 = maybe_dropped($w, 'о'); if ($w1) $s[]=$w1; //6
$w1 = maybe_dropped($w, 'у'); if ($w1) $s[]=$w1; //3
$w1 = maybe_dropped($w, 'л'); if ($w1) $s[]=$w1; //3
$w1 = maybe_dropped($w, 'ва'); if ($w1) $s[]=$w1; //3
$w1 = maybe_dropped($w, 'ь'); if ($w1) $s[]=$w1; //2
$w1 = maybe_dropped($w, 'п'); if ($w1) $s[]=$w1; //2
$w1 = maybe_dropped($w, 'м'); if ($w1) $s[]=$w1; //2

$w1 = maybe_inserted($w, 'т'); if ($w1) $s[]=$w1; //40
$w1 = maybe_inserted($w, 'н'); if ($w1) $s[]=$w1; //39
$w1 = maybe_inserted($w, 'с'); if ($w1) $s[]=$w1; //21
$w1 = maybe_inserted($w, 'в'); if ($w1) $s[]=$w1; //10
$w1 = maybe_inserted($w, 'и'); if ($w1) $s[]=$w1; //9
$w1 = maybe_inserted($w, 'е'); if ($w1) $s[]=$w1; //9
$w1 = maybe_inserted($w, 'д'); if ($w1) $s[]=$w1; //7
$w1 = maybe_inserted($w, 'з'); if ($w1) $s[]=$w1; //6
$w1 = maybe_inserted($w, 'а'); if ($w1) $s[]=$w1; //6
$w1 = maybe_inserted($w, 'ь'); if ($w1) $s[]=$w1; //5
$w1 = maybe_inserted($w, 'о'); if ($w1) $s[]=$w1; //5
$w1 = maybe_inserted($w, 'й'); if ($w1) $s[]=$w1; //5
$w1 = maybe_inserted($w, 'р'); if ($w1) $s[]=$w1; //2
$w1 = maybe_inserted($w, 'м'); if ($w1) $s[]=$w1; //2
$w1 = maybe_inserted($w, 'к'); if ($w1) $s[]=$w1; //2

$w1 = maybe_dropped($w, '-'); if ($w1) $s[]=$w1;
else { $w1 = maybe_2($w);  if ($w1) $s[]=$w1; }

return $s;

}

// връща правилно написана дума ако частта $f е написана неправилно като $t
function maybe_changed($w, $f, $t){
$p = 0;
$p = strpos($w,$t,$p);
while (!($p===false)){
  $p1 = $p+strlen($t);
  $r = substr($w,0,$p).$f.substr($w,$p1,strlen($w)-$p1);
  if (isCorrect($r)) return $r;
  $p = strpos($w,$t,$p+1);
//  echo "$w $f $t $p $p1 $r $p<br>";// die;
}
return '';
};

// връща правилно изписана дума, ако от нея е изпусната буквата $c
function maybe_dropped($w, $c){
for($i=0; $i<strlen($w); $i++){
  $w1 = substr($w,0,$i);
  $w2 = substr($w,$i);
  $w3 = "$w1$c$w2";
  if (isCorrect($w3)) return $w3;
}
return '';
};

// връща правилно изписана дума, ако в нея е вмъкната излишна буквата $c
function maybe_inserted($w, $c){
for($i=0; $i<strlen($w); $i++) if ($w[$i]==$c){
  $w1 = substr($w,0,$i).substr($w,$i+1);
  if (isCorrect($w1)) return $w1;
}
return '';
};

// открива думи, написани слято и ги добавя в глобалния масива $s
function maybe_2($w){
for($i=1; $i<strlen($w); $i++){
  $w1 = substr($w,0,$i);
  $w2 = substr($w,$i);
  if (isCorrect($w1) && isCorrect($w2)) return "$w1 $w2";
}
return '';
};

// връща думата изписана с гл.буква, ако трябва да се пише така
function maybe_up($w){
include_once("hlanguage.php");
$hlang = new HLanguage('bg');
if (!$w) return '';
if (array_key_exists($w[0],$hlang->uc_l)) $w = $hlang->uc_l[$w[0]].substr($w,1);
if (isCorrect($w)) return $w;
else return '';
};

?>
