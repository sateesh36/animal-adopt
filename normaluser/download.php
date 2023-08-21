<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: lognregister.php");
    exit;
}

if (isset($_GET['adoption_id'])) {
    $adoption_id = $_GET['adoption_id'];

    if (isset($_SESSION['file_path'][$adoption_id])) {
        $file_path = $_SESSION['file_path'][$adoption_id];

        if (file_exists($file_path)) {
            // Set the headers to force download
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));

            // Read the file and output its contents
            if (readfile($file_path) === false) {
                echo 'Failed to read file.';
                exit;
            }
            exit;
        } else {
            echo 'File not found.';
            exit;
        }
    } else {
        echo 'File path not found.';
        exit;
    }
} else {
    echo 'Adoption ID not found in the URL.';
    exit;
}
?>
