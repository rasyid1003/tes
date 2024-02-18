<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Token Verification</title>   
</head>
<body>
<?php
function generateToken($user) {
    if (!isset($_SESSION['tokens'][$user])) {
        $_SESSION['tokens'][$user] = array();
    }
    if (count($_SESSION['tokens'][$user]) >= 10) {
        array_shift($_SESSION['tokens'][$user]);
    }
    $token = bin2hex(random_bytes(16));
    $_SESSION['tokens'][$user][] = $token;
    return $token;
}
function verifyToken($user, $token) {
    if (isset($_SESSION['tokens'][$user])) {
        $index = array_search($token, $_SESSION['tokens'][$user]);
        if ($index !== false) {
            unset($_SESSION['tokens'][$user][$index]);
            return true;
        }
    }
    return false;
}
function cariToken($user) {
    if (isset($_SESSION['tokens'][$user])) {
        return $_SESSION['tokens'][$user];
    } else {
        return null;
    }
}
session_start();
if (isset($_POST['generate'])) {
    $user = "rasyid10";
    generateToken($user);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['token'])) {
        $tokenToVerify = $_POST['token'];
        $user = "rasyid10";
        $verificationResult = verifyToken($user, $tokenToVerify);
        if ($verificationResult) {
            echo '<div class="alert alert-success" role="alert">true</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">false</div>';
        }
    }
}
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
$tokenToVerify = $token1;
if (verifyToken($user, $tokenToVerify)) {
} else {   
}
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