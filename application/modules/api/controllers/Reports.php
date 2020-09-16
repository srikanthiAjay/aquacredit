<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Reports extends CI_Controller 
{
	function __construct()
	{	
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');	
		$this->load->model('api/Cash_model');
		$this->load->model('api/Transaction_model');
		
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
	}

	//Index function
	
	public function getbranches()
	{	
		echo $response = $this->Sales_model->getbranches();
	}
	
	
	public function getcashbook()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$limit = intval($this->input->post("length"));
	  
		$def_search = $_POST['search']['value'];
		$order = $_POST['order'][0]['column']; // Column index
		$columnName = $_POST['columns'][$order]['data']; // Column name
		$dir = $_POST['order'][0]['dir']; // asc or desc
		$searchValue = $_POST['search']['value']; // Search value
		
		

		$searchcash_type_opt = $_POST['cash_type_opt'];		
		$searchcash_type = $_POST['cash_type'];
		$reportRange = $_POST['reportrange'];
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];	
		/*$saletype = $_POST['saletype'];
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];		
				*/
		
		## Search 	
		$allcounts = $this ->Cash_model->cashAnalytics();
		$total = $this ->Cash_model->totalrecords($limit,$start,$def_search,$searchValue,$order,$dir,$searchValue,$searchcash_type_opt,$searchcash_type,$from_date,$to_date,$reportRange);

		$products =  $this->Cash_model->cash_search($limit,$start,$def_search,$searchValue,$order,$dir,$searchValue,$searchcash_type_opt,$searchcash_type,$from_date,$to_date,$reportRange); 
		
		$data = [];
		if(count($products)>0)
		{
			
			foreach($products as $r) {
				
				$udate = date('d-M-Y',strtotime($r['created_on']));
				
				$sllla = $this->db->query("select *from sale where id='".$r['trans_id']."' ");
				$slla = $sllla->row_array();


				if($r['trans_type']=='Loan')
				{
					$trans = 'LN'.$r['trans_id'];
				}
				else if($r['trans_type']=='Receipt')
				{
					$trans = 'RCP'.$r['trans_id'];
				}
				/*else if($r['trans_type']=='SALE (RECEIPT)')
				{
					$trans = $r['trans_type'].'- SCH'.$r['trans_id'];
				}*/
				else 
				{
					if($slla['saletype']==0)
					{
						$trans = $r['trans_type'].'- SCD'.$r['trans_id'];
					}
					else
					{
						$trans = $r['trans_type'].'- SCH'.$r['trans_id'];
					}
					
				}
				


				$llla = $this->db->query("select *from accounts where id='".$r['account_id']."' ");
				$lla = $llla->row_array();

				if($lla['account_type']=='BANK')
				{
					$ac = $lla['account_name'].'-'.$lla['account_number'];
				}
				else
				{
					$ac = 'CASH - '.$lla['account_name'];
				}

				if($r['amount_type']=='OUT')
				{
					$amountvval =  '₹'.$this->IND_money_format($r['amount']).'<span> <img class="grn_arow" src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" alt="" title=""> </span>';
				}
				else
				{
					$amountvval =  '₹'.$this->IND_money_format($r['amount']).'<span> <img class="grn_arow" src="http://3.7.44.132/aquacredit/assets/images/grn_c_ar.png" alt="" title=""> </span>';
				}
				
			    $data[] = array(					
					$udate,
					$trans,
					$ac,
					$amountvval,
					                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
					/*'<i class="fa fa-ellipsis-v act_icn" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover"  aria-hidden="true" onclick="clickaction('.$r["id"].','.$r['status'].');"></i>'*/
					/*'<i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>'*/
			   );
			}
		}

		$result = array(
			"draw" => $draw,
			"start" => $start,
			"length" => $limit,
			"recordsTotal" => count($total),
			"recordsFiltered" => count($total),
			"totamount" => ($allcounts["totamount"]==null)? 0 : $allcounts["totamount"],
			"cashamount" => ($allcounts["cashamount"]==null)? 0 : $allcounts["cashamount"],
			"bankamount" => ($allcounts["bankamount"]==null)? 0 : $allcounts["bankamount"],
			"data" => $data,
			);
		echo json_encode($result);
		exit();
	}
	public function IND_money_format($number){    	
        $decimal = (string)($number - floor($number));
        $money = floor($number);
        $length = strlen($money);
        $delimiter = '';
        $money = strrev($money);
 
        for($i=0;$i<$length;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
                $delimiter .=',';
            }
            $delimiter .=$money[$i];
        }
 
        $result = strrev($delimiter);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);
 
        if( $decimal != '0'){
            $result = $result.$decimal;
        }
         return $result;
 	}
	
}
?>