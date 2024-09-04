<?php
// Define the directories
$baseDir = 'secfile';
$imageDir = $baseDir . '/image';
$audioDir = $baseDir . '/audio';
$videoDir = $baseDir . '/video';
$otherDir = $baseDir . '/other';

// Create the directories if they don't exist
if (!file_exists($baseDir)) {
    mkdir($baseDir, 0777, true);
}
if (!file_exists($imageDir)) {
    mkdir($imageDir, 0777, true);
}
if (!file_exists($audioDir)) {
    mkdir($audioDir, 0777, true);
}
if (!file_exists($videoDir)) {
    mkdir($videoDir, 0777, true);
}
if (!file_exists($otherDir)) {
    mkdir($otherDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = basename($file['name']);
    $fileType = $file['type'];
    $targetDir = '';

    // Determine the target directory based on the file type
    if (strpos($fileType, 'image') === 0) {
        $targetDir = $imageDir;
    } elseif (strpos($fileType, 'audio') === 0) {
        $targetDir = $audioDir;
    } elseif (strpos($fileType, 'video') === 0) {
        $targetDir = $videoDir;
    } else {
        $targetDir = $otherDir;
    }

    $targetFile = $targetDir . '/' . $fileName;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        echo '<script>alert("Your files are successfully uploaded to the SecFile app."); window.location.href = "upload.html";</script>';
    } else {
        echo '<script>alert("Sorry, there was an error uploading your file."); window.location.href = "upload.html";</script>';
    }
} else {
    echo '<script>alert("No file uploaded."); window.location.href = "upload.html";</script>';
}
?>
