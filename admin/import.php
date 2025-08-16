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

        $count = 0;

        foreach ($data as $row) {
            if ($count == 0) {
                $count++;
                continue; // Skip header row
            }

            $participant_id    = $row['0'];
            $unhashed_password = $row['1'];
            $fullname          = $row['2'];

            $stmt = $conn->prepare("INSERT INTO participant (participant_id, password, fullname) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $participant_id, $unhashed_password, $fullname);
            $result = $stmt->execute();
            $count++;
        }
        header('Location: home.php');
    } else {
        $_SESSION['message'] = "Invalid File";
        header('Location: home.php');
        exit(0);
    }
}
