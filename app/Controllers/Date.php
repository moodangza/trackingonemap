<?php
namespace App\Controllers;


class Date extends BaseController
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
	public function cardlistjobapprove($rs_job)
	{
		$table = ' <div class="candidate-list-box card mt-2">
		<div class="p-2 card-body">
			
			<div class="align-items-center row">
			
				<div class="col-10">
					<div class="candidate-list-content mt-3 mt-lg-0">
						<h5 class="fs-19 mb-0" nowrap>
								<b>'.$rs_job["job_name"].'</b>'
						  '</h5>'
						'<p class="text-muted mb-2">คนบันทึก</p>'
						<ul class="list-inline mb-0 text-muted">
							<li class="list-inline-item">
								<i class="mdi mdi-map-marker"></i> วันที่ เริ่มต้น วันที่ สิ้นสุด
							</li>
							<li class="list-inline-item">
								<i class="mdi mdi-wallet"></i> วันที่เสร็จสิ้นการดำเนินการ
							</li>
						</ul>
					</div>
				</div>
				<div class="col-auto">
				<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModalCenter" onclick="detailprocessapprove(<?php echo $rs_job['job_id'];?>)">ดูรายละเอียด</button>
				</div>
			</div>
		  
		 
		</div>
	</div>';
	}
}

?>