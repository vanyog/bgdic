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


$w1 = maybe_changed($w, 'у', 'о'); if ($w1) $s[]=$w1; //188 авгост
$w1 = maybe_changed($w, 'о', 'у'); if ($w1) $s[]=$w1; //171 автокузметик
$w1 = maybe_changed($w, 'ъ', 'а'); if ($w1) $s[]=$w1; //119 аганце
$w1 = maybe_changed($w, 'а', 'ъ'); if ($w1) $s[]=$w1; //83 бакълавър
$w1 = maybe_changed($w, 'е', 'и'); if ($w1) $s[]=$w1; //74 автотенекиджийски
$w1 = maybe_changed($w, 'и', 'е'); if ($w1) $s[]=$w1; //59 аперетив
$w1 = maybe_changed($w, 'з', 'с'); if ($w1) $s[]=$w1; //46 автосервис
$w1 = maybe_changed($w, 'е', 'я'); if ($w1) $s[]=$w1; //40 англоговорящ
$w1 = maybe_changed($w, 'с', 'з'); if ($w1) $s[]=$w1; //33 визкозитет
$w1 = maybe_changed($w, 'й', 'и'); if ($w1) $s[]=$w1; //31 воивода
$w1 = maybe_changed($w, 'д', 'т'); if ($w1) $s[]=$w1; //31 арента
$w1 = maybe_changed($w, 'а', 'я'); if ($w1) $s[]=$w1; //26 айрян
$w1 = maybe_changed($w, 'и', 'й'); if ($w1) $s[]=$w1; //23 батерий
$w1 = maybe_changed($w, 'я', 'а'); if ($w1) $s[]=$w1; //21 взаимоотношениа
$w1 = maybe_changed($w, 'т', 'д'); if ($w1) $s[]=$w1; //20 бисквидена
$w1 = maybe_changed($w, 'я', 'е'); if ($w1) $s[]=$w1; //19 влекъл
$w1 = maybe_changed($w, 'в', 'ф'); if ($w1) $s[]=$w1; //19 фсичко
$w1 = maybe_changed($w, 'ф', 'в'); if ($w1) $s[]=$w1; //14 автограв
$w1 = maybe_changed($w, 'а', 'е'); if ($w1) $s[]=$w1; //12 апендисит
$w1 = maybe_changed($w, 'щ', 'шт'); if ($w1) $s[]=$w1; //11 зашто
$w1 = maybe_changed($w, 'е', 'а'); if ($w1) $s[]=$w1; //11 весал
$w1 = maybe_changed($w, 'щ', 'ш'); if ($w1) $s[]=$w1; //9 къшен
$w1 = maybe_changed($w, 'ш', 'ж'); if ($w1) $s[]=$w1; //9 автовижка
$w1 = maybe_changed($w, 'к', 'г'); if ($w1) $s[]=$w1; //9 анегдот
$w1 = maybe_changed($w, 'ь', 'й'); if ($w1) $s[]=$w1; //8 асансйор
$w1 = maybe_changed($w, 'ж', 'ш'); if ($w1) $s[]=$w1; //8 белешка
$w1 = maybe_changed($w, 'г', 'к'); if ($w1) $s[]=$w1; //8 белек
$w1 = maybe_changed($w, 'а', 'о'); if ($w1) $s[]=$w1; //8 кото
$w1 = maybe_changed($w, 'б', 'п'); if ($w1) $s[]=$w1; //7 апсцес
$w1 = maybe_changed($w, 'ь', 'и'); if ($w1) $s[]=$w1; //6 Валио
$w1 = maybe_changed($w, 'ъ', 'ь'); if ($w1) $s[]=$w1; //6 зорьк
$w1 = maybe_changed($w, 'о', 'и'); if ($w1) $s[]=$w1; //6 кинезитерапевт
$w1 = maybe_changed($w, 'н', 'м'); if ($w1) $s[]=$w1; //6 бемка
$w1 = maybe_changed($w, 'м', 'н'); if ($w1) $s[]=$w1; //6 бонбардира
$w1 = maybe_changed($w, 'иа', 'я'); if ($w1) $s[]=$w1; //6 вегетарянска
$w1 = maybe_changed($w, 'я', 'ъ'); if ($w1) $s[]=$w1; //5 зетът
$w1 = maybe_changed($w, 'ь', 'ъ'); if ($w1) $s[]=$w1; //5 амортисъори
$w1 = maybe_changed($w, 'й', 'ь'); if ($w1) $s[]=$w1; //5 Българиьо
$w1 = maybe_changed($w, 'ръ', 'ър'); if ($w1) $s[]=$w1; //4 гърк
$w1 = maybe_changed($w, 'п', 'б'); if ($w1) $s[]=$w1; //4 гибс
$w1 = maybe_changed($w, 'обу', 'убо'); if ($w1) $s[]=$w1; //4 неубоздан
$w1 = maybe_changed($w, 'о', 'а'); if ($w1) $s[]=$w1; //4 бежав
$w1 = maybe_changed($w, 'а', 'и'); if ($w1) $s[]=$w1; //4 вслушило
$w1 = maybe_changed($w, 'ъ', 'о'); if ($w1) $s[]=$w1; //3 возкресе
$w1 = maybe_changed($w, 'ц', 'с'); if ($w1) $s[]=$w1; //3 инжексия
$w1 = maybe_changed($w, 'у', 'ю'); if ($w1) $s[]=$w1; //3 кюртоазия
$w1 = maybe_changed($w, 'у', 'от'); if ($w1) $s[]=$w1; //3 отдържам
$w1 = maybe_changed($w, 'тс', 'ц'); if ($w1) $s[]=$w1; //3 децка
$w1 = maybe_changed($w, 'с', 'ц'); if ($w1) $s[]=$w1; //3 отцъствам
$w1 = maybe_changed($w, 'р', 'л'); if ($w1) $s[]=$w1; //3 болдюри
$w1 = maybe_changed($w, 'осигу', 'усиго'); if ($w1) $s[]=$w1; //3 усигори
$w1 = maybe_changed($w, 'ор', 'ре'); if ($w1) $s[]=$w1; //3 метереология
$w1 = maybe_changed($w, 'к', 'ч'); if ($w1) $s[]=$w1; //3 влечат
$w1 = maybe_changed($w, 'и', 'ь'); if ($w1) $s[]=$w1; //3 интерьор
$w1 = maybe_changed($w, 'и', 'о'); if ($w1) $s[]=$w1; //3 автомоболистите
$w1 = maybe_changed($w, 'и', 'а'); if ($w1) $s[]=$w1; //3 аператив
$w1 = maybe_changed($w, 'е', 'ъ'); if ($w1) $s[]=$w1; //3 отвъргнат
$w1 = maybe_changed($w, 'е', 'у'); if ($w1) $s[]=$w1; //3 паужини
$w1 = maybe_changed($w, 'е', 'о'); if ($w1) $s[]=$w1; //3 адаптор
$w1 = maybe_changed($w, 'г', 'х'); if ($w1) $s[]=$w1; //3 контрахент
$w1 = maybe_changed($w, 'язо', 'езна'); if ($w1) $s[]=$w1; //2 излезнах
$w1 = maybe_changed($w, 'я', 'иа'); if ($w1) $s[]=$w1; //2 акомпаниатор
$w1 = maybe_changed($w, 'ю', 'у'); if ($w1) $s[]=$w1; //2 лубов
$w1 = maybe_changed($w, 'ьо', 'ю'); if ($w1) $s[]=$w1; //2 кюше
$w1 = maybe_changed($w, 'ър', 'ръ'); if ($w1) $s[]=$w1; //2 гръка
$w1 = maybe_changed($w, 'ъз', 'ос'); if ($w1) $s[]=$w1; //2 воскресе
$w1 = maybe_changed($w, 'ъз', 'а'); if ($w1) $s[]=$w1; //2 вастановен
$w1 = maybe_changed($w, 'ъ', 'я'); if ($w1) $s[]=$w1; //2 катинарят
$w1 = maybe_changed($w, 'ъ', 'е'); if ($w1) $s[]=$w1; //2 мениджер
$w1 = maybe_changed($w, 'ш', 'щ'); if ($w1) $s[]=$w1; //2 потърпевщ
$w1 = maybe_changed($w, 'ц', 'чк'); if ($w1) $s[]=$w1; //2 именничка
$w1 = maybe_changed($w, 'ц', 'тс'); if ($w1) $s[]=$w1; //2 отселеем
$w1 = maybe_changed($w, 'усло', 'ослу'); if ($w1) $s[]=$w1; //2 обослувени
$w1 = maybe_changed($w, 'ури', 'юр'); if ($w1) $s[]=$w1; //2 абитюрент
$w1 = maybe_changed($w, 'уржо', 'оржу'); if ($w1) $s[]=$w1; //2 боржуазен
$w1 = maybe_changed($w, 'ул', 'лу'); if ($w1) $s[]=$w1; //2 склуптор
$w1 = maybe_changed($w, 'у', 'л'); if ($w1) $s[]=$w1; //2 валчер
$w1 = maybe_changed($w, 'ст', 'з'); if ($w1) $s[]=$w1; //2 велосипедиз
$w1 = maybe_changed($w, 'ръ', 'ар'); if ($w1) $s[]=$w1; //2 подсмаркна
$w1 = maybe_changed($w, 'оу', 'уо'); if ($w1) $s[]=$w1; //2 двуомях
$w1 = maybe_changed($w, 'от', 'у'); if ($w1) $s[]=$w1; //2 учайване
$w1 = maybe_changed($w, 'ор', 'ри'); if ($w1) $s[]=$w1; //2 метериологични
$w1 = maybe_changed($w, 'око', 'уку'); if ($w1) $s[]=$w1; //2 кукушарник
$w1 = maybe_changed($w, 'ов', 'во'); if ($w1) $s[]=$w1; //2 удволетворена
$w1 = maybe_changed($w, 'о', 'ъ'); if ($w1) $s[]=$w1; //2 отнесъх
$w1 = maybe_changed($w, 'о', 'е'); if ($w1) $s[]=$w1; //2 невини
$w1 = maybe_changed($w, 'но-', 'о'); if ($w1) $s[]=$w1; //2 миногеоложки
$w1 = maybe_changed($w, 'ка', 'чъ'); if ($w1) $s[]=$w1; //2 влечът
$w1 = maybe_changed($w, 'йе', 'и'); if ($w1) $s[]=$w1; //2 ироглифи
$w1 = maybe_changed($w, 'иц', 'ничк'); if ($w1) $s[]=$w1; //2 рожденничка
$w1 = maybe_changed($w, 'ий', 'йи'); if ($w1) $s[]=$w1; //2 измйи
$w1 = maybe_changed($w, 'иден', 'еди'); if ($w1) $s[]=$w1; //2 конфедициална
$w1 = maybe_changed($w, 'иде', 'еди'); if ($w1) $s[]=$w1; //2 единтичен
$w1 = maybe_changed($w, 'ече', 'яка'); if ($w1) $s[]=$w1; //2 навлякан
$w1 = maybe_changed($w, 'еле', 'или'); if ($w1) $s[]=$w1; //2 тилифон
$w1 = maybe_changed($w, 'е', 'й'); if ($w1) $s[]=$w1; //2 крайсловие
$w1 = maybe_changed($w, 'вт', 'ф'); if ($w1) $s[]=$w1; //2 космонаф
$w1 = maybe_changed($w, 'в', 'ж'); if ($w1) $s[]=$w1; //2 умилостивяжам
$w1 = maybe_changed($w, ' пъ', 'па'); if ($w1) $s[]=$w1; //2 двапати

