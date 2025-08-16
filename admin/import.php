<?php

require_once __DIR__ . '/includes/conn.php';
require_once __DIR__ . '/includes/session.php';
require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['save_import'])) {
    $fileName = $_FILES['importStudents']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['importStudents']['tmp_name'];
        $spreadsheet       = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data              = $spreadsheet->getActiveSheet()->toArray();

        foreach ($data as $row) {

            $participant_id        = strtoupper($row['0']);
            $unhashed_password = $row['1'];
            $fullname        = $row['2'];

            $studentQuery = "INSERT INTO participant (participant_id, password, fullname) VALUES ('$participant_id', '$unhashed_password', '$fullname')";
            $result       = mysqli_query($conn, $studentQuery);
        }
        header('Location: home.php');
    } else {
        $_SESSION['message'] = "Invalid File";
        header('Location: home.php');
        exit(0);
    }
}