<?php
require_once('database.php');
if(isset($_POST["selected_file"])){
//     // Capture selected country
    $files = $_POST["selected_file"];
    $contributor_id=$_POST['contributor_id'];
    // $contributor_id=3;
//     // Display city dropdown based on country name
//       //echo "<select name='assign_line'>";
//       //echo "<option value=x>". $files. "</option>";
    if($files !== 'Select'){
    //  SELECT COUNT( DISTINCT city) as cities FROM customer;
     $statement = $db->prepare("SELECT count(DISTINCT line_no) FROM pos_ner where file_name=?");
     $statement->bindParam(1,$files);
      $statement->execute();
      $result = $statement->fetchColumn();

      $loop=$result/100;
      $extra=$result%100;
      if($extra>0)
      {
        $loop=$loop+1;
      }
      //
      $statement1 = $db->prepare("SELECT * FROM assign where c_id=?");
      $statement1->bindParam(1,$contributor_id);
      $statement1->execute();
      $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
         // foreach ($result1 as $row) {
         //        echo "<option value= ''>".$row['assign_line']."</option>";
         //        //echo $row['assign_line'];
         //    }
      //
      for($i=0;$i<$loop-1;$i++)
      {
        $l=(100*$i)+1;
        $h=(100*($i+1));
        $val= $l."-".$h;
        $cnt=0;
        foreach ($result1 as $row) {
          if($row['assign_line']== $val && $row['file_name']==$files)
          {
              // echo "<option value= '' disabled>".$l."-".$h."</option>";
              $cnt++;
              break;
          }else {
              // echo "<option value= ''>".$l."-".$h."</option>";

          }
        }

        if($cnt>0)
        {
          echo "<option value= '$l-$h' disabled class='text-danger'>".$l."-".$h."</option>";
        }else {
          echo "<option value= '$l-$h' class='text-success'>".$l."-".$h."</option>";
        }

        //echo "<option value= '$l-$h'>$l-$h</option>";
      }
     //echo "<option value= '$result'>$result</option>";



    }else {
        echo "<option> Select</option>";
    }

  //  echo "</select>";
}

?>
