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
<td><a href="<?php echo base_url(); ?>"><button>Refresh</button></a></td>
<td><a href="<?php echo base_url('payment'); ?>" target="_blank"><button>Payment</button></a></td>
<td><a href="<?php echo base_url('double'); ?>" target="_blank"><button>Check Double Acct.</button></a></td>
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
  <!--<form id="selectMnt" style="display:inline;">
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
<!--<div id="cover">-->
  <form id="serial" name="form1" method="post" action="">
    <table width="50%" border="0" align="center" cellpadding="15" class="dropListTable">
      <tr>
        <td>Bank:
          <select name="bank" class="dropList" id="bank">
            <option value="all">-- All Banks --</option>
            <?php
			foreach($get_banks as $banks){
				echo "<option value='$banks->bankName'>$banks->bankName</option>";
			}
			?>
        </select></td>
        <td>Branch:  
          <select name="branch" class="dropList" id="branch" disabled="disabled">
            <option value="all">-- All Branches --</option>
        </select></td>
      </tr>
    </table>
  </form>
  <?php
  if($msg != ''){
	  echo '<div class="error" id="notification">'.$msg.'</div>';
	  $msg = '';
  }
  ?>
  <div class="loading">
   <img src="<?php echo base_url('images/loading.gif') ?>" /><br />
   <b>Loading...</b>
   </div>
  <table width="100%" border="1" align="center" class="dataTable">
  <tbody>
    <tr class="tableHead">
      <td width="200"><b>Name</b></td>
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
    </tr>
    <?php
	$my_ctrl = new My_Controller;
	foreach($get_data as $datum){
		echo "<tr class='trHover' onclick='edit(\"".$datum->stateCode."\")' title='Edit ".$datum->stateCode."'>
      <td class='alignLeft' width='300'>".$datum->corpName."</td>
      <td>".$datum->stateCode."</td>
	  <td>".$datum->acctNumber."</td>
      <td>".$datum->bankName."</td>
	  <td>".$datum->branchName."</td>
	  <td>".$my_ctrl->get_allow($datum->jan)."</td>
	  <td>".$my_ctrl->get_allow($datum->feb)."</td>
	  <td>".$my_ctrl->get_allow($datum->mar)."</td>
	  <td>".$my_ctrl->get_allow($datum->apr)."</td>
	  <td>".$my_ctrl->get_allow($datum->may)."</td>
	  <td>".$my_ctrl->get_allow($datum->jun)."</td>
	  <td>".$my_ctrl->get_allow($datum->jul)."</td>
	  <td>".$my_ctrl->get_allow($datum->aug)."</td>
	  <td>".$my_ctrl->get_allow($datum->sep)."</td>
	  <td>".$my_ctrl->get_allow($datum->oct)."</td>
	  <td>".$my_ctrl->get_allow($datum->nov)."</td>
	  <td>".$my_ctrl->get_allow($datum->dec)."</td>
	  <!--<td style=\"border:none;\"><a href='edit.php?ed=".$my_ctrl->get_ed_number($datum->stateCode)."' target='_blank'>Edit</a></td>-->
    </tr>";
	}
	?>
    </tbody>
  </table>
<?php
echo $this->pagination->create_links();
?>
<!--</div>-->