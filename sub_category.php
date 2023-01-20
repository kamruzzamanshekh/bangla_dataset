<?php

if(isset($_POST["pos_tagger"])){
    // Capture selected country
    $pos_tag = $_POST["pos_tagger"];

    // Define country and city array
    $countryArr = array(
                    "NN" => array("নামবাচক/সংজ্ঞাবাচক বিশেষ্য", "শ্রেণিবাচক/জাতিবাচক বিশেষ্য","সমষ্টিবাচক বিশেষ্য","গুণবাচক বিশেষ্য","ভাববাচক বিশেষ্য","বস্তুবাচক বিশেষ্য"),
                    "AD" => array("নাম বিশেষণ", "ভাব বিশেষণ" ,"অব্যয়ের বিশেষণ", "বিশেষণের বিশেষণ","ক্রিয়া বিশেষণ"),
                    "PRO" => array("বাক্তিবাচক বা পুরুষবাচক সর্বনাম" ,"সামীপ্যবাচক সর্বনাম" ,"দুরত্ববাচক সর্বনাম","সমষ্টিবাচক বা সাকল্যসূচক সর্বনাম","প্রশ্নবাচক সর্বনাম" ,"আত্ববাচক সর্বনাম" ,
                                   "অনির্দিষ্টতাজ্ঞাপক সর্বনাম" ,"অন্যাদিবাচক সর্বনাম" ,"সমন্ধ বা সংযোগজ্ঞাপক সর্বনাম" ,"ব্যতিহারবাচক সর্বনাম"),
                   "V" => array("সমাপিকা","অসমাপিকা","প্রযোজক","নামধাতু ও নামধাতুর ক্রিয়া", "যোগিক ক্রিয়া","মিশ্র ক্রিয়া"),
                   "ADV" => array("নির্দেশক ভাব","অনুজ্ঞা ভাব","সাপেক্ষ ভাব","আকাঙ্খা প্রকাশক ভাব"),
                   "PRE" => array("সমুচ্চয়ী অব্যয়","আবেগসূচক অব্যয়","পদান্বয়ী অব্যয়")
                );

    // Display city dropdown based on country name

    if($pos_tag=="NN" || $pos_tag=="AD" || $pos_tag=="PRO" || $pos_tag=="V" ||  $pos_tag=="ADV"||  $pos_tag=="PRE" ){

        foreach($countryArr[$pos_tag] as $value){
          $option_value=check_annotation($value);
            echo "<option value=".$option_value.">" .$value. "</option>";
        }

    }else {

        echo "<option value='select'> Select Sub Category</option>";
    }
}

//Sub category finder
function check_annotation($value)
{
  if($value=="নামবাচক/সংজ্ঞাবাচক বিশেষ্য")
  {
    return "NND";
  }else if($value== "শ্রেণিবাচক/জাতিবাচক বিশেষ্য")
  {
  return "NNN";
}else if($value=="সমষ্টিবাচক বিশেষ্য")
  {
  return "NCN";
  }else if($value=="গুণবাচক বিশেষ্য")
  {
  return "NQN";
  }else if($value=="ভাববাচক বিশেষ্য")
  {
  return "NEN";
  }else if($value=="বস্তুবাচক বিশেষ্য")
  {
  return "NCR";
  }else if($value=="নাম বিশেষণ")
  {
  return "ADN";
  }else if($value=="ভাব বিশেষণ")
  {
  return "ADE";
  }else if($value=="অব্যয়ের বিশেষণ")
  {
  return "ADP";
  }else if($value=="বিশেষণের বিশেষণ")
  {
  return "ADAD";
  }else if($value=="ক্রিয়া বিশেষণ")
  {
  return "ADV";
  }else if($value=="বাক্তিবাচক বা পুরুষবাচক সর্বনাম")
  {
  return "PROM";
  }else if($value=="সামীপ্যবাচক সর্বনাম")
  {
   return "PROR";
  }else if($value=="দুরত্ববাচক সর্বনাম")
  {
  return "PROD";
}else if($value=="সমষ্টিবাচক বা সাকল্যসূচক সর্বনাম")
{
return "PROC";
}else if($value=="প্রশ্নবাচক সর্বনাম")
{
return "PROQ";
}else if($value=="আত্ববাচক সর্বনাম")
{
return "PROS";
}else if($value=="অনির্দিষ্টতাজ্ঞাপক সর্বনাম")
{
return "PROI";
}else if($value=="অন্যাদিবাচক সর্বনাম")
{
return "PROA";
}else if($value=="সমন্ধ বা সংযোগজ্ঞাপক সর্বনাম")
{
return "PRR";
}else if($value=="ব্যতিহারবাচক সর্বনাম")
{
return "PROE";
}else if($value=="সমুচ্চয়ী অব্যয়")
{
return "PREC";
}else if($value=="আবেগসূচক অব্যয়")
{
return "PREI";
}else if($value=="পদান্বয়ী অব্যয়")
{
return "PREP";
}else if($value=="সমাপিকা")
{
return "VF";
}else if($value=="অসমাপিকা")
{
return "VI";
}else if($value=="প্রযোজক")
{
return "VP";
}else if($value=="নামধাতু ও নামধাতুর ক্রিয়া")
{
return "VN";
}else if($value=="যোগিক ক্রিয়া")
{
return "VC";
}else if($value=="মিশ্র ক্রিয়া")
{
return "VM";
}else if($value=="নির্দেশক ভাব")
{
return "ADVI";
}else if($value=="অনুজ্ঞা ভাব")
{
return "ADVM";
}else if($value=="সাপেক্ষ ভাব")
{
return "ASM";
}else if($value=="আকাঙ্খা প্রকাশক ভাব")
{
return "AOMF";
}else
  {

  }
}

?>
