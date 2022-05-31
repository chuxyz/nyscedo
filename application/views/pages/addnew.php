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
<div id="body1" style="height:350px; margin-top:20px;">
<form id="edit" name="form1" method="post" action="<?php echo current_url(); ?>">
  <table width="650" border="0" align="center" cellspacing="5" style="text-align:left; position:relative; top:50px;">
    <tr>
      <td colspan="3" align="center" class="error">
      <?php
		if(isset($msg) || $msg!=''){
		echo $msg;
		$msg = '';
	}
	?>
      </td>
    </tr>
    <tr>
      <td>Full Name:</td>
      <td><input name="fullName" type="text" class="textField" id="fullName" /></td>
      <td class="no-error">e.g. IKPEAMA CHUKWUDI KENNETH</td>
    </tr>
    <tr>
      <td>State Code:</td>
      <td><input name="stateCode" type="text" class="textField" id="stateCode" /></td>
      <td class="no-error">e.g. ED/2013A/0862</td>
    </tr>
    <tr>
      <td>Account Number:</td>
      <td><input name="acctNumber" type="text" class="textField" id="acctNumber" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Bank Name:</td>
      <td>
      <select name="bank" class="dropList" id="bank"  style="width:200px;">
            <option value="all">-- Bank --</option>
            <?php
			foreach($get_banks as $banks){
				echo "<option value='".$banks->bankName."'>".$banks->bankName."</option>";
			}
			?>
       </select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Branch:</td>
      <td>
      <select name="branch" class="dropList" id="branch" disabled="disabled"  style="width:200px;">
            <option value="all">-- Branch --</option>
        </select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="addNew" type="submit" class="button" id="addNew" value="Add New Record" style="width:150px;" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</div>