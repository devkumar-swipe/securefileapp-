<?php
$baseDir = 'secfile';

function getFiles($dir) {
    $files = [];
    foreach (scandir($dir) as $file) {
        if ($file === '.' || $file === '..') continue;
        $filePath = $dir . '/' . $file;
        $fileType = mime_content_type($filePath);
        $files[] = [
            'file_name' => basename($filePath),
            'type' => $fileType,
        ];
    }
    return $files;
}

$audioFiles = getFiles($baseDir . '/audio');
$videoFiles = getFiles($baseDir . '/video');
$imageFiles = getFiles($baseDir . '/image');
$otherFiles = getFiles($baseDir . '/other');

$response = [
    'files' => array_merge($audioFiles, $videoFiles, $imageFiles, $otherFiles),
];

header('Content-Type: application/json');
echo json_encode($response);
?>
