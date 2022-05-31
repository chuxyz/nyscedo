<!--<button id="submitClearance" style="position:fixed; top:10px; left:30px;">Submit</button> -->
<div style="position:relative;">
<h1 align="left">
<?php
echo ucwords($month).' Clearance';
?>
</h1>
</div>
<div id="body1" style="color:#000;">
<form action="" method="post" id="clearanceForm">
<input name="clear" type="submit" value="Submit Clearance" style="position:fixed; top:127px; left:30px;" />
<?php
foreach($banks as $bank){
echo '<h1 class="clickBank" style="cursor: move; border-top: 1px solid #D0D0D0; border-bottom:none !important;">'.$bank->bankName.'</h1>
<div style="display:none;"><table width="99%" class="clearanceTable" border="0" align="center">
<tr style="font-weight:bold; background-color: #EEE;">
<td width="5%">&nbsp;</td>
<td width="25%">State Code</td>
<td width="34%">Bank Name</td>
<td width="35%">Branch</td>
</tr>';
$all_uncleared = $this->nysc_model->get_all_uncleared($prefix, $mth, $bank->bankName);
foreach($all_uncleared as $all){
	echo "<tr class=\"hoverRow\">
	<td width='5%'><input type=\"checkbox\" name=\"stateCode[]\" value=\"$all->stateCode\" /></td>
	<td width='25'>$all->stateCode</td>
	<td width='34%'>$all->bankName</td>
	<td width='35%'>$all->branchName</td>
	</tr>";
}// foreach all_uncleared
echo '</table></div>';
}// foreach banks
?>
</form>
</div>