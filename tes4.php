<?php
function angka($arr) {
    
    if (count($arr) < 2) {
        return "Array harus memiliki minimal dua elemen";
    }
    rsort($arr);
    $angka = $arr[1];
    return $angka;
}
$array = array(10, 5, 8, 15, 3);
$angkavalue = angka($array);
echo "Nilai terbesar kedua dari array adalah: " . $angkavalue;
?>