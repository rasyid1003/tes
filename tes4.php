<?php
function secondLargest($arr) {
    
    if (count($arr) < 2) {
        return "Array harus memiliki minimal dua elemen";
    }
    rsort($arr);
    $secondLargest = $arr[1];
    return $secondLargest;
}
$array = array(10, 5, 8, 15, 3);
$secondLargestValue = secondLargest($array);
echo "Nilai terbesar kedua dari array adalah: " . $secondLargestValue;
?>