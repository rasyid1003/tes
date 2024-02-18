<?php
function secondLargest($arr) {
    // Jika jumlah elemen array kurang dari 2, kembalikan pesan kesalahan
    if (count($arr) < 2) {
        return "Array harus memiliki minimal dua elemen";
    }
    
    // Urutkan array secara descending
    rsort($arr);
    
    // Ambil nilai terbesar kedua
    $secondLargest = $arr[1];
    
    return $secondLargest;
}

// Array dengan 5 integer acak
$array = array(10, 5, 8, 15, 3);

// Panggil fungsi secondLargest
$secondLargestValue = secondLargest($array);

// Tampilkan nilai terbesar kedua
echo "Nilai terbesar kedua dari array adalah: " . $secondLargestValue;
?>