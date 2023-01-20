<?php
session_start();
require_once('database.php');
$pos1="";
$pos2="";
$pos3="";
$statement = $db->prepare("SELECT * FROM pos_ner where pos1!=? and pos2!=? and pos3!=?");
$db->set_charset('utf8mb4');
$statement->bindParam(1,$pos1);
$statement->bindParam(2,$pos2);
$statement->bindParam(3,$pos3);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

    $delimiter = ",";
    $filename = "bangladataset_" . date('Y-m-d') . ".csv";

    // Create a file pointer
    $f = fopen('php://memory', 'w');

    // Set column headers
    $fields = array('Line_No', 'W_id', 'word', 'POS', 'NER');
    fputcsv($f, $fields, $delimiter);

    // Output each row of the data, format line as csv and write to file pointer
    foreach($result as $row){
        $lineData = array($row['line_no'], $row['w_id'], $row['word'], $row['fpos'],$row['fner']);
        fputcsv($f, $lineData, $delimiter);
    }

    // Move back to beginning of file
    fseek($f, 0);

    // Set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer
    fpassthru($f);
exit;
?>
