<?php require_once("controller.php")?>

<!DOCTYPE html>
<html>
    <head>
        <title>電卓test</title>
        <style>
            button {
                width: 40px;
            }
        </style>
    </head>
    <body>
        <h2>電卓test</h2>
        <h6><?php if(empty($displayNum)){echo "";}else{echo $displayNum;} ?></h6>
        <h3><?php if(empty($result)){echo 0;}else{echo $result;}  ; ?></h3>
        <form action="" method="post">
            <input type="hidden" name="displayNum" value="<?php echo $displayNum;?>"/>
            <input type="hidden" name="numList" value="<?php echo $numList;?>"/>
            <input type="hidden" name="num" value="<?php echo $num;?>"/>
            <input type="hidden" name="symbol" value="<?php echo $symbol;?>"/>
            <input type="hidden" name="prevBtn" value="<?php echo $prevBtn;?>"/>

            <table>
                <tr>
                    <td><button type="submit" name="button" value="%">%</button></td>
                    <td><button type="submit" name="ceBtn" value="CE">CE</button></td>
                    <td><button type="submit" name="button" value="C">C</button></td>
                    <td><button type="submit" name="button" value="/">÷</button></td>
                </tr>
                <tr>
                    <td><button type="submit" name="button" value="7">7</button></td>
                    <td><button type="submit" name="button" value="8">8</button></td>
                    <td><button type="submit" name="button" value="9">9</button></td>
                    <td><button type="submit" name="button" value="X">×</button></td>
                </tr>
                <tr>
                    <td><button type="submit" name="button" value="4">4</button></td>
                    <td><button type="submit" name="button" value="5">5</button></td>
                    <td><button type="submit" name="button" value="6">6</button></td>
                    <td><button type="submit" name="button" value="-">-</button></td>
                </tr>
                <tr>
                    <td><button type="submit" name="button" value="1">1</button></td>
                    <td><button type="submit" name="button" value="2">2</button></td>
                    <td><button type="submit" name="button" value="3">3</button></td>
                    <td><button type="submit" name="button" value="+">+</button></td>
                </tr>
                <tr>
                    <td><button type="submit" name="button" value="0">0</button></td>
                    <td><button type="submit" name="button" value=".">.</button></td>
                    <td><button type="submit" name="button" value="=">=</button></td>
                </tr>
            </table>
        </form>
    </body>
</html>