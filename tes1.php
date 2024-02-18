<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Token Verification</title>
</head>
<body>
<?php
function buattoken($user) {
    if (!isset($_SESSION['token'][$user])) $_SESSION['token'][$user] = [];
    if (count($_SESSION['token'][$user]) >= 10) array_shift($_SESSION['token'][$user]);
    $token = bin2hex(random_bytes(16));
    $_SESSION['token'][$user][] = $token;
    return $token;
}

function cektoken($user, $token) {
    if (isset($_SESSION['token'][$user])) {
        $index = array_search($token, $_SESSION['token'][$user]);
        if ($index !== false) {
            unset($_SESSION['token'][$user][$index]);
            return true;
        }
    }
    return false;
}

function caritoken($user) {
    return $_SESSION['token'][$user] ?? null;
}

session_start();

if (isset($_POST['buattokenbaru'])) buattoken("rasyid10");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['token'])) {
        $cektoken = $_POST['token'];
        $lihattoken = cektoken("rasyid10", $cektoken);
        echo $lihattoken ? '<div>Valid</div>' : '<div>Invalid</div>';
    }
}

$token1 = buattoken("rasyid10");
$token2 = buattoken("rasyid10");

echo '<div>';
echo '<h1>Generated token</h1>';
echo '<ul>';
echo '<li>Token 1: ' . $token1 . '</li>';
echo '<li>Token 2: ' . $token2 . '</li>';
echo '</ul>';
echo '</div>';

$cektoken = $token1;

echo cektoken("rasyid10", $cektoken) ? '<div>Valid</div>' : '<div>Invalid</div>';

$token = caritoken("rasyid10");

echo '<div>';
if ($token !== null) {
    echo '<h2>token for User: rasyid10</h2>';
    echo '<ul>';
    foreach ($token as $token) {
        echo '<li>' . $token . '</li>';
    }
    echo '</ul>';
} else {
    echo '<div>No token for user rasyid10.</div>';
}
echo '</div>';
?>
<div>
    <h1>Generate Token</h1>
    <form method="post" action="">
        <button name="buattokenbaru">Generate Token</button>
    </form>
</div>

<div>
    <h1>Verify Your Token</h1>
    <form method="post" action="">
        <div>
            <label for="token">Token:</label>
            <input type="text" id="token" name="token">
        </div>
        <button>Verify</button>
    </form>
</div>

</body>
</html>
