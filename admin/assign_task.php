<?php
session_start();
require_once 'header.php';
require_once('database.php');

if(isset($_SESSION['login']))
{

}
else
{
  header("location:login.php");

}
if (isset($_POST['Submit'])) {
  try {
    //check this line assigned with three contributors or //
    $statement_line = $db->prepare("SELECT count(assign_line) FROM assign where file_name=? and assign_line=?");
    $statement_line->bindParam(1,$_POST['file']);
    $statement_line->bindParam(2,$_POST['line']);
     $statement_line->execute();
     $line_count = $statement_line->fetchColumn();

     if($line_count<3)
     {
       $statement = $db->prepare("insert into assign (`c_id`, `file_name`,`assign_line`) values(?,?,?)");
       $statement->execute(array($_POST['contributor_id'], $_POST['file'],$_POST['line']));
       echo '<script>alert("Successfully assigned to '.$_POST['contributor_id'].'")</script>';
     }else {
       echo '<script>alert("Already assigned 3 contributors- '.$_POST['line'].'")</script>';
     }
      echo "<script>window.location='assign_task.php';</script>";
  } catch (Exception $e) {
    $error_message = $e->getMessage();
  }
}
?>
<body>
    <?php require_once ('navbar.php'); ?></br></br></br>
    <div class="  container w-50  h-100 d-flex justify-content-center margin-top: 5">
        <form class="form-container shadow mt-3 p-5" role="form" action="" method="post">
          <div class="col-form-label text-center pb-4">
            <h2 class="text-center">Assign Task To Contributors</h2><hr/>
          </div>
            <?php
            $statement = $db->prepare("SELECT * FROM Contributors");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <div class="form-control">
              <label>Select Contributor</label>
                <select class="contributor_id form-select" name="contributor_id">
                  <option value="" selected>None</option>
                  <?php
                  foreach ($result as $row) {

                 ?>
                    <option value="<?php echo $row['c_id']; ?>"><?php echo $row['c_name'];?></option>
                  <?php } ?>
                </select>
            </div>
              <div class="form-control">
                <label>Select File </label>
                <select class="selected_file form-select" name="file">
                  <option value="Select" selected>Select</option>
                  <option value="File-01">File-01</option>
                  <option value="File-02">File-02</option>
                  <option value="File-03">File-03</option>
                  <option value="File-04">File-04</option>
                  <option value="File-05">File-05</option>
                  <option value="File-06">File-06</option>
                  <option value="File-07">File-07</option>
                  <option value="File-08">File-08</option>
                  <option value="File-09">File-09</option>
                </select>
              </div>

            <div class="form-control">
              <label>Line Range </label>
              <select class="form-select" id="sub_cat" name="line">

              </select>
            </div>


          <div class="container">
          <div class="row">
            <div class="col text-center pt-2">
            <button type="submit" class="btn btn-primary btn-lg" name="Submit">Submit</button>
            </div>
          </div>
        </div>

        </form>

    </div>
    <script type="text/javascript">
    $(document).ready(function(){
        $("select.selected_file").change(function(){
            var selected_file = $(".selected_file option:selected").val();
            var contributors_value = $(".contributor_id option:selected").val();
            $.ajax({
                type: "POST",
                url: "line_divide.php",
                data: { selected_file : selected_file,
                        contributor_id : contributors_value  }
            }).done(function(data){
                $("#sub_cat").html(data);
            });
        });
    });
    </script>

</body>
