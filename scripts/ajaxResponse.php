<?php
/*
++++++++++++++++++++++++++++++++++++++++++++++++
+ Program Name : NYSC EDO Allowance Software   +
+ Programmer   : IKPEAMA CHUKWUDI KENNETH	   +
+ Phone Number : 08068450263				   +
+ Start Date   : 16TH MAY, 2013				   +
+ End Date     : 							   +
+ Place		   : AIRPORT ROAD BENIN CITY	   +
+ State Code   : ED/13A/0862			++++++++
+										+
+										+
+										+
+++++++++++++++++++++++++++++++++++++++++

*/
session_start();
require_once('includes/settings.php');
//$a = odbc_exec($conn,"UPDATE ".$_SESSION['table']." SET mar = '19,800'"); //Don't Uncommment
$qstring = $_SERVER['QUERY_STRING'];
if(isset($_GET['action']) && $_GET['action'] == 'changeBranch'){
	$list = odbc_exec($conn,"SELECT * FROM branches WHERE bankName = '".$_GET['bnk']."'");
	$branchResult = '';
	while($lists = odbc_fetch_array($list)){
		$branchResult .= "<option value='".$lists['branchName']."'>".$lists['branchName']."</option>";
	}
	echo $branchResult;
	exit;
}
elseif(isset($_GET['action']) && $_GET['action'] == 'changeData1'){
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
		$query = "SELECT corpName, stateCode, acctNumber, bankName, branchName jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec FROM ".$_SESSION['table'];
	$corp = odbc_exec($conn,$query);
	}
	else{
		$query = "SELECT corpName, stateCode, acctNumber, bankName, branchName, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec FROM ".$_SESSION['table']." WHERE bankName = '".$_GET['bnks']."'";
	$corp = odbc_exec($conn,$query);
	}
	while($corps = odbc_fetch_array($corp)){
		$data .= "<tr class='trHover' onclick='edit(".get_ed_number($corps['stateCode']).")' title='Edit ".$corps['stateCode']."'>
      <td class='alignLeft'>".$corps['corpName']."</td>
      <td>".$corps['stateCode']."</td>
	  <td>".$corps['acctNumber']."</td>
      <td>".$corps['bankName']."</td>
	  <td>".$corps['branchName']."</td>
	  <td>".get_allow($corps['jan'])."</td>
	  <td>".get_allow($corps['feb'])."</td>
	  <td>".get_allow($corps['mar'])."</td>
	  <td>".get_allow($corps['apr'])."</td>
	  <td>".get_allow($corps['may'])."</td>
	  <td>".get_allow($corps['jun'])."</td>
	  <td>".get_allow($corps['jul'])."</td>
	  <td>".get_allow($corps['aug'])."</td>
	  <td>".get_allow($corps['sep'])."</td>
	  <td>".get_allow($corps['oct'])."</td>
	  <td>".get_allow($corps['nov'])."</td>
	  <td>".get_allow($corps['dec'])."</td>
	  <!--<td style=\"border:none;\"><a href='edit.php?ed=".get_ed_number($corps['stateCode'])."'>Edit</a></td>-->
    </tr>";
	}  
  $data .= '</tbody></table>';
	echo $data;
	exit;
}
elseif(isset($_GET['action']) && $_GET['action'] == 'changeData2'){
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
	$query = "SELECT corpName, stateCode, acctNumber, bankName, branchName, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec FROM ".$_SESSION['table']." WHERE bankName = '".$_GET['bank']."'";
	$corp = odbc_exec($conn,$query);
}else{
	$query = "SELECT corpName, stateCode, acctNumber, bankName, branchName, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec FROM ".$_SESSION['table']." WHERE bankName = '".$_GET['bank']."' AND branchName = '".$_GET['branch']."'";
	$corp = odbc_exec($conn,$query);
}
	while($corps = odbc_fetch_array($corp)){
		$data .= "<tr class='trHover' onclick='edit(".get_ed_number($corps['stateCode']).")' title='Edit ".$corps['stateCode']."'>
      <td class='alignLeft'>".$corps['corpName']."</td>
      <td>".$corps['stateCode']."</td>
	  <td>".$corps['acctNumber']."</td>
      <td>".$corps['bankName']."</td>
	  <td>".$corps['branchName']."</td>
	  <td>".get_allow($corps['jan'])."</td>
	  <td>".get_allow($corps['feb'])."</td>
	  <td>".get_allow($corps['mar'])."</td>
	  <td>".get_allow($corps['apr'])."</td>
	  <td>".get_allow($corps['may'])."</td>
	  <td>".get_allow($corps['jun'])."</td>
	  <td>".get_allow($corps['jul'])."</td>
	  <td>".get_allow($corps['aug'])."</td>
	  <td>".get_allow($corps['sep'])."</td>
	  <td>".get_allow($corps['oct'])."</td>
	  <td>".get_allow($corps['nov'])."</td>
	  <td>".get_allow($corps['dec'])."</td>
	  <!--<td style=\"border:none;\"><a href='edit.php?ed=".get_ed_number($corps['stateCode'])."'>Edit</a></td>-->
    </tr>";
	}  
  $data .= '</tbody></table>';
	echo $data;
	exit;
}
?>