$w1 = maybe_dropped($w, 'т'); if ($w1) $s[]=$w1; //76 абитуренска
$w1 = maybe_dropped($w, 'н'); if ($w1) $s[]=$w1; //34 аглосаксонец
$w1 = maybe_dropped($w, 'с'); if ($w1) $s[]=$w1; //25 безмислен
$w1 = maybe_dropped($w, 'и'); if ($w1) $s[]=$w1; //21 абитурент
$w1 = maybe_dropped($w, 'з'); if ($w1) $s[]=$w1; //18 безрасъдно
$w1 = maybe_dropped($w, 'в'); if ($w1) $s[]=$w1; //16 безнраствен
$w1 = maybe_dropped($w, 'д'); if ($w1) $s[]=$w1; //14 ланшафти
$w1 = maybe_dropped($w, 'й'); if ($w1) $s[]=$w1; //13 Асберг
$w1 = maybe_dropped($w, 'о'); if ($w1) $s[]=$w1; //11 бельто
$w1 = maybe_dropped($w, 'а'); if ($w1) $s[]=$w1; //11 безопсност
$w1 = maybe_dropped($w, 'е'); if ($w1) $s[]=$w1; //9 вашто
$w1 = maybe_dropped($w, 'ъ'); if ($w1) $s[]=$w1; //6 калдръмче
$w1 = maybe_dropped($w, 'у'); if ($w1) $s[]=$w1; //5 вакум
$w1 = maybe_dropped($w, 'р'); if ($w1) $s[]=$w1; //5 кренвиш
$w1 = maybe_dropped($w, 'л'); if ($w1) $s[]=$w1; //5 мекопреработка
$w1 = maybe_dropped($w, 'ва'); if ($w1) $s[]=$w1; //5 оценяш
$w1 = maybe_dropped($w, 'к'); if ($w1) $s[]=$w1; //4 випусник
$w1 = maybe_dropped($w, 'м'); if ($w1) $s[]=$w1; //3 имоходом
$w1 = maybe_dropped($w, 'ь'); if ($w1) $s[]=$w1; //2 пеноар
$w1 = maybe_dropped($w, 'п'); if ($w1) $s[]=$w1; //2 предриемам

