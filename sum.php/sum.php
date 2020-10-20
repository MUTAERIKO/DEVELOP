<?php
// 1〜$max までを足して結果を返す関数
function sum($max) {
    $result = 0;

    // $i は1から始まり、$max より大きくなるまでループする
    for($i = 1; $i <= $max; $i++ ){
        $result += $i;
    }

    return $result;
}

// 関数を実行 //
echo sum(100);
?>



<?php
function kotae($num){
  $result = $num * 2;
  echo $result;
}
 echo kotae(5);
?>

<?php
function f($a,$b){
    $result = $a + $b;
    echo $result;
}
echo f(1,2);
?>

<?php
function total_Product($arr){
    $result = 1; 
    foreach($arr as $a){
        $result *= $a;
    }
    return $result;
}
    echo total_Product(array(1,3,5,7,9));
?>