<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Token Verification</title>
    
    
</head>
<body>

<?php
// Fungsi untuk menghasilkan token acak
function generateToken($user) {
    // Mengecek apakah user sudah memiliki array token
    if (!isset($_SESSION['tokens'][$user])) {
        $_SESSION['tokens'][$user] = array();
    }
    
    // Mengecek apakah user sudah memiliki maksimal 10 token
    if (count($_SESSION['tokens'][$user]) >= 10) {
        // Jika sudah, hapus token paling awal
        array_shift($_SESSION['tokens'][$user]);
    }
    
    // Menghasilkan token acak
    $token = bin2hex(random_bytes(16));
    
    // Menyimpan token ke dalam array
    $_SESSION['tokens'][$user][] = $token;
    
    // Mengembalikan token
    return $token;
}

// Fungsi untuk memverifikasi token
function verifyToken($user, $token) {
    // Mengecek apakah user memiliki array token
    if (isset($_SESSION['tokens'][$user])) {
        // Mencari index token yang sesuai
        $index = array_search($token, $_SESSION['tokens'][$user]);
        if ($index !== false) {
            // Menghapus token dari array
            unset($_SESSION['tokens'][$user][$index]);
            return true; // Token valid
        }
    }
    
    return false; // Token tidak valid
}

// Fungsi untuk mencari token berdasarkan user
function cariToken($user) {
    if (isset($_SESSION['tokens'][$user])) {
        return $_SESSION['tokens'][$user];
    } else {
        return null;
    }
}

// Inisialisasi session
session_start();

// Jika tombol "Generate Token" ditekan
if (isset($_POST['generate'])) {
    $user = "rasyid10"; // Ganti dengan username yang sesuai
    generateToken($user);
}

// Jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa apakah token dikirim melalui form
    if (isset($_POST['token'])) {
        $tokenToVerify = $_POST['token'];
        // Memverifikasi token
        $user = "rasyid10"; // Ganti dengan username yang sesuai
        $verificationResult = verifyToken($user, $tokenToVerify);
        if ($verificationResult) {
            echo '<div class="alert alert-success" role="alert">true</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">false</div>';
        }
    }
}

// Contoh penggunaan
$user = "rasyid10";
$token1 = generateToken($user);
$token2 = generateToken($user);

echo '<div class="container">';
echo '<h1>Generated Tokens</h1>';
echo '<ul class="list-group">';
echo '<li class="list-group-item">Token 1: ' . $token1 . '</li>';
echo '<li class="list-group-item">Token 2: ' . $token2 . '</li>';
echo '</ul>';
echo '</div>';

// Contoh verifikasi token
$tokenToVerify = $token1;
if (verifyToken($user, $tokenToVerify)) {
   
} else {
    
}

// Contoh pencarian token
$userToSearch = "rasyid10";
$tokens = cariToken($userToSearch);
if ($tokens !== null) {
    echo '<div class="container">';
    echo '<h2>Tokens for User: ' . $userToSearch . '</h2>';
    echo '<ul class="list-group">';
    foreach ($tokens as $token) {
        echo '<li class="list-group-item">' . $token . '</li>';
    }
    echo '</ul>';
    echo '</div>';
} else {
    echo '<div class="container">';
    echo '<div class="alert alert-warning" role="alert">';
    echo 'Tidak ada token untuk pengguna ' . $userToSearch . '.';
    echo '</div>';
    echo '</div>';
}
?>
<div class="container">
    <h1>Generate Token</h1>
    <form method="post" action="">
        <button type="submit" class="btn btn-primary" name="generate">Generate Token</button>
    </form>
</div>

<div class="container">
    <h1>Verify Your Token</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="token">Token:</label>
            <input type="text" class="form-control" id="token" name="token">
        </div>
        <button type="submit" class="btn btn-primary">Verify</button>
    </form>
</div>

</body>
</html>