<?php
require_once('config.php');
//assign line RangeException
$assign_line="";
$assign_file="";
$id=$_SESSION['id'];
$statement_assign = $db->prepare("SELECT * FROM assign where c_id=?");
$statement_assign->bindParam(1,$id);
$statement_assign->execute();
$assign_table = $statement_assign->fetchAll(PDO::FETCH_ASSOC);
foreach ($assign_table as $row) {
  $assign_file=$row['file_name'];
  $assign_line=$row['assign_line'];
  break;
}

// echo $assign_file;
// echo $assign_line;
// print_r(explode("-",$assign_line));
$str=explode("-",$assign_line);
$l=$str[0];
$h=$str[1];


// word patch based on first assign file and lines
$p1="";
$p2="";
$p3="";
$statement = $db->prepare("SELECT * FROM pos_ner where file_name=? and line_no<=? and line_no>=?");
$statement->bindParam(1,$assign_file);
$statement->bindParam(2,$h);
$statement->bindParam(3,$l);
$statement->execute();
$pos_ner_table = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($pos_ner_table as $row) {
  $done=$row['done_by'];
    if((strpos($done,$id)===false) && ($row['pos1']=="" || $row['pos2']=="" || $row['pos3']==""))
    {
      $current_line=$row['line_no'];
      break;
    }
  }
  foreach ($pos_ner_table as $row) {
    if($current_line==$row['line_no'])
    {
      echo $row['word']." ";
    }
  }
  ?>
