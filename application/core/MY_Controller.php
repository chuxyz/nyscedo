<?php
class MY_Controller extends CI_Controller {
	public $site_name = 'NYSC edo';
	public $layout = 'layout';
    public function __construct()
    {
        parent::__construct();
		$this->load->model('nysc_model');
    }
	public function add_style_sheet($file_name)
	{
		$this->load->helper('url');
		$style_sheet = base_url('css/'.$file_name);
		return '<link href="'.$style_sheet.'" rel="stylesheet" type="text/css" media="all" />';
	}
	public function get_allow($allow)
	{
	if($allow != '')
	return "<span class=\"no-error\">$allow</span>";
	else
	return '<span class="error">---</span>';
	}
	public function get_ed_number($stateCode)
	{
	 return end(explode('/',$stateCode));
 	}
	public function is_acct_no($acct)
	{
	 if(is_numeric($acct) && strlen($acct) == 10){
		 return TRUE;
		 }
	 return FALSE;
	}
	public function is_state_code($stateCode)
	{
	 $ed = end(explode('/',$stateCode));
	 if(is_numeric($ed) && strlen($stateCode) == 13 && substr($stateCode,0,3) == 'ED/' && is_numeric(substr($stateCode,3,4))){
		 return TRUE;
		 }
	 return FALSE;
	}
	public function is_valid_name($name){
	 $n = explode(' ',$name);
	 if(count($n) > 1){
		 return TRUE;
		 }
	 return FALSE;
	}
	

	public function downloadFile( $fullPath ){ 

  // Must be fresh start 
  if( headers_sent() ) 
    die('Headers Sent'); 

  // Required for some browsers 
  if(ini_get('zlib.output_compression')) 
    ini_set('zlib.output_compression', 'Off'); 

  // File Exists? 
  if( file_exists($fullPath) ){ 
    
    // Parse Info / Get Extension 
    $fsize = filesize($fullPath); 
    $path_parts = pathinfo($fullPath); 
    $ext = strtolower($path_parts["extension"]); 
    
    // Determine Content Type 
    switch ($ext) { 
      case "pdf": $ctype="application/pdf"; break; 
      case "exe": $ctype="application/octet-stream"; break; 
      case "zip": $ctype="application/zip"; break; 
      case "doc": $ctype="application/msword"; break; 
      case "xls": $ctype="application/vnd.ms-excel"; break; 
      case "ppt": $ctype="application/vnd.ms-powerpoint"; break; 
      case "gif": $ctype="image/gif"; break; 
      case "png": $ctype="image/png"; break; 
      case "jpeg": 
      case "jpg": $ctype="image/jpg"; break; 
      default: $ctype="application/force-download"; 
    } 

    header("Pragma: public"); // required 
    header("Expires: 0"); 
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
    header("Cache-Control: private",false); // required for certain browsers 
    header("Content-Type: $ctype"); 
    header("Content-Disposition: attachment; filename=\"".basename($fullPath)."\";" );
     header("Content-Transfer-Encoding: binary"); 
    header("Content-Length: ".$fsize); 
    ob_clean(); 
    flush(); 
    readfile( $fullPath ); 

  } else 
    die('File Not Found'); 

} 
public function using_ie() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $ub = FALSE; 
    if(preg_match('/MSIE/i',$u_agent)) 
    { 
        $ub = TRUE; 
    } 
    
    return $ub; 
} 

public function ie_box() {
     if ($this->using_ie()) {
         return '<div class="iebox">
             This page is not designed for view on Intenet Explorer.  If you want to see this webpage as intended, please use a standard compliant browser, such as Mozilla Firefox or <a href="http://www.google.com/chrome">Google Chrome</a>.<br />
			 We are very sorry for the inconvenience.
         </div>';
     }
	 return '';
 }

}
?>