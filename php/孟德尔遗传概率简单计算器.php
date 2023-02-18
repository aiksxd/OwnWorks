<html>
    <head>
        <style type="text/css">
        .seed {width:32px;}
</style>
    </head>
    <hody>
        <h2>孟德尔遗传简单计算</h2>
        <form method="get" id="form">
        <h3>性状1</h3>
        AA显性表现型：<input type="text" name="Dtrait1" value="黄色"></br>
        aa 隐性表现型：<input type="text" name="Rtrait1" value="绿色"></br>
        Aa杂合子表现型(选填)：<input type="text" name="DRtrait1"></br>
        父本<input type="radio" name="T1" value="AA">AA<input type="radio" name="T1" value="Aa">Aa<input type="radio" name="T1" value="aa">aa</br>
        母本<input type="radio" name="T01" value="AA">AA<input type="radio" name="T01" value="Aa">Aa<input type="radio" name="T01" value="aa">aa</br>
        <details>
            <summary>更多选项</summary>
            <ol>
                <li>雌性杂合子表现型(选填)：<input type="text" name="DRhand01"></li>
                <li>雌性配子/受精卵成活率：A<input class="seed" type="text" name="01A" value="100">%；a<input class="seed" type="text" name="01a" value="100">%；AA<input class="seed" type="text" name="01AA" value="100">%；Aa<input class="seed" type="text" name="01Aa" value="100">%；aa<input class="seed" class="seed" type="text" name="01aa" value="100">%</li>
                <li>雄性杂合子表现型(选填)：<input type="text" name="DRhand1"></li>
                <li>雄性配子/受精卵成活率：A<input class="seed" type="text" name="1A" value="100">%；a<input class="seed" type="text" name="1a" value="100">%；AA<input class="seed" type="text" name="1AA" value="100">%；Aa<input class="seed" type="text" name="1Aa" value="100">%；aa<input class="seed" class="seed" type="text" name="1aa" value="100">%</li>
            </ol>
        </details>
        <h3>性状2</h3>
        启用第二BB性状（不选不会计算）：<input type="radio" name="second"><br>
        BB显性表现型：<input type="text" name="Dtrait2" value="圆粒"></br>
        bb 隐性表现型：<input type="text" name="Rtrait2" value="皱粒"></br>
        Bb杂合子表现型(选填)：<input type="text" name="DRtrait2"></br>
        父本<input type="radio" name="T2" value="BB">BB<input type="radio" name="T2" value="Bb">Bb<input type="radio" name="T2" value="bb">bb</br>
        母本<input type="radio" name="T02" value="BB">BB<input type="radio" name="T02" value="Bb">Bb<input type="radio" name="T02" value="bb">bb</br>
        <details>
            <summary>更多选项</summary>
            <ol>
                <li>雌性杂合子表现型(选填)：<input type="text" name="DRhand02"></li>
                <li>雌性配子/受精卵成活率：B<input class="seed" type="text" name="02B" value="100" value="100">%；b<input class="seed" type="text" name="02b" value="100" value="100">%；BB<input class="seed" type="text" name="02BB" value="100" value="100">%；Bb<input class="seed" type="text" name="02Bb" value="100">%；bb<input class="seed" type="text" name="02bb" value="100">%</li>
                <li>雄性杂合子表现型(选填)：<input type="text" name="DRhand1"></li>
                <li>雄性配子/受精卵成活率：B<input class="seed" type="text" name="2B" value="100">%；b<input class="seed" type="text" name="2b" value="100">%；BB<input class="seed" type="text" name="2BB" value="100">%；Bb<input class="seed" type="text" name="2Bb" value="100">%；bb<input class="seed" type="text" name="2bb"a value="100">%</li>
            </ol>
        </details>
        <input type="submit" value="提交并输出结果" name="result">
        </form>
    </body>
</html>

