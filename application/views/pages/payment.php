<div id="adminHeader">
<div style="float:right; position:absolute; bottom:5px; right:20px;">
<form action="<?php echo base_url(); ?>" method="post" style="display:inline">
  <input name="search" type="text" class="textField" id="search" />
  <input type="submit" name="go" id="go" />
</form>
(<a href="<?php echo base_url('logout'); ?>">Logout</a>)
</div>
<div style="float:left; position:absolute; bottom:5px; left:200px; font-size:16px;"><a href="<?php echo base_url(); ?>"><button>Cancel/Home</button></a><a href="<?php echo base_url('undopayment'); ?>"><button>Undo Payment</button></a><a href="<?php echo base_url('payment'); ?>"><button disabled="disabled">Payment</button></a></div>
</div>
<div id="body1" style="margin-top:20px;">
<h2 align="center" style="color:#0A0;">Make Payments</h2>
  <form action="" method="post" enctype="multipart/form-data" name="form1" id="serial">
    <table width="50%" border="0" align="center" cellpadding="15" class="dropListTable" style="position:relative; top:0px;">
    <tr>
    <td colspan="3" class="error">
    <?php
	if(@$msg != ''){
		echo $msg;
		$msg = '';
	}
	?>
    </td>
    </tr>
      <tr>
        <td><input type="file" name="txtfile" id="txtfile" /></td>
        <td><select name="month" id="month" class="dropList">
      <option value="">-- Month --</option>
      <option value="jan">January</option>
      <option value="feb">February</option>
      <option value="mar">March</option>
      <option value="apr">April</option>
      <option value="may">May</option>
      <option value="jun">June</option>
      <option value="jul">July</option>
      <option value="aug">August</option>
      <option value="sep">September</option>
      <option value="oct">October</option>
      <option value="nov">November</option>
      <option value="dec">December</option>
    </select></td>
        <td><input name="payment" type="submit" value="Make Payment" /></td>
      </tr>
    </table>
  </form>
</div>