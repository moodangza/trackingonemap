<?php
namespace App\Libraries;


class Date 
{
  public function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
	
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
	public function Dateinpicker($strDate)
	{	
		$strDate = explode("-",$strDate);
		
		$strshdate = $strDate[2].'/'.$strDate[1].'/'.$strDate[0];
		return "$strshdate";
  	
	}
	public function Dateinpickerth($strDate)
	{	
		$strDate = explode("-",$strDate);
		
		$strshdate = $strDate[2].'/'.$strDate[1].'/'.$strDate[0]+543;
		return "$strshdate";
  	
	}
	public function Datethaifull($strDate)
	{
		$year = date("Y",strtotime($strDate))+543;
		$month = date("n",strtotime($strDate));
		$day = date("j",strtotime($strDate));
		$textday = date("l");
		$strtextday = array(
			"Monday" => "จันทร์",
			"Tuesday" => "อังคาร",
			"Wednesday" => "พุธ",
			"Thursday" => "พฤหัสบดี",
			"Friday" => "ศุกร์",
			"Sathurnday" => "เสาร์",
			"Sunday" => "อาทิตย์",

		);
		$text = $strtextday[$textday];
		$strMonth = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonth[$month];
		return "วัน".$text."ที่ ". "$day $strMonthThai $year";
	}
	public function showdatethai($dateformatdb){
		$year = date("Y",strtotime($dateformatdb))+543;
		$month = date("n",strtotime($dateformatdb));
		$day = date("j",strtotime($dateformatdb));
		$strMonth = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonth[$month];
		return $day.'/'.$strMonthThai.'/'.$year;
	}
}

?>