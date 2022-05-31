<div id="cover">
<b style="position:relative; top:10px;">
<?php
echo "$bank";
if(isset($_GET['branch'])){
	echo " - $branch";
}
?>
</b>
  <table width="100%" border="1" align="center" class="dataTable" style="position:relative; top:15px; margin-bottom:20px; font-size:14px;">
  <tbody>
    <tr class="tableHead">
    <td>S/N</td>
      <td><b>Name</b></td>
      <td>State Code</td>
      <td>Amount</td>
      <td>Account No.</td>
      <td>Bank Name</td>
      <td>Branch</td>
      <td>Purpose</td>
    </tr>
    <?php
	/////////////////////////WITHOUT NUMBERING
	/*$sn = 0;
	while($corps = odbc_fetch_array($corp)){
		$sn++;
		echo "<tr>
		<td>$sn</td>
      <td class='alignLeft'>".$corps['corpName']."</td>
      <td>".$corps['stateCode']."</td>
	  <td>19,800.00</td>
	   <td>".$corps['acctNumber']."</td>
      <td>".$corps['bankName']."</td>
	  <td>".$corps['branchName']."</td>
	  <td>MAY 2013 BATCH A ALLOW.</td>
    </tr>";
	}*/
	////////////////////////
	
	/*
	$corpName_array = array('Name');
	$stateCode_array = array('State Code');
	$acctNumber_array = array('Account No.');
	$bankName_array = array('Bank');
	$branchName_array = array('Branch');
	while($corps = odbc_fetch_array($corp)){
		array_push($corpName_array,$corps['corpName']);
		array_push($stateCode_array,$corps['stateCode']);
		array_push($acctNumber_array,$corps['acctNumber']);
		array_push($bankName_array,$corps['bankName']);
		array_push($branchName_array,$corps['branchName']);
	}
	$total_records = count($corpName_array) - 1;
	$total_pages = ceil($total_records/$rows_per_page);
	$start = ($rows_per_page * $page) - $rows_per_page + 1;
	$stop = $rows_per_page * $page;
	for($i=$start; $i<=$stop; $i++){
		if($i>$total_records){
			break;
		}*/
		$i = $offset + 1;
		foreach($result as $re){
		echo "<tr>
		<td>$i</td>
      <td class='alignLeft'>".$re->corpName."</td>
      <td>".$re->stateCode."</td>
	  <td>19,800.00</td>
	   <td>".$re->acctNumber."</td>
      <td>".$re->bankName."</td>
	  <td>".$re->branchName."</td>
	  <td>".strtoupper($month1)." BATCH A ALLOW.</td>
    </tr>";
	$i++;
	}
	?>
    </tbody>
  </table>

<?php
echo '<div class="pagination">';
				if ($page > 1) {
					if(isset($_GET['branch'])){
					echo " <a href='{$_SERVER['PHP_SELF']}?bank=".$banks."&branch=$branchs&month=".$_SESSION['month']."&page=1'>&laquo;First Page</a> ";
					}else{
						echo " <a href='{$_SERVER['PHP_SELF']}?bank=".$banks."&month=".$_SESSION['month']."&page=1'>&laquo;First Page</a> ";
					}
					$prev_page = $page - 1;
					if(isset($_GET['branch'])){
					echo " <a href='{$_SERVER['PHP_SELF']}?bank=".$banks."&branch=$branchs&month=".$_SESSION['month']."&page=$prev_page'>&lt;Prev</a> ";
					}else{
						echo " <a href='{$_SERVER['PHP_SELF']}?bank=".$banks."&month=".$_SESSION['month']."&page=$prev_page'>&lt;Prev</a> ";
					}
					}
					// loop to show links to range of pages around current page
					for ($x = ($page - $link_range); $x < (($page + $link_range) + 1); $x++) {
						// if it's a valid page number...
						if (($x > 0) && ($x <= $total_pages)) {
							// if we're on current page...
							if ($x == $page) {
								// 'highlight' it but don't make a link
								echo " <span style=\"background: #666; color:#FFF; padding:0 2px; border:1px solid #666;\"><b>$x</b></span> ";
								// if not current page...
								} else {
									// make it a link
									if(isset($_GET['branch'])){
									echo " <a href='{$_SERVER['PHP_SELF']}?bank=".$banks."&branch=$branchs&month=".$_SESSION['month']."&page=$x'>$x</a> ";
									}else{
										echo " <a href='{$_SERVER['PHP_SELF']}?bank=".$banks."&month=".$_SESSION['month']."&page=$x'>$x</a> ";
									}
									} // end else
									} // end if
									} // end for
									// if not on last page, show forward and last page links       
									if ($page != $total_pages) {
										// get next page
										$next_page = $page + 1;
										// echo forward link for next page 
										if(isset($_GET['branch'])){
										echo " <a href='{$_SERVER['PHP_SELF']}?bank=".$banks."&branch=$branchs&month=".$_SESSION['month']."&page=$next_page'>Next&gt;</a> ";
										}else{
											echo " <a href='{$_SERVER['PHP_SELF']}?bank=".$banks."&month=".$_SESSION['month']."&page=$next_page'>Next&gt;</a> ";
										}
										// echo forward link for lastpage
										if(isset($_GET['branch'])){
										echo " <a href='{$_SERVER['PHP_SELF']}?bank=".$banks."&branch=$branchs&month=".$_SESSION['month']."&page=$total_pages'>Last Page&raquo;</a> ";
										}else{
											echo " <a href='{$_SERVER['PHP_SELF']}?bank=".$banks."&month=".$_SESSION['month']."&page=$total_pages'>Last Page&raquo;</a> ";
										}
										} // end if
							echo '</div>';
?>
</div>