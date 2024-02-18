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
    $maxKarakter = '';
    $maxJumlah = 0;
    foreach ($count as $karakter => $jumlah) {
        if ($jumlah > $maxJumlah) {
            $maxKarakter = $karakter;
            $maxJumlah = $jumlah;
        }
    }
    $output = "Karakter yang paling sering muncul dalam kata \"$kata\" adalah \"$maxKarakter\" sebanyak $maxJumlah kali.";

    return $output;
}
echo karakterTerbanyak('wellcome');
echo karakterTerbanyak('strawberry');
?>