<?php
    if($_GET["result"]){
        result();
    }
    function result(){
    $Dtrait1 = $_GET["Dtrait1"];
    $Rtrait1 = $_GET["Rtrait1"];
    if($_GET["DRtrait1"]){
        $DRtrait1 = $_GET["DRtrait1"];
    }else{
        $DRtrait1 = $_GET["Dtrait1"];
    }
    echo "性状一：AA表现型：$Dtrait1"."；aa表现型：$Rtrait1"."；Aa表现型：$DRtrait1"."</br>";
    $T1a=0;$T1A=0;$T01a=0;$T01A=0;
    $T1 = $_GET["T1"];   //T1是父本表单提交的基因组成
    switch($T1){
        case "AA":
            $T1A = 2*($_GET["1A"]/100);
            break;
        case "Aa":
            $T1A = 1*($_GET["1A"]/100);
            $T1a = 1*($_GET["1a"]/100);
            break;
        case "aa":
            $T1a = 2*($_GET["1a"]/100); 
            break;
    }
    $T01 = $_GET["T01"];
    switch($T01){
        case "AA":
            $T01A = 2*($_GET["01A"]/100);
            break;
        case "Aa":
            $T01A = 1*($_GET["01A"]/100);
            $T01a = 1*($_GET["1a"]/100);
            break;
        case "aa":
            $T01a = 2*($_GET["1a"]/100);
            break; 
    }
    echo "父本A的数量为$T1A"."；a的数量为$T1a"."</br>";
    echo "母本A的数量为$T01A"."；a的数量为$T01a"."</br>";
    $sumT1F1 = $T1A + $T1a;
    $sumT1F01 = $T01A + $T01a;
    $T1F1AA = 0.5*($T1A / $sumT1F1) * ($T01A / $sumT1F01)*($_GET["1AA"]/100);   //雄性子一代AA性状概率
    $T1F01AA = 0.5*($T1A / $sumT1F1) * ($T01A / $sumT1F01)*($_GET["01AA"]/100);   //雌性子一代AA性状概率
    $T1F1Aa = 0.5*($T1A/$sumT1F1 * $T01a/$sumT1F01 + $T1a/$sumT1F1 * $T01A/$sumT1F01)*($_GET["1Aa"]/100);
    $T1F01Aa = 0.5*($T1A/$sumT1F1 * $T01a/$sumT1F01 + $T1a/$sumT1F1 * $T01A/$sumT1F01)*($_GET["01Aa"]/100);
    $T1F1aa = 0.5*($T1a/$sumT1F1 * $T01a/$sumT1F01)*($_GET["1aa"]/100);
    $T1F01aa = 0.5*($T1a/$sumT1F1 * $T01a/$sumT1F01)*($_GET["01aa"]/100);
    $T1F1AAsum = $T1F1AA + $T1F01AA;$T1F1Aasum = $T1F1Aa + $T1F01Aa;$T1F1aasum = $T1F1aa + $T1F01aa;
    echo "雄性子一代AA的概率为$T1F1AA"."；雄性子一代Aa的概率为$T1F1Aa"."；雄性子一代aa的概率为$T1F1aa </br>";
    echo "雌性子一代AA的概率为$T1F01AA"."；雌性子一代Aa的概率为$T1F01Aa"."；雌性子一代aa的概率为$T1F01aa </br>";
    echo "子一代AA的概率为$T1F1AAsum"."；子一代Aa的概率为$T1F1Aasum"."；子一代aa的概率为$T1F1aasum </br>";
    if($_GET["second"] == "on"){  //第二性状叠加计算
        $Dtrait2 = $_GET["Dtrait2"];
        $Rtrait2 = $_GET["Rtrait2"];
        if($_GET["DRtrait2"]){
            $DRtrait2 = $_GET["DRtrait2"];
        }else{
            $DRtrait2 = $_GET["Dtrait2"];
        }
        echo "性状二：BB表现型：$Dtrait2"."；bb表现型：$Rtrait2"."；Bb表现型：$DRtrait2"."</br>";
        $T2b=0;$T2B=0;$T02b=0;$T02B=0;
        $T2 = $_GET["T2"];   //T1是父本表单提交的基因组成
        switch($T2){
            case "BB":
                $T2B = 2*($_GET["2B"]/100);
                break;
            case "Bb":
                $T2B = 1*($_GET["2B"]/100);
                $T2b = 1*($_GET["2b"]/100);
                break;
            case "bb":
                $T2b = 2*($_GET["2b"]/100);
                break;
        }
        $T02 = $_GET["T02"];
        switch($T02){
            case "BB":
                $T02B = 2*($_GET["02B"]/100);
                break;
            case "Bb":
                $T02B = 1*($_GET["02B"]/100);
                $T02b = 1*($_GET["02b"]/100);
                break;
            case "bb":
                $T02b = 2*($_GET["02b"]/100); 
                break;
        }
        echo "父本B的数量为$T2B"."；b的数量为$T2b"."</br>";
        echo "母本B的数量为$T02B"."；b的数量为$T02b"."</br>";
        $sumT2F1 = $T2B + $T2b;
        $sumT2F01 = $T02B + $T02b;
        $T2F1BB = 0.5*($T2B / $sumT2F1) * ($T02B / $sumT2F01)*($_GET["2BB"]/100);   //雄性子一代BB性状概率
        $T2F01BB = 0.5*($T2B / $sumT2F1) * ($T02B / $sumT2F01)*($_GET["02BB"]/100);   //雌性子一代BB性状概率
        $T2F1Bb = 0.5*($T2B/$sumT2F1 * $T02b/$sumT2F01 + $T2b/$sumT2F1 * $T02B/$sumT2F01)*($_GET["2Bb"]/100);
        $T2F01Bb = 0.5*($T2B/$sumT2F1 * $T02b/$sumT2F01 + $T2b/$sumT2F1 * $T02B/$sumT2F01)*($_GET["02Bb"]/100);
        $T2F1bb = 0.5*($T2b/$sumT2F1 * $T02b/$sumT2F01)*($_GET["2bb"]/100);
        $T2F01bb = 0.5*($T2b/$sumT2F1 * $T02b/$sumT2F01)*($_GET["02bb"]/100);
        $T2F1BBsum = $T2F1BB + $T2F01BB;$T2F1Bbsum = $T2F1Bb + $T2F01Bb;$T2F1bbsum = $T2F1bb + $T2F01bb;
        //双性状组合
        $F1AABB = $T1F1AAsum *$T2F1BBsum;  $F1AABb = $T1F1AAsum *$T2F1Bbsum;  $F1AAbb = $T1F1AAsum *$T2F1bbsum;
        $F1AaBB = $T1F1Aasum *$T2F1BBsum;  $F1AaBb = $T1F1Aasum *$T2F1Bbsum;  $F1Aabb = $T1F1Aasum *$T2F1bbsum;
        $F1aaBB = $T1F1aasum *$T2F1BBsum;  $F1aaBb = $T1F1AAsum *$T2F1Bbsum;  $F1aabb = $T1F1aasum *$T2F1bbsum;
        echo "</br>-------------------------</br>";
        echo "性状一二组合：AABB表现型：$Dtrait1$Dtrait2"."；aabb表现型：$Rtrait1$Rtrait2"."；AaBb表现型：$DRtrait1$DRtrait2"."</br>";
        echo "性状组合概率：</br>AABB：$F1AABB ；AABb：$F1AABb ；AAbb：$F1AAbb <br>AaBB：$F1AaBB ；AaBb：$F1AaBb ；Aabb：$F1Aabb <br>aaBB：$F1aaBB ；aaBb：$F1aaBb ；aabb：$F1aabb </br>";
        //if(!$_GET["DRtrait1"]){  //不道这里与逻辑为什么抛异常
        $F1AAaBBb = $F1AABB + $F1AABb + $F1AaBB + $F1AaBb;
        $F1AAabb = $F1AAbb + $F1Aabb;
        $F1aaBBb = $F1aaBB + $F1aaBb;
        echo "$Dtrait1$Dtrait2 （A/AaB/Bb）：$F1AAaBBb ；$Dtrait1$Rtrait2 （A/Aabb）：$F1AAabb ；$Rtrait1$Dtrait2 （aaB/Bb）：$F1aaBBb ；$Rtrait1$Rtrait2 （aabb）：$F1aabb";
        //}

    }
    };
?>
