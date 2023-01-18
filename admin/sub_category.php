<?php

if(isset($_POST["pos_tagger"])){
    // Capture selected country
    $pos_tag = $_POST["pos_tagger"];

    // Define country and city array
    $countryArr = array(
                    "NN" => array("নামবাচক / সংজ্ঞাবাচক বিশেষ্য(Proper Nouns)", "শ্রেণিবাচক / জাতিবাচক বিশেষ্য(Common Nouns)",
                     "জাতিবাচক বিশেষ্য","সমষ্টিবাচক বিশেষ্য(Collective Nouns)"," গুণবাচক বিশেষ্য","ভাববাচক (ক্রিয়াবাচক) বিশেষ্য(Verbal Noun)","বস্তুবাচক বিশেষ্য"),
                    "AD" => array("ইতিবাচক বিশেষণ(Positive Adjective)", "তুলনামূলক বিশেষণ(comparative adjective)"),
                    "PRO" => array("ব্যক্তিবাচক সর্বনাম বা পুরুষবাচক সর্বনাম(Personal pronouns or masculine pronouns)",
                    "নির্দেশক সর্বনাম(demonstrative pronouns)", "অনির্দেশক সর্বনাম(Indirect pronouns)","প্রশ্নবাচক সর্বনাম(Interrogative pronouns)",
                  "আত্মবাচক সর্বনাম(Subjective pronouns)","সমষ্টিবাচক সর্বনাম(collective pronouns)"),
                  "V" => array("সমাপিকা(Finite)","অ-সমাপিক(Non-Finite)")
                );

    // Display city dropdown based on country name

    if($pos_tag=="NN" || $pos_tag=="AD" || $pos_tag=="PRO" || $pos_tag=="V" ){

        foreach($countryArr[$pos_tag] as $value){
          $option_value=check_annotation($value);
            echo "<option value=".$option_value.">". $value." ".$option_value . "</option>";
        }

    }else {

        echo "<option value='select'> Select Sub Category</option>";
    }
}

//Sub category finder
function check_annotation($value)
{
  if($value=="নামবাচক / সংজ্ঞাবাচক বিশেষ্য(Proper Nouns)")
  {
    return "NND";
  }else if($value== "শ্রেণিবাচক / জাতিবাচক বিশেষ্য(Common Nouns)")
  {
  return "NNC";
  }else if($value=="জাতিবাচক বিশেষ্য")
  {
  return "NNN";
  }else if($value=="বস্তুবাচক বিশেষ্য")
  {
  return "NCR";
  }else if($value=="সমষ্টিবাচক বিশেষ্য(Collective Nouns)")
  {
  return "NCN";
  }else if($value=="ভাববাচক (ক্রিয়াবাচক) বিশেষ্য(Verbal Noun)")
  {
  return "NEN";
  }else if($value=="ইতিবাচক বিশেষণ(Positive Adjective)")
  {
  return "ADP";
  }else if($value=="তুলনামূলক বিশেষণ(comparative adjective)")
  {
  return "ADC";
  }else if($value=="ব্যক্তিবাচক সর্বনাম বা পুরুষবাচক সর্বনাম(Personal pronouns or masculine pronouns)")
  {
  return "PROP";
  }else if($value=="নির্দেশক সর্বনাম(demonstrative pronouns)")
  {
  return "PROD";
  }else if($value=="অনির্দেশক সর্বনাম(Indirect pronouns)")
  {
  return "PROID";
  }else if($value=="প্রশ্নবাচক সর্বনাম(Interrogative pronouns)")
  {
  return "PROIT";
  }else if($value=="আত্মবাচক সর্বনাম(Subjective pronouns)")
  {

  }else if($value=="সমষ্টিবাচক সর্বনাম(collective pronouns)")
  {
  return "PROC";
}else if($value=="সমাপিকা(Finite)")
{
return "VF";
}else if($value=="অ-সমাপিক(Non-Finite)")
{
return "VIF";
}else
  {

  }
}

?>
