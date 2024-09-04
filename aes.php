<?php
// Define a key and an IV (Initialization Vector)
define('AES_KEY', 'your-secret-key-here'); // Should be a 32-byte key for AES-256
define('AES_IV', 'your-iv-here-16b');      // Should be a 16-byte IV for AES-256

// Function to encrypt the password
function encryptPassword($password) {
    $cipher = "AES-256-CBC";
    $key = AES_KEY;
    $iv = AES_IV;
    
    $encrypted = openssl_encrypt($password, $cipher, $key, 0, $iv);
    return base64_encode($encrypted); // Base64 encode to make it URL safe
}

// Function to decrypt the password
function decryptPassword($encryptedPassword) {
    $cipher = "AES-256-CBC";
    $key = AES_KEY;
    $iv = AES_IV;
    
    $encryptedPassword = base64_decode($encryptedPassword); // Decode the base64 encoded string
    return openssl_decrypt($encryptedPassword, $cipher, $key, 0, $iv);
}

// Example usage
$plainPassword = "my_secure_password";
$encryptedPassword = encryptPassword($plainPassword);
echo "Encrypted Password: " . $encryptedPassword . "\n";

$decryptedPassword = decryptPassword($encryptedPassword);
echo "Decrypted Password: " . $decryptedPassword . "\n";
?>
