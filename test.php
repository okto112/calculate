<!DOCTYPE html>
<html>
    <head>
        <title>電卓test</title>
        <style>
            button {
                width: 40px;
            }
            .rowspan {
                height: 50px;
            }
        </style>
    </head>
    <body>
        <h2>電卓test</h2>

        <?php
            $btnArry = ["AC", "(", ")", "/", "+/-", "%", "7", "8", "9", "x", "4", "5", "6", "-", "1", "2", "3", "+", "0", ".", "C", "="];
            
            $selectBtn = filter_input(INPUT_POST, 'button'); 
            $display = filter_input(INPUT_POST, 'display'); 
            $num = filter_input(INPUT_POST, 'num'); 
            $numList = filter_input(INPUT_POST, 'numList'); 
            $symbolList = filter_input(INPUT_POST, 'symbolList'); 
            $symSign = filter_input(INPUT_POST, 'symSign'); 

            if(isNumBtn($selectBtn)){
                $num .= $selectBtn;
                $symSign = true;
                $display = $display . $selectBtn;
            }elseif(isSymBtn($selectBtn)&&$symSign){
                $symbolList .= $selectBtn . ",";
                $numList .= $num . ",";
                $num = null;
                $symSign = false;
                $display = $display . $selectBtn;
            }elseif($selectBtn=="AC"){
                $display = "";
                $numList = "";
                $num = "";
                $symbolList = "";
                $symbol = false;
            }elseif($selectBtn=="=" && $numList!=""){
                $symbolList .= $selectBtn;
                $numList .= $num;
                $numArray = explode(",", $numList);
                $symArray = explode(",", $symbolList);
                
                if(in_array("/", $symArray)){
                    multiplyDivide("/");
                }

                if(in_array("x", $symArray)){
                    multiplyDivide("x");
                }

                if(count($numArray)>1){
                    for($i=0; $i<count($numArray); $i++){
                        $result = calculation($symArray[$i], $numArray[0], $numArray[1]);
                        array_splice($numArray, 0, 2, $result);
                    }
                }
                $display = $numArray[0];
                $numList = "";
                $symbolList = "";
                $numArray = "";
                $symArray = "";
            }

        function multiplyDivide($symbol){
            global $numArray;
            global $symArray;
            while(in_array($symbol, $symArray)){
                $symKey = array_search($symbol, $symArray);
                $result = calculation($symArray[$symKey], $numArray[$symKey], $numArray[$symKey+1]);
                array_splice($numArray, $symKey, 2, $result);
                array_splice($symArray, $symKey, 1);
            }
        }

        function calculation($symbol, $num1, $num2){
            switch($symbol){
                case "+":
                return $num1 + $num2;
                break;
                case "-":
                return $num1 - $num2;
                break;
                case "%":
                return $num1 % $num2;
                break;
                case "/":
                return $num1 / $num2;
                break;
                case "x":
                return $num1 * $num2;
                break;
            }
        }
            
        function isNumBtn($btn){
            if(is_numeric($btn)||$btn=="."){
                return true;
            }else{
                return false;
            }
        }

        function isSymBtn($btn){
            if($btn=="+"||$btn=="-"||$btn=="%"||$btn=="/"||$btn=="x"){
                return true;
            }else{
                return false;
            }
        }
        ?>

        <h3><?php if(empty($display)){echo 0;}else{echo $display;} ?></h3>
        <form action="" method="post">
            <input type="hidden" name="display" value="<?php echo $display;?>"/>
            <input type="hidden" name="num" value="<?php echo $num;?>"/>
            <input type="hidden" name="numList" value="<?php echo $numList;?>"/>
            <input type="hidden" name="symbolList" value="<?php echo $symbolList;?>"/>
            <input type="hidden" name="symSign" value="<?php echo $symSign;?>"/>

            <table>
                <?php
                    $btnNum=0;
                    echo "<tr>";
                    for ($row=1; $row <= 2 ; $row++) { 
                        if ($btnNum==0) {
                            for ($col=1; $col <= 4; $col++) { 
                                if($btnNum==0||$btnNum==3){
                                    echo "<td rowspan='2'><button type='submit' name='button' class='rowspan' value={$btnArry[$btnNum]}>{$btnArry[$btnNum]}</button></td>";
                                }else{
                                    echo "<td><button type='submit' name='button' value={$btnArry[$btnNum]}>{$btnArry[$btnNum]}</button></td>";
                                }
                                $btnNum++;
                            }
                        }else{
                            echo "<tr>";
                                for ($col=1; $col <= 2; $col++) { 
                                    echo "<td><button type='submit' name='button' value={$btnArry[$btnNum]}>{$btnArry[$btnNum]}</button></td>";
                                    $btnNum++;
                                }
                            echo "</tr>";
                        }
                    }
                    echo "</tr>";

                    for ($row=1; $row <= 4 ; $row++) { 
                        echo "<tr>";
                        for ($col=1; $col <= 4; $col++) { 
                            echo "<td><button type='submit' name='button' value={$btnArry[$btnNum]}>{$btnArry[$btnNum]}</button></td>";
                            $btnNum++;
                        }
                        echo "</tr>";
                    }
                ?>
            </table>
        </form>
    </body>
</html>