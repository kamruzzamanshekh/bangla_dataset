<?php
session_start();
require_once('config.php');
  foreach ($pos_ner_table as $row) {
    $done=$row['done_by'];
    if($current_line==$row['line_no'])
    {
      if((strpos($done,$id)===false) && ($row['pos1']=="" || $row['pos2']=="" || $row['pos3']==""))
      {
        if($row['pos1']==""){$pos_col="pos1"; $ner_col="ner1";}
        elseif ($row['pos2']=="") {$pos_col="pos2"; $ner_col="ner2";}
        else{$pos_col="pos3"; $ner_col="ner3";}
        ?>
  <option value="<?php echo $row['w_id']."-".$pos_col."-".$ner_col."-".$done; ?>" class='text-success'><?php echo $row['word'];?></option>

<?php }
else {
  ?>

  <?php
}
}}?>
 ?>
