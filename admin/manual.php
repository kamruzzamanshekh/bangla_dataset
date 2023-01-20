<?php
session_start();
require_once 'header.php';
require_once('database.php');
  $flag=false;
  $i=0;
if(isset($_SESSION['login']))
{

}
else
{
  header("location:login.php");

}
//search based on file and range
if (isset($_POST['find'])) {
  if($_POST['selected_file']=="" && $_POST['line']=="")
  {
    echo "<script>
    window.location='manual.php';
    </script>";
  }else {
    try {
      $line=$_POST['line'];
      $str=explode("-",$line);
      $l=$str[0];
      $h=$str[1];
      //check this line assigned with three contributors or //
      //SELECT * from pos_ner WHERE file_name="File-01" and line_no BETWEEN 20 AND 30
      $statement_line = $db->prepare("SELECT * from pos_ner WHERE file_name=? and line_no BETWEEN ? AND ?");
      $statement_line->bindParam(1,$_POST['file']);
      $statement_line->bindParam(2,$l);
      $statement_line->bindParam(3,$h);
      $statement_line->execute();
      $result = $statement_line->fetchAll(PDO::FETCH_ASSOC);
      $flag=true;
    } catch (Exception $e) {
      $error_message = $e->getMessage();
    }
  }

}

//upadte query
if (isset($_POST['form2'])) {
  try {
    if ($_POST['pos']=="select") {
    echo '<script>alert("POS Tag must be selected")</script>';
    }elseif ($_POST['ner']=="select") {
      echo '<script>alert("NER Tag must be selected")</script>';
    }elseif ($_POST['sub_pos']=="select") {
    echo '<script>alert("Sub POS Tag must be selected")</script>';
  }else {
    if($_POST['sub_pos']=="select")
    {
      $pos_tag=$_POST['pos'];
    }else {
       $pos_tag=$_POST['sub_pos'];
    }
    $ner_tag=$_POST['ner'];

    $statement = $db->prepare("UPDATE `pos_ner` SET `fpos`=?,`fner`=?,re_check=? where w_id=?");
    $statement->execute(array($pos_tag,$ner_tag,1,$_POST['w_id']));

    echo '<script>alert("Successful")</script>';
  }

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
            <h2 class="text-center">Manual Cheking Words</h2><hr/>
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
              <label>Line Range</label>
              <select class="form-select" id="line_range" name="line">
              </select>
            </div>
          <div class="container">
          <div class="row">
            <div class="col text-center pt-2">
            <button type="submit" class="btn btn-primary btn-lg" name="find">FIND</button>
            </div>
          </div>
        </div>

        </form>
    </div><br><br>

    <div  class=" container d-flex justify-content-center margin-top: 5">
      <table class=" table table-responsive table-striped table-bordered">
      <thead class="thead-dark">
        <tr>
          <!-- <th scope="col">No</th> -->
          <th scope="col">Line</th>
          <th scope="col">Word</th>
          <th scope="col">First Contributors</th>
          <th scope="col">2nd Contributors</th>
          <th scope="col">3rd Contributors</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php

      if ($flag) {
        foreach ($result as $row) {
          $i++;
          if($row['pos1']=="" || $row['pos2']=="" || $row['pos3']=="" || $row['re_check']==1)
          {

          }else {
            ?>
            <tr>
            <td><?= $row['line_no'];?></td>
            <td><?= $row['word'];?></td>
            <td><?= $row['pos1']."-".$row['ner1']; ?></td>
            <td><?=  $row['pos2']."-".$row['ner2']; ?></td>
            <td><?=  $row['pos3']."-".$row['ner3'] ?></td>
            <td><a class="btn btn-success" data-toggle="modal" href="#editModal<?= $i; ?>" > Edit </a>

              <!-- //Modal -->
              <div id="editModal<?= $i; ?>" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Manual Checking Pos and NER Tag</h4>
                    </div>
                    <div class="modal-body">
                      <form action="" method="post">
                        <input type="hidden" name="line" value="<?= $row['line_no']; ?>">
                          <input type="hidden" name="w_id" value="<?= $row['w_id']; ?>">
                        <!-- Show Whole Sentence -->
                        <?php
                        $statement_line = $db->prepare("SELECT * from pos_ner WHERE file_name=? and line_no=?");
                        $statement_line->bindParam(1,$row['file_name']);
                        $statement_line->bindParam(2,$row['line_no']);
                        $statement_line->execute();
                        $whole_line = $statement_line->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($whole_line as $r) {
                          ?>
                          <?php echo $r['word']; ?>
                          <?php
                        }
                         ?><br><br><br>
                 <!-- End Showing Senetece -->
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="name">POS</label>
                          <div class="col-sm-10">
                              <!-- <input id="footer-change-text" class="form-control" name="ner" type="text" value="<?= $row['ner1'] ?>"/>  <br> -->

                                <select class="pos_tagger form-select" name="pos">
                                  <option value="select" selected>Select PoS Tag</option>
                                  <option value="NN">Noun(বিশেষ্য)</option>
                                  <option value="AD">Adjective(বিশেষণ)</option>
                                  <option value="PRO">Pronoun(সর্বনাম)</option>
                                  <option value="V">Verb (ক্রিয়া)</option>
                                  <option value="Adv">Adverb(ভাব বিশেষণ)</option>
                                  <option value="PRE">Preposition(পদান্বয়ী অব্যয়)</option>
                                  <option value="CON">Conjunction(সমুচ্চয়ী অব্যয়)</option>
                                  <option value="INT">Interjection(আবেগসূচক অব্যয়)</option>
                                  <option value="PUN">punctuation Marks(বিরামচিহ্ন বা যতিচিহ্ন)</option>

                              </select>
                          </div>
                          <div class="col-sm-10">
                            <label>Sub-Category</label>
                            <select class="form-select" id="sub_cat" name="sub_pos">
                              <option value="select" selected> Select Sub Category</option>
                            </select>
                          </div>
                          <div class="col-sm-10">
                            <label>NER</label>
                            <select class="form-select" id="ner" name="ner">
                              <option value="select" selected>Select NER</option>
                              <option value="ORGANIZATION">ORGANIZATION </option>
                              <option value="PERSON">PERSON</option>
                              <option value="LOCATION"> LOCATION</option>
                              <option value="DATE">DATE</option>
                              <option value="TIME">TIME</option>
                              <option value="MONEY">MONEY</option>
                              <option value="PERCENT">PERCENT</option>
                              <option value="FACILITY">FACILITY</option>
                              <option value="OTHRES">OTHRES</option>
                            </select>
                          </div>
                        </div>
                        <br>
                        <input  class="btn btn-success" style="margin-top: 10px;"  name="form2" type="submit" value="Update"/>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>

                </div>
              </div>


              <!-- end -->

            </td>
            </tr>
            <?php
          }
        }
      }
    ?>

      </tbody>
    </table>
    </div>




    <script type="text/javascript">
    $(document).ready(function(){
        $("select.selected_file").change(function(){
            var selected_file = $(".selected_file option:selected").val();
            var contributors_value = $(".contributor_id option:selected").val();
            $.ajax({
                type: "POST",
                url: "line_divide1.php",
                data: { selected_file : selected_file,
                        contributor_id : contributors_value  }
            }).done(function(data){
                $("#line_range").html(data);
            });
        });
    });

    $(document).ready(function(){
        $("select.pos_tagger").change(function(){
            var selected_pos = $(".pos_tagger option:selected").val();
            $.ajax({
                type: "POST",
                url: "sub_category.php",
                data: { pos_tagger : selected_pos }
            }).done(function(data){
                $("#sub_cat").html(data);
            });
        });
    });
    </script>
</body>
