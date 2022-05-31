<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pages extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	private function _prefix()
	{
		$pre = $this->nysc_model->get_prefix();
		return $pre[0]->prefix;
	}
	public function index()
	{
		$data['ie_box'] = $this->ie_box();
		$data['ses_msg'] = $this->session->userdata('ses_login_msg');
		$this->session->unset_userdata('ses_login_msg');
		$this->load->helper('date');
		$data['last_active'] = $this->nysc_model->get_last_active();
		if(isset($_POST['enter'])){
	$row = $this->nysc_model->check_admin($_POST['username'], md5($_POST['password']));
	if($row <= 0){
		$this->session->set_userdata('validate', 0);
		$this->session->set_userdata('ses_login_msg', 'Invalid Username or Password');
		$data['ses_msg'] = $this->session->userdata('ses_login_msg');
		$this->session->unset_userdata('ses_login_msg');
	}else{
		$this->session->set_userdata('user', $_POST['username']);
		$this->session->set_userdata('validate', 1);
		$prefx = array('prefix'=>$_POST['batch']);
		$this->nysc_model->set_last_active(); // set last_active
		$this->nysc_model->set_prefix($prefx); //set prefix
		//redirect if total number of records in db is equal to zero for a particular batch
		if($this->nysc_model->count_all($_POST['batch']) <= 0 ){
			redirect('upload');
		}
			
	}
		}
		if($this->session->userdata('validate') == 0){
		/*if ( ! file_exists('application/views/pages/index.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}*/
		$data['msg'] = '';
			$data['title'] = 'Login';
			$data['content'] = 'pages/index';
			$this->load->view($this->layout, $data);
		}
	/////END INDEX
	else{ // ELSE A
	$prefix = $this->_prefix(); // get prefix and store in $prefix
		///////////////////////
		$this->load->library('pagination');

$config['base_url'] = 'http://www/nedo/index.php/home';
$config['total_rows'] = 200;
$config['per_page'] = 20;

//$this->pagination->initialize($config);
		/////////////////////////
		$this->load->helper(array('form','url'));
		$data['msg'] = '';
		if($this->input->post('go') !== FALSE){
		//if(isset($_POST['go'])){
	  $search = $_POST['search'];
	  if(!is_numeric($search)||$search==''||strlen($search)>4){
		  $data['msg'] = 'ED number must be a numeric value and must not exceed 4 digits';
		  $ed = NULL;
	  }
	  elseif(is_numeric($search)&&strlen($search)<=4){
		  $str = strlen($search);
		  switch($str){
			  case 1:
			  $ed = '000'.$search;
			  break;
			  case 2:
			  $ed = '00'.$search;
			  break;
			  case 3:
			  $ed = '0'.$search;
			  break;
			  default:
			  $ed = $search;
			  break;
		  }
	  }
	  $stateCode = 'ED/2013A/'.$ed;
	  $count = $this->nysc_model->count_data_statecode($prefix, $stateCode);
	  if($count == 0){
		  $data['msg'] = "State Code Number $stateCode does not exist";
	  }
			$data['get_data'] = $this->nysc_model->get_data_statecode($prefix, $stateCode);
		}else{
			$data['get_data'] = $this->nysc_model->get_data($prefix);
		}
		$data['title'] = 'Home';
		$data['user'] = $this->session->userdata('user');
		$data['get_banks'] = $this->nysc_model->get_banks($prefix);
		$data['content'] = 'pages/home';
		$data['v'] = $this->session->userdata('validate');
		$this->load->view($this->layout, $data);
	  }//END ELSE A
	}
	
		
	
	
	public function double()
	{
		$prefix = $this->_prefix();
		
		if($this->session->userdata('validate') == 0){
		$this->session->set_userdata('ses_login_msg', 'You are not logged in or your session has expired');
		redirect();
		}
		$this->load->helper(array('url','form'));
		$data['acct_array'] = array();
		$data['get_double_acct'] = $this->nysc_model->double_acct($prefix);
		$data['prefix'] = $prefix;
		$data['title'] = 'Double Accounts';
		$data['content'] = 'pages/double';
		$this->load->view($this->layout, $data);
	}
	public function addnew()
	{
		$prefix = $this->_prefix();
		if($this->session->userdata('validate') == 0){
		$this->session->set_userdata('ses_login_msg', 'You are not logged in or your session has expired');
		redirect();
		}
		$data['msg'] = '';
		if(isset($_POST['addNew'])){
			$state_code = $this->nysc_model->check_state_code($prefix, $_POST['stateCode']);
	if(empty($_POST['fullName'])||empty($_POST['stateCode'])||empty($_POST['acctNumber'])||$_POST['bank']=='all'||@$_POST['branch']=='all'){
		$data['msg'] = 'You must not leave any field blank';
	}
	else if($state_code > 0){
		$data['msg'] = 'The state code you entered already exists!';
	}
	else if(!$this->is_acct_no($_POST['acctNumber'])){
		$data['msg'] = 'Invalid Account Number';
	}
	else if(!$this->is_valid_name($_POST['fullName'])){
		$data['msg'] = 'Invalid Name';
	}
	else if(!$this->is_state_code($_POST['stateCode'])){
		$data['msg'] = 'Invalid State Code';
	}else{
		$insert_data = array(
		'corpName'=>strtoupper($_POST['fullName']),
		'stateCode'=>$_POST['stateCode'],
		'acctNumber'=>$_POST['acctNumber'],
		'bankName'=>$_POST['bank'],
		'branchName'=>$_POST['branch']
		);
		$insert = $this->nysc_model->my_insert($prefix.'_corpmember', $insert_data);
		if(!$insert){
			$data['msg'] = "You have successfully Added a New Corp Member with state code - <b>".$_POST['stateCode']."</b>";
		}else{
			$data['msg'] = "An unknown error has occured! The record was not updated";
		}
	}
}
		$data['title'] = 'Add New';
		$data['get_banks'] = $this->nysc_model->get_banks($prefix);
		$data['content'] = 'pages/addnew';
		$this->load->view($this->layout, $data);
	}
	
	public function ajaxResponse($action = FALSE)
	{
		$prefix = $this->_prefix();
		if($action == 'changeBranch'){
			$this->db->select('*');
			$query = $this->db->get_where($prefix.'_branches',array('bankName'=>$_GET['bnk']));
			$lists = $query->result();
	$branchResult = '';
	foreach($lists as $list){
		$branchResult .= "<option value='".$list->branchName."'>".$list->branchName."</option>";
	}
	echo $branchResult;
	exit;
}
elseif($action == 'changeData1'){
	$data = '<table width="100%" border="1" align="center" class="dataTable">
	<tbody>
    <tr class="tableHead">
      <td><b>Name</b></td>
      <td>State Code</td>
	  <td>Account No.</td>
      <td>Bank Name</td>
      <td>Branch</td>
      <td>Jan</td>
      <td>Feb</td>
      <td>Mar</td>
      <td>Apr</td>
      <td>May</td>
      <td>Jun</td>
      <td>Jul</td>
      <td>Aug</td>
      <td>Sept</td>
      <td>Oct</td>
      <td>Nov</td>
      <td>Dec</td>
	  <!--<td style="border:none; background:#FFF;">&nbsp;</td>-->
    </tr>';
	if($_GET['bnks'] == 'all'){
		$this->db->select('corpName, stateCode, acctNumber, bankName, branchName jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec');
		$this->db->from($prefix.'_corpmember');
		$query = $this->db->get();
		$result = $query->result();
	}
	else{
		$this->db->select('corpName, stateCode, acctNumber, bankName, branchName, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec');
		$query = $this->db->get_where($prefix.'_corpmember',array('bankName'=>$_GET['bnks']));
		$result = $query->result();
	}
	foreach($result as $res){
		$data .= "<tr class='trHover' onclick='edit(\"".$res->stateCode."\")' title='Edit ".$res->stateCode."'>
      <td class='alignLeft'>".$res->corpName."</td>
      <td>".$res->stateCode."</td>
	  <td>".$res->acctNumber."</td>
      <td>".$res->bankName."</td>
	  <td>".$res->branchName."</td>
	  <td>".$this->get_allow($res->jan)."</td>
	  <td>".$this->get_allow($res->feb)."</td>
	  <td>".$this->get_allow($res->mar)."</td>
	  <td>".$this->get_allow($res->apr)."</td>
	  <td>".$this->get_allow($res->may)."</td>
	  <td>".$this->get_allow($res->jun)."</td>
	  <td>".$this->get_allow($res->jul)."</td>
	  <td>".$this->get_allow($res->aug)."</td>
	  <td>".$this->get_allow($res->sep)."</td>
	  <td>".$this->get_allow($res->oct)."</td>
	  <td>".$this->get_allow($res->nov)."</td>
	  <td>".$this->get_allow($res->dec)."</td>
	  <!--<td style=\"border:none;\"><a href='edit.php?ed=".$this->get_ed_number($res->stateCode)."'>Edit</a></td>-->
    </tr>";
	}  
  $data .= '</tbody></table>';
	echo $data;
	exit;
}
elseif($action == 'updateMonth'){
	$current_month = $_POST['m'];
	$data = array(
               'currentMonth' => $current_month
            );
$this->db->where('id',1);
$this->db->update('settings', $data);
exit;
	
}
elseif($action == 'changeData2'){
	$data = '<table width="100%" border="1" align="center" class="dataTable">
	<tbody>
    <tr class="tableHead">
      <td><b>Name</b></td>
      <td>State Code</td>
	  <td>Account No.</td>
      <td>Bank Name</td>
      <td>Branch</td>
     <td>Jan</td>
      <td>Feb</td>
      <td>Mar</td>
      <td>Apr</td>
      <td>May</td>
      <td>Jun</td>
      <td>Jul</td>
      <td>Aug</td>
      <td>Sept</td>
      <td>Oct</td>
      <td>Nov</td>
      <td>Dec</td>
	 <!--<td style="border:none; background:#FFF;">&nbsp;</td>-->
    </tr>';
if($_GET['branch'] == 'all'){
	$this->db->select('corpName, stateCode, acctNumber, bankName, branchName, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec');
	$query = $this->db->get_where($prefix.'_corpmember',array('bankName'=>$_GET['bank']));
	$result = $query->result();
}else{
	$this->db->select('corpName, stateCode, acctNumber, bankName, branchName, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec');
	$query = $this->db->get_where($prefix.'_corpmember',array('bankName'=>$_GET['bank'],'branchName'=>$_GET['branch']));
	$result = $query->result();
}
	foreach($result as $res){
		$data .= "<tr class='trHover' onclick='edit(\"".$res->stateCode."\")' title='Edit ".$res->stateCode."'>
      <td class='alignLeft'>".$res->corpName."</td>
      <td>".$res->stateCode."</td>
	  <td>".$res->acctNumber."</td>
      <td>".$res->bankName."</td>
	  <td>".$res->branchName."</td>
	  <td>".$this->get_allow($res->jan)."</td>
	  <td>".$this->get_allow($res->feb)."</td>
	  <td>".$this->get_allow($res->mar)."</td>
	  <td>".$this->get_allow($res->apr)."</td>
	  <td>".$this->get_allow($res->may)."</td>
	  <td>".$this->get_allow($res->jun)."</td>
	  <td>".$this->get_allow($res->jul)."</td>
	  <td>".$this->get_allow($res->aug)."</td>
	  <td>".$this->get_allow($res->sep)."</td>
	  <td>".$this->get_allow($res->oct)."</td>
	  <td>".$this->get_allow($res->nov)."</td>
	  <td>".$this->get_allow($res->dec)."</td>
	  <!--<td style=\"border:none;\"><a href='edit.php?ed=".$this->get_ed_number($res->stateCode)."'>Edit</a></td>-->
    </tr>";
	}  
  $data .= '</tbody></table>';
	echo $data;
	exit;
}
	}
	
	public function edit($ed = FALSE)
	{
		$prefix = $this->_prefix();
		if($this->session->userdata('validate') == 0){
		$this->session->set_userdata('ses_login_msg', 'You are not logged in or your session has expired');
		redirect();
		}
		$data['msg'] = '';
		if($ed === FALSE){
			show_404();
		}else{
			if(is_numeric($ed)&&strlen($ed)<4){
		  $str = strlen($ed);
		  switch($str){
			  case 1:
			  $ed = '000'.$ed;
			  break;
			  case 2:
			  $ed = '00'.$ed;
			  break;
			  case 3:
			  $ed = '0'.$ed;
			  break;
		  }
	  }else{
		  $ed = ''.$ed;
	  }
			$stateCode = 'ED/2013A/'.$ed;
			$link = current_url();
if(isset($_POST['update'])){
	if(empty($_POST['fullName'])||empty($_POST['stateCode'])||empty($_POST['acctNumber'])){
		$data['msg'] = 'You must not leave any field blank';
		header("Location:$link");
		exit;
	}
	else if(!$this->is_acct_no($_POST['acctNumber'])){
		$data['msg'] = 'Invalid Account Number';
		header("Location:$link");
		exit;
	}
	else if(!$this->is_state_code($_POST['stateCode'])){
		$data['msg'] = 'Invalid State Code';
		header("Location:$link");
		exit;
	}else{
		$array_data = array(
		'corpName' => $_POST['fullName'], 
		'stateCode' => trim($_POST['stateCode']), 
		'acctNumber' => $_POST['acctNumber'],
		'jan' => @$_POST['jan'],
		'feb' => @$_POST['feb'],
		'mar' => @$_POST['mar'],
		'apr' => @$_POST['apr'],
		'may' => @$_POST['may'],
		'jun' => @$_POST['jun'],
		'jul' => @$_POST['jul'],
		'aug' => @$_POST['aug'],
		'sep' => @$_POST['sep'],
		'oct' => @$_POST['oct'],
		'nov' => @$_POST['nov'],
		'dec' => @$_POST['dec']
		);
		foreach($array_data as &$arr){
			if($arr == NULL){
				$arr = '';
			}
		}
		$update = $this->nysc_model->update_data($stateCode,$prefix.'_corpmember',$array_data);
		if(!$update){
			$data['msg'] = "You have successfully Updated Corp Member with state code - <b>".$_POST['stateCode']."</b>";
		}else{
			$data['msg'] = "An unknown error has occured! The record was not updated";
		}
	}
}
$data['jan'] = $data['feb'] = $data['mar'] = $data['apr'] = $data['may'] = $data['jun'] = $data['jul'] = $data['aug'] = $data['sep'] = $data['oct'] = $data['nov'] = $data['dec'] = '';
$mnt = $this->nysc_model->check_month_paid($prefix, $stateCode);
if($mnt[0]->jan == '19,800'){
	$data['jan'] = ' checked="checked"';
}
if($mnt[0]->feb == '19,800'){
	$data['feb'] = ' checked="checked"';
}
if($mnt[0]->mar == '19,800'){
	$data['mar'] = ' checked="checked"';
}
if($mnt[0]->apr == '19,800'){
	$data['apr'] = ' checked="checked"';
}
if($mnt[0]->may == '19,800'){
	$data['may'] = ' checked="checked"';
}if($mnt[0]->jun == '19,800'){
	$data['jun'] = ' checked="checked"';
}
if($mnt[0]->jul == '19,800'){
	$data['jul'] = ' checked="checked"';
}
if($mnt[0]->aug == '19,800'){
	$data['aug'] = ' checked="checked"';
}
if($mnt[0]->sep == '19,800'){
	$data['sep'] = ' checked="checked"';
}
if($mnt[0]->oct == '19,800'){
	$data['oct'] = ' checked="checked"';
}
if($mnt[0]->nov == '19,800'){
	$data['nov'] = ' checked="checked"';
}
if($mnt[0]->dec == '19,800'){
	$data['dec'] = ' checked="checked"';
}
		}
		$data['mnt'] = $this->nysc_model->check_month_paid($prefix, $stateCode);
		$data['title'] = 'Edit Record';
		$data['content'] = 'pages/edit';
		$this->load->view($this->layout, $data);
	}
	
	public function payment()
	{
		$prefix = $this->_prefix();
		if($this->session->userdata('validate') == 0){
		$this->session->set_userdata('ses_login_msg', 'You are not logged in or your session has expired');
		redirect();
		}
		$this->load->helper(array('form'));
		
if(isset($_POST['payment'])){
	if($_FILES['txtfile']['error'] == 4){
		$msg = 'No File Selected!';
		$data['msg'] = $msg;
	}
	////FILETYPE
	$txtMimeTypes = array('text/plain','text/anytext','application/octet-stream','application/txt');
	if(!in_array($_FILES['txtfile']['type'],$txtMimeTypes)){
		$msg = "You can only upload files in .txt format. Try again after converting";
		$data['msg'] = $msg;
	}
	if($_FILES['txtfile']['error'] == 0 && $_POST['month'] == ''){
		$msg = 'You must select a month';
		$data['msg'] = $msg;
	}else{
		
		$handle = @fopen($_FILES['txtfile']['tmp_name'], "r");
		if ($handle) {
			$count = 0;
			$totalCount = 0;
    	while (($buffer = fgets($handle, 4096)) !== false) {
			$totalCount++;
			if($buffer == ''||$buffer == 'STATE CODE'){
				continue;
			}else{ // ID = buffer check
			$update = $this->nysc_model->update_data(trim($buffer),$prefix.'_corpmember',array($_POST['month'] => '19,800'));
		if(!$update){
			$count++;
		}
			} //end  ID = buffer check
    }//end while
    	if (!feof($handle)) {
        $msg = "Error: unexpected fgets() fail\n";
    	}else{
			$msg = "$count out of $totalCount records updated succesfully.<br /> Payment Done!";
		}
		$data['msg'] = $msg;
    	fclose($handle);
} // end if ($handle)
		
	}
	
}
		$data['title'] = 'Make Payment';
		$data['content'] = 'pages/payment';
		$this->load->view($this->layout, $data);
	}
	
	public function undopayment()
	{
		$prefix = $this->_prefix();
		if($this->session->userdata('validate') == 0){
		$this->session->set_userdata('ses_login_msg', 'You are not logged in or your session has expired');
		redirect();
		}
		$this->load->helper(array('form'));
		
if(isset($_POST['payment'])){
	if($_FILES['txtfile']['error'] == 4){
		$msg = 'No File Selected!';
		$data['msg'] = $msg;
	}
	////FILETYPE
	$txtMimeTypes = array('text/plain','text/anytext','application/octet-stream','application/txt');
	if(!in_array($_FILES['txtfile']['type'],$txtMimeTypes)){
		$msg = "You can only upload files in .txt format. Try again after converting";
		$data['msg'] = $msg;
	}
	if($_FILES['txtfile']['error'] == 0 || $_POST['month'] == ''){
		$msg = 'You must select a file and month';
		$data['msg'] = $msg;
	}else{
		
		$handle = @fopen($_FILES['txtfile']['tmp_name'], "r");
		if ($handle) {
			$count = 0;
			$totalCount = 0;
    	while (($buffer = fgets($handle, 4096)) !== false) {
			$totalCount++;
			if($buffer == ''||$buffer == 'STATE CODE'||$buffer == '\n'||$buffer == ' '){
				continue;
			}else{ // ID = buffer check
			$update = $this->nysc_model->update_data(trim($buffer),$prefix.'_corpmember',array($_POST['month'] => ''));
		if(!$update){
			$count++;
		}
			} //end  ID = buffer check
    }//end while
    	if (!feof($handle)) {
        $msg = "Error: unexpected fgets() fail\n";
    	}else{
			$msg = "$count out of $totalCount records updated succesfully.<br /> Payment Undone!";
		}
		$data['msg'] = $msg;
    	fclose($handle);
} // end if ($handle)
		
	}
	
}
		
		$data['title'] = 'Undo Payment';
		$data['content'] = 'pages/undopayment';
		$this->load->view($this->layout, $data);
	}
	
	public function printpages($page = 1)
	{
		$prefix = $this->_prefix();
		if($this->session->userdata('validate') == 0){
		$this->session->set_userdata('ses_login_msg', 'You are not logged in or your session has expired');
		redirect();
		}
		$data['title'] = 'Print Pages';
		$banks = $_GET['bank'];
		$bnk = explode('-',$banks);
		$bank = implode(' ',$bnk);
		if(isset($_GET['branch'])){
		$branchs = $_GET['branch'];
		$brch = explode('-',$branchs);
		$branch = implode(' ',$brch);
		}
		
		if(isset($_GET['month'])){
		$month1 = strtolower($_GET['month']);
		$month = substr($month1,0,3);
		}
		$data['month1'] = $month1;
		$data['rows_per_page'] = 30;
		$data['link_range'] = 2;
		$data['offset'] = ($page - 1) * $data['rows_per_page'];
		if($banks == 'all'){
			$this->db->select('corpName, stateCode, acctNumber, bankName, branchName');
			$query = $this->db->get_where('a_corpmember',array($month=>'19,800'),$data['rows_per_page'],$data['offset']);
	}else{
		if(isset($_GET['branch'])){
			$this->db->select('corpName, stateCode, acctNumber, bankName, branchName');
			$this->db->order_by("stateCode","asc");
			$query = $this->db->get_where('a_corpmember',array('bankName'=>$bank,'branchName'=>$branch,$month=>'19,800'),$data['rows_per_page'],$data['offset']);
		}else{
			$this->db->select('corpName, stateCode, acctNumber, bankName, branchName');
			$this->db->order_by("stateCode","asc");
			$query = $this->db->get_where('a_corpmember',array('bankName'=>$bank,$month=>'19,800'),$data['rows_per_page'],$data['offset']);
		}
	}
		$data['bank'] = $bank;
		$data['banks'] = $banks;
		$data['result'] = $query->result();
		$data['num_rows'] = count($data['result']);
		$data['total_pages'] = ceil($data['num_rows'] / $data['rows_per_page']);

		$data['page'] = $page;
		$data['content'] = 'pages/printpages';
		$this->load->view($this->layout, $data);
	}
	
	public function excel($month = 'all')
	{
		$prefix = $this->_prefix();
		if($this->session->userdata('validate') == 0){
		$this->session->set_userdata('ses_login_msg', 'You are not logged in or your session has expired');
		redirect();
		}
		$this->load->library('phpexcel');
		$this->load->library('PHPExcel/iofactory');
		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setTitle('NYSC EDO EXCEL')->setDescription('2013');
		//Assign cell values
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
		
		$objPHPExcel->getActiveSheet()->setCellValue('A1','S/N');
		$objPHPExcel->getActiveSheet()->setCellValue('B1','NAMES');
		$objPHPExcel->getActiveSheet()->setCellValue('C1','STATE CODE');
		$objPHPExcel->getActiveSheet()->setCellValue('D1','AMOUNT');
		$objPHPExcel->getActiveSheet()->setCellValue('E1','ACCOUNT NO.');
		$objPHPExcel->getActiveSheet()->setCellValue('F1','BANK');
		$objPHPExcel->getActiveSheet()->setCellValue('G1','BRANCH NAME');
		$objPHPExcel->getActiveSheet()->setCellValue('H1','PURPOSE');
		if($month == 'all' || $month == 'none' ){
			$excel_data = $this->nysc_model->excel_data_all($prefix);
		}else{
			$excel_data = $this->nysc_model->excel_data_by_month($prefix, $month);
		}
		$row_count = 2;
		$serial = 1;
		//$total_record = $this->nysc_model->count_all();
		
		if($month == 'none' || $month == 'jan' || $month == 'feb' || $month == 'mar' || $month == 'apr' || $month == 'may' || $month == 'jun' || $month == 'jul' || $month == 'aug' || $month == 'sep' || $month == 'oct' || $month == 'nov' || $month == 'dec'){ 
		
		foreach($excel_data as $e_data){
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row_count,$serial);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row_count,$e_data->corpName);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row_count,$e_data->stateCode);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row_count,'19,800.00');
			//$objPHPExcel->getActiveSheet()->setCellValue('E'.$row_count,$e_data->acctNumber);
			$objPHPExcel->getActiveSheet()->getCell('E'.$row_count)->setValueExplicit($e_data->acctNumber, PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row_count,$e_data->bankName);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row_count,$e_data->branchName);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row_count,strtoupper($month).'. '.date('Y').' BATCH A ALLOWANCE');
			$serial++;
			$row_count++;
		}
		$objPHPExcel->getActiveSheet()->getColumndimension('A')->setWidth(5);
		$objPHPExcel->getActiveSheet()->getColumndimension('B')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumndimension('C')->setWidth(14);
		$objPHPExcel->getActiveSheet()->getColumndimension('D')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumndimension('E')->setWidth(14);
		$objPHPExcel->getActiveSheet()->getColumndimension('F')->setWidth(18);
		$objPHPExcel->getActiveSheet()->getColumndimension('G')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumndimension('H')->setWidth(30);
		//Save it as excel 2003 file
		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
		if($month == 'none'){
			$month = 'all';
		}
		$objWriter->save('nyscedo_'.$month.'.xls');
		//download File
		$this->downloadFile('nyscedo_'.$month.'.xls');
		} // end if none, jan, feb...
		$data['title'] = 'Download Excel';
		if($month == 'all'){
		$data['title'] = 'Download Excel Files';
		$data['content'] = 'pages/excel';
		$this->load->view($this->layout, $data);
		}
		
	}
	
	public function clearance()
	{
		//$this->output->enable_profiler(TRUE);
		if($this->session->userdata('validate') == 0){
		$this->session->set_userdata('ses_login_msg', 'You are not logged in or your session has expired');
		redirect();
		}
		$prefix = $this->_prefix();
		$data['title'] = 'Clearance';
		$data['content'] = 'pages/clearance';
		$month = $this->nysc_model->get_current_month();
		$data['month'] = $month[0]->currentMonth;
		$mth = substr($data['month'],0,3);
		if(isset($_POST['clear'])){
			$stateCodes = @$_POST['stateCode'];
			if(!isset($stateCodes)){
				die('<h1 align="center">You must select at least one record <a href="'.site_url('clearance').'">Go Back!</a></h1>');
			}else{
				$array_data = array(
				$mth => '19,800'
				);
				foreach($stateCodes as $stateCode){
					$this->nysc_model->update_data($stateCode,$prefix.'_corpmember', $array_data);
				}
			}
		}
		$data['banks'] = $this->nysc_model->get_banks($prefix);
		$data['prefix'] = $prefix;
		$data['mth'] = $mth;
		//$data['all_uncleared'] = $this->nysc_model->get_all_uncleared($prefix, $mth);
		$this->load->view($this->layout, $data);
	}
	
	public function upload()
	{
		$this->load->helper('form');
		$this->session->unset_userdata('upload_msg');
		if($this->session->userdata('validate') == 0){
		$this->session->set_userdata('ses_login_msg', 'You are not logged in or your session has expired');
		redirect();
		}
		$prefix = $this->_prefix();
		if($this->input->post('upload')){
	if($_FILES['record']['error'] == 4){
		$this->session->set_userdata('upload_msg','No File Selected!');
	}
	$csvMimeTypes = array('text/plain','text/csv','application/csv','text/comma-seperated-values','application/excel','application/vnd.ms-excel','application/vnd.msexcel','text/anytext','application/octet-stream','application/txt');
	if(!in_array($_FILES['record']['type'],$csvMimeTypes)){
		$this->session->set_userdata('upload_msg','You can only upload files in .csv format. Try again after converting');
	}
	else{
	$file = fopen($_FILES['record']['tmp_name'],"r");
	$count_skip = 0;
	$count_new = 0;
	while(! feof($file)){
		$records = fgetcsv($file);
		/*
		0.	S/NO.	
		1.	NAMES	
		2.	STATE CODE	
		3.	AMOUNT	
		4.	ACCOUNT NO.	
		5.	BANK	
		6.	BANK BRANCH	
		7.	PURPOSE

		*/
		$state_code = $this->nysc_model->check_state_code($prefix, $records[2]);
		if($records[1]=='NAMES' || $records[1]=='' || !$this->is_state_code(trim($records[2])) || $state_code > 0 ){
			$count_skip++;
			continue;
			
		}else{
			$insert_array = array(
			'corpName' => trim($records[1]),
			'stateCode' => trim($records[2]),
			'acctNumber' => trim($records[4]),
			'bankName' => trim($records[5]),
			'branchName' => trim($records[6])
			);
			$this->nysc_model->my_insert($prefix.'_corpmember',$insert_array);
		$count_new++;
		}
	} // end while
fclose($file);
if($count_new == 0){
$this->session->set_userdata('upload_msg', 'No Record Update! Empty file selected or the exact file has already been uploaded before!');
}
else
{
$distinct_banks = $this->nysc_model->get_distinct_banks($prefix);
	foreach($distinct_banks as $banks)
	{
		$this->nysc_model->set_banks_table($prefix, $banks->bankName);
	}

$distinct_bank_branch = $this->nysc_model->get_distinct_bank_branch($prefix);
	foreach($distinct_bank_branch as $bank_branch)
	{
		$this->nysc_model->set_branches_table($prefix, $bank_branch->bankName, $bank_branch->branchName);
	}
$this->session->set_userdata('upload_msg', $count_new.' Records Uploaded Successfully! '.$count_skip.' records skipped');
redirect();
}// end else
	}

}
		
		$data['title'] = 'Upload Records';
		$data['content'] = 'pages/upload';
		$data['upload_msg'] = $this->session->userdata('upload_msg');
		$this->load->view($this->layout, $data);
	}
	
	public function clear()
	{
		redirect('clearance','refresh');
	}
	
	public function logout()
	{
		$this->session->unset_userdata('user');
		$this->session->set_userdata('validate', 0);
		$this->session->set_userdata('ses_login_msg', 'You are successfully logged out');
		redirect();
	}
}
?>