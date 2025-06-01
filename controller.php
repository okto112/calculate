<?php
$button = filter_input(INPUT_POST, 'button'); 
$displayNum =  filter_input(INPUT_POST, 'displayNum');
$numList =  filter_input(INPUT_POST, 'numList');
$num = filter_input(INPUT_POST, 'num');
$symbol = filter_input(INPUT_POST, 'symbol');
$ceBtn = filter_input(INPUT_POST, 'ceBtn');
$prevBtn = filter_input(INPUT_POST, 'prevBtn');
$result = 0;
$symSign = false;


if(empty($ceBtn)){
  $displayNum = $displayNum . $button;
  $prevBtn = $button;
}

if(isNumBtn($button)){
  $num = $num . $button;
}elseif(isSymBtn($button)){
  if(empty($symbol)){
    $symbol = $button;
    $numList = $num;
    $num = null;
  }else{
    $symSign = true;
  }
}elseif($button=="C"){
  $displayNum = "";
  $numList = "";
  $num = "";
  $symbol = "";
  $result = "";
}elseif($ceBtn=="CE"&&isNumBtn($prevBtn)){
  $displayNum = substr($displayNum, 0, -1);
  $num = substr($num, 0, -1);
  $prevBtn = substr($displayNum, -1);
}

if(strlen($displayNum)==1&&(isSymBtn($displayNum)||$displayNum=="."||$displayNum=="=")){
  $displayNum = "";
  $numList = "";
  $num = "";
  $symbol = "";
  $result = "";
}elseif($symSign||!empty($symbol)&&!empty($num)&&$button=="="){
  switch($symbol){
    case "+":
      $numList =  $numList + $num;
      $num = "";
      break;
    case "-":
      $numList =  $numList - $num;
      $num = "";
      break;
    case "%":
      $numList =  $numList % $num;
      $num = "";
      break;
    case "/":
      $numList =  $numList / $num;
      $num = "";
      break;
    case "X":
      $numList =  $numList * $num;
      $num = "";
      break;
  }
  $symbol = $button;
  if($symSign){
    $displayNum = $numList . $symbol;
    $symSign = false;
  }
}

$result = $numList;

function isNumBtn($btn){
  if($btn=="0"||$btn=="1"||$btn=="2"||$btn=="3"||$btn=="4"||$btn=="5"||$btn=="6"||$btn=="7"||$btn=="8"||$btn=="9"||$btn=="."){
    return true;
  }else{
    return false;
  }
}

function isSymBtn($btn){
  if($btn=="+"||$btn=="-"||$btn=="%"||$btn=="/"||$btn=="X"){
    return true;
  }else{
    return false;
  }
}
