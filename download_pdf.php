<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];

    // Check if file exists
    if (file_exists($file)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        readfile($file);
        exit;
    } else {
        echo "<script>
            alert('File not found.');
            window.history.back();
        </script>";
    }
}
?>
