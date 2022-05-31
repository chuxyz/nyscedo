<div id="adminHeader">
<div style="float:right; position:absolute; bottom:5px; right:20px;">
<form action="<?php echo base_url(); ?>" method="post" style="display:inline">
  <input name="search" type="text" class="textField" id="search" />
  <input type="submit" name="go" id="go" />
</form>
(<a href="<?php echo base_url('logout'); ?>">Logout</a>)
</div>
<div style="float:left; position:absolute; bottom:5px; left:20px; font-size:16px;">
<a href="<?php echo base_url(); ?>"><button>Cancel/Home</button></a>
</div>
</div>
<div id="body1" style="padding-bottom:70px; margin-top:20px;">
<form id="edit" name="form1" method="post" action="<?php echo current_url(); ?>">
  <table width="450" border="0" align="center" cellspacing="5" style="text-align:left; position:relative; top:50px;">
    <tr>
      <td colspan="3" align="center" class="error">
      <?php
		if($msg != ''){
		echo $msg;
		$msg = '';
	}
	foreach($mnt as $m){
		$name = $m->corpName;
		//$state_code = $m->
	}
	?>
      </td>
    </tr>
    <tr>
      <td>Full Name:</td>
      <td><input name="fullName" type="text" class="textField" id="fullName" value="<?php echo $mnt[0]->corpName; ?>" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>State Code:</td>
      <td><input name="stateCode" type="text" class="textField" id="stateCode" value="<?php echo $mnt[0]->stateCode; ?>" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Account Number:</td>
      <td><input name="acctNumber" type="text" class="textField" id="acctNumber" value="<?php echo $mnt[0]->acctNumber; ?>" /></td>
      <td><input name="update" type="submit" class="button" id="update" value="Update" /></td>
    </tr>
    <tr>
      <td>Bank Name:</td>
      <td><b><?php echo $mnt[0]->bankName; ?></b></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Branch:</td>
      <td><b><?php echo $mnt[0]->branchName; ?></b></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Payment</td>
      <td><table width="150" border="0">
        <tr>
          <td><input name="jan" type="checkbox" id="jan" value="19,800" <?php echo $jan; ?> /></td>
          <td>January</td>
        </tr>
        <tr>
          <td><input name="feb" type="checkbox" id="feb" value="19,800" <?php echo $feb; ?> /></td>
          <td>February</td>
        </tr>
        <tr>
          <td><input name="mar" type="checkbox" id="mar" value="19,800" <?php echo $mar; ?> /></td>
          <td>March</td>
        </tr>
        <tr>
          <td><input name="apr" type="checkbox" id="apr" value="19,800" <?php echo $apr; ?> /></td>
          <td>April</td>
        </tr>
        <tr>
          <td><input name="may" type="checkbox" id="may" value="19,800"  <?php echo $may; ?> /></td>
          <td>May</td>
        </tr>
        <tr>
          <td><input name="jun" type="checkbox" id="jun" value="19,800" <?php echo $jun; ?> /></td>
          <td>June</td>
        </tr>
        <tr>
          <td><input name="jul" type="checkbox" id="jul" value="19,800" <?php echo $jul; ?> /></td>
          <td>July</td>
        </tr>
        <tr>
          <td><input name="aug" type="checkbox" id="aug" value="19,800" <?php echo $aug; ?> /></td>
          <td>August</td>
        </tr>
        <tr>
          <td><input name="sep" type="checkbox" id="sep" value="19,800" <?php echo $sep; ?> /></td>
          <td>September</td>
        </tr>
        <tr>
          <td><input name="oct" type="checkbox" id="oct" value="19,800" <?php echo $oct; ?> /></td>
          <td>October</td>
        </tr>
        <tr>
          <td><input name="nov" type="checkbox" id="nov" value="19,800" <?php echo $nov; ?> /></td>
          <td>November</td>
        </tr>
        <tr>
          <td><input name="dec" type="checkbox" id="dec" value="19,800"  <?php echo $dec; ?> /></td>
          <td>December</td>
        </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</div>