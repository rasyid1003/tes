<?php
function karakter_terbanyak($kata) {
    $hitung = array();
    $panjang = strlen($kata);
    for ($i = 0; $i < $panjang; $i++) {
        $karakter = $kata[$i];
        if (isset($hitung[$karakter])) {
            $hitung[$karakter]++;
        } else {
            $hitung[$karakter] = 1;
        }
    }
    $karakter_max = '';
    $jumlah_max = 0;
    foreach ($hitung as $karakter => $jumlah) {
        if ($jumlah > $jumlah_max) {
            $karakter_max = $karakter;
            $jumlah_max = $jumlah;
        }
    }
    $output = "Karakter yang paling sering muncul dalam kata \"$kata\" adalah \"$karakter_max\" sebanyak $jumlah_max kali.";
    return $output;
}
echo karakter_terbanyak('wellcome');
echo karakter_terbanyak('strawberry');          
?>