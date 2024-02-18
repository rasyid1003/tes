<?php
function karakterTerbanyak($kata) {
    // Inisialisasi array untuk menyimpan jumlah kemunculan setiap karakter
    $count = array();

    // Menghitung kemunculan setiap karakter dalam kata
    $panjang = strlen($kata);
    for ($i = 0; $i < $panjang; $i++) {
        $karakter = $kata[$i];
        if (isset($count[$karakter])) {
            $count[$karakter]++;
        } else {
            $count[$karakter] = 1;
        }
    }

    // Mencari karakter dengan kemunculan paling banyak
    $maxKarakter = '';
    $maxJumlah = 0;
    foreach ($count as $karakter => $jumlah) {
        if ($jumlah > $maxJumlah) {
            $maxKarakter = $karakter;
            $maxJumlah = $jumlah;
        }
    }

    // Menghasilkan output sesuai format yang diminta
    $output = "Karakter yang paling sering muncul dalam kata \"$kata\" adalah \"$maxKarakter\" sebanyak $maxJumlah kali.";

    return $output;
}

// Contoh penggunaan
echo karakterTerbanyak('wellcome');
echo karakterTerbanyak('strawberry');
?>