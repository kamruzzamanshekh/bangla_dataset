<?php
require_once('config.php');

function select_Function($table_Name){
  $statement = $db->prepare("SELECT * FROM pos_ner_tagger");
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}

 ?>
