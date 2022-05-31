<div id="adminHeader">
<div style="float:right; position:absolute; bottom:5px; right:20px;">
<form action="<?php echo base_url(); ?>" method="post" style="display:inline">
  <input name="search" type="text" class="textField" id="search" />
  <input type="submit" name="go" id="go" value="" />
</form>
(<a href="<?php echo base_url('logout'); ?>">Logout</a>)
</div>
<div style="float:left; position:absolute; bottom:5px; left:20px; font-size:16px;">

<table border="0">
<tr>
<td><a href="<?php echo base_url(); ?>"><button>Home</button></a></td>
<td><a href="<?php echo base_url('payment'); ?>" target="_blank"><button>Payment</button></a></td>
<td><a href="<?php echo base_url('double'); ?>" target="_blank"><button>Refresh</button></a></td>
<td width="50">&nbsp;</td>
<td align="left">
<form id="selectMnt" style="display:inline;">
  <select name="mnt" class="dropList" id="mnt">
  <option value="">-- Select Month --</option>
  <option value="january">January</option>
  <option value="february">February</option>
  <option value="march">March</option>
  <option value="april">April</option>
  <option value="may">May</option>
  <option value="june">June</option>
  <option value="july">July</option>
  <option value="august">August</option>
  <option value="september">September</option>
  <option value="october">October</option>
  <option value="november">November</option>
  <option value="december">December</option>
  </select>
</form>
</td>
</tr>
<tr>
<td><a href="<?php echo base_url('addnew'); ?>" target="_blank"><button>Add New Record</button></a><br/></td>
<td><a href="<?php echo base_url('undopayment'); ?>" target="_blank"><button>Undo Payment</button></a></td>
<td><a href="<?php echo base_url('excel'); ?>" target="_blank"><button>Excel Files</button></a></td>
<td width="50">&nbsp;</td>
<td><a href="<?php echo base_url('clear'); ?>" target="_blank" id="clearance"><button>Clearance</button></a></td>
</tr>
</table>
&nbsp;&nbsp;&nbsp;
 <!-- <form id="selectMnt" style="display:inline;">
  <select name="mnt" class="dropList" id="mnt">
  <option value="">-- Select Month --</option>
  <option value="january">January</option>
  <option value="february">February</option>
  <option value="march">March</option>
  <option value="april">April</option>
  <option value="may">May</option>
  <option value="june">June</option>
  <option value="july">July</option>
  <option value="august">August</option>
  <option value="september">September</option>
  <option value="october">October</option>
  <option value="november">November</option>
  <option value="december">December</option>
  </select>
</form>
<a id="print" href="#" target="_blank"><button>Print</button></a>-->
</div>
</div>
<?php
echo '<table border="1" style="border:1px solid #000; border-collapse:collapse; text-align:center; position: relative; top:10px;" cellpadding="5" align="center">';
echo'<tr style="font-weight:bold;">
<td>Name</td>
<td>State Code</td>
<td>Account No.</td>
<td>Bank Name</td>
<td>Branch</td>
</tr>';
foreach($get_double_acct as $double_acct){
	if(in_array($double_acct->acctNumber,$acct_array)){
		foreach($this->nysc_model->get_double_acct_data($prefix, $double_acct->acctNumber) as $acct){
			echo "<tr>
			<td align='left'>".$acct->corpName."</td>
			<td>".$acct->stateCode."</td>
			<td>".$double_acct->acctNumber."</td>
			<td>".$acct->bankName."</td>
			<td>".$acct->branchName."</td>
			</tr>";
		}
	}
	array_push($acct_array,$double_acct->acctNumber);
}
echo '</table>';
?>