$w1 = maybe_inserted($w, 'т'); if ($w1) $s[]=$w1; //50 безопастна
$w1 = maybe_inserted($w, 'н'); if ($w1) $s[]=$w1; //50 анцунг
$w1 = maybe_inserted($w, 'с'); if ($w1) $s[]=$w1; //27 безспокоен
$w1 = maybe_inserted($w, 'е'); if ($w1) $s[]=$w1; //13 играеме
$w1 = maybe_inserted($w, 'в'); if ($w1) $s[]=$w1; //13 абонирвам
$w1 = maybe_inserted($w, 'д'); if ($w1) $s[]=$w1; //12 надвечерието
$w1 = maybe_inserted($w, 'и'); if ($w1) $s[]=$w1; //11 аналии
$w1 = maybe_inserted($w, 'ь'); if ($w1) $s[]=$w1; //8 аранжьор
$w1 = maybe_inserted($w, 'о'); if ($w1) $s[]=$w1; //8 кириолица
$w1 = maybe_inserted($w, 'й'); if ($w1) $s[]=$w1; //7 анийон
$w1 = maybe_inserted($w, 'з'); if ($w1) $s[]=$w1; //7 възстанал
$w1 = maybe_inserted($w, 'а'); if ($w1) $s[]=$w1; //7 габарова
$w1 = maybe_inserted($w, 'р'); if ($w1) $s[]=$w1; //3 вдрругиден
$w1 = maybe_inserted($w, 'м'); if ($w1) $s[]=$w1; //3 имме
$w1 = maybe_inserted($w, 'л'); if ($w1) $s[]=$w1; //3 паралелелпипед
$w1 = maybe_inserted($w, 'к'); if ($w1) $s[]=$w1; //3 мяткам
$w1 = maybe_inserted($w, 'ф'); if ($w1) $s[]=$w1; //2 евфтаназия

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
