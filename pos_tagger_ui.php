<?php
session_start();
require_once 'header.php';
require_once('config.php');

if(isset($_SESSION['id']))
{

}
else
{
  header("location:login.php");

}

function isSameAndNotEmpty($values = []) {
  if (count($values) == 0) return false;
  foreach ($values as $value) {
    if (is_null($value) || empty($value)) {
      return false;
    }
  }

  for ($i = 0; $i < count($values) - 1; $i++) {
    if ($values[$i] !== $values[$i + 1]) {
      return false;
    }
  }

  return true;
}

if (isset($_POST['btn'])) {
   if($_POST['word']!=="select" && $_POST['pos']!=="select" && $_POST['ner']!=="select"){
     try {
       $word_value=$_POST['word'];
       $str=explode("-",$word_value);
       $w_id=$str[0];
       $pos_col=$str[1];
       $ner_col=$str[2];
       if($str[3]=="")
       {
         $done_by=$_SESSION['name'];
       }else {
            $done_by=$str[3]."-".$_SESSION['name'];
       }


      if($_POST['sub_pos']=="select")
      {
        $pos_tag=$_POST['pos'];
      }else {
         $pos_tag=$_POST['sub_pos'];
      }
      $ner_tag=$_POST['ner'];
       // $sub_pos_tag=$_POST['sub_pos'];

       // $statement_available = $db->prepare("SELECT * FROM assign where c_id=?");
       // $statement_available->bindParam(1,$id);
       // $statement_available->execute();

       $statement = $db->prepare("update pos_ner set `$pos_col`=?,`done_by`=?, `$ner_col`=? where w_id=?");
       $statement->execute(array($pos_tag,$done_by, $_POST['ner'],$w_id));
       echo '<script>alert("Successful")</script>';

       //need re-cehck or not
       $statement = $db->prepare("SELECT * FROM pos_ner where w_id=?");
       $statement->bindParam(1,$w_id);
       $statement->execute();
       $result = $statement->fetchAll(PDO::FETCH_ASSOC);
       $result = $result[0]; // Must have

       if (isSameAndNotEmpty([$result['pos1'], $result['pos2'], $result['pos3']]) &&
        isSameAndNotEmpty([$result['ner1'], $result['ner2'], $result['ner3']])) {
          $statement = $db->prepare("update pos_ner set `fpos`=?,`fner`=?,`re_check`=? where w_id=?");
          $statement->execute(array($result['pos1'],$result['ner1'],1,$w_id));
       }
     } catch (Exception $e) {
       $error_message = $e->getMessage();
     }
     //complted code of selected word

   }else {
     $error_message="";
     if($_POST['word']=="select") $error_message="Word";
     elseif ($_POST['pos']=="select") $error_message="POS Tag";
     else $error_message="NER Tag";
     echo '<script>alert("'.$error_message.' must be selected")</script>';
   }
  // when every option selected then execute the below code

}
 ?>
   <body >
      <?php require_once ('navbar.php'); ?>
     <br>
		<!-- /.words-item -->
        <div class="  container w-50  h-100 d-flex justify-content-center">
            <form class="form-container shadow mt-3 p-5" role="form" action="" method="post">
              <div class="col-form-label text-center pb-4">
                <h2 class="text-center">Bangali PoS and NER Dataset</h2><hr/>
              </div>
              <div class="form-control">
                  <?php include 'current_line.php'; ?>

              </div>

                <div class="form-control">
                  <label>Select Word</label>
                    <select class=" form-select" name="word">
                      <option value="select" selected>None</option>
                  <?php include 'word_selection.php'; ?>
                    </select>
                </div>
                  <div class="form-control">
                    <label>Part of Speech (POS) for selected word </label>
                    <select class="pos_tagger form-select" name="pos">
                      <option value="select" selected>Select PoS Tag</option>
                      <option value="NN">বিশেষ্য</option>
                      <option value="AD">বিশেষণ</option>
                      <option value="PRO">সর্বনাম</option>
                      <option value="V">ক্রিয়া</option>
                      <option value="ADV">ভাব বিশেষণ</option>
                      <option value="PRE">অব্যয়</option>
                      <option value="PUN">বিরামচিহ্ন বা যতিচিহ্ন</option>
                    </select>
                  </div>

                <div class="form-control">
                  <label>Sub-Category for selected word </label>
                  <select class="form-select" id="sub_cat" name="sub_pos">
                    <option value="select" selected> Select Sub Category</option>
                  </select>
                </div>

                <div class="form-control">
                  <label>Select NER(Named Entity Reconization for slected Word </label>
                  <select class="form-select" id="ner" name="ner">
                    <option value="select" selected>Select NER</option>
                    <option value="PLACE">স্থান </option>
                    <option value="TIME">সময়</option>
                    <option value="ORG"> সংস্থা</option>
                    <option value="COUNTRY">দেশ</option>
                    <option value="CONTINENT">মহাদেশ</option>
                    <option value="GEA">ভৌগলিক অবস্থা</option>
                    <option value="GPA">ভূরাজনৈতিক অঞ্চল</option>
                    <option value="WEATHER">আবহাওয়া</option>
                    <option value="PERSON">ব্যক্তি</option>
                    <option value="DATE">তারিখ</option>
                    <option value="MONEY">টাকা</option>
                    <option value="PERCENT">শতকরা</option>
                    <option value="MONEY">সুযোগসুবিধা</option>
                    <option value="FACILITY">OTHRES</option>
                  </select>
                </div><br>

              <div class="container">
              <div class="row">
                <div class="col text-center">
                <button type="submit" class="btn btn-primary btn-lg " name="btn">Submit</button>
                </div>
              </div>
            </div>

            </form>

      </div>

     <script type="text/javascript">
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
