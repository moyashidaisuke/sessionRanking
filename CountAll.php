<?php

// 全部とってくるよ
$sql = "select * from rankings";
//echo $sql;


$command = "mysql -u root session_ranking -N -e "."'".$sql."'";
exec($command, $result);


$count = array();
$songCount = 0;
foreach($result as $one) {
    $values = explode("\t", $one);
//    var_dump($values);
    $songCount ++;


    for($i = 0; $i < sizeof($values); $i++) {
        $value = $values[$i];
        // id、曲名等はスルー
        if ($i < 5) {
            continue;
        }
        if (!$value) {
            continue;
        }
        if ($value == "成立")  {
            continue;
        }
        if ($value == "なし")  {
            continue;
        }
        if ($value == "未エントリー") {
            continue;
        }
        if ($value == $searchName) {
            continue;
        }

        if (array_key_exists($value, $count)) {
            $count[$value] ++;
        } else {
            $count[$value] = 1;
        }
    }
}

arsort($count);

echo "全部カウントしてみたよ";
echo "曲数：". $songCount.PHP_EOL;
foreach($count as $name => $resultCount) {
    echo $name. " => ". $resultCount. PHP_EOL;
}