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
<td><a href="<?php echo base_url('excel'); ?>" target="_blank"><button>Refresh</button></a></td>
<td width="50">&nbsp;</td>
<td><a href="<?php echo base_url('clear'); ?>" target="_blank" id="clearance"><button>Clearance</button></a></td>
</tr>
</table>
&nbsp;&nbsp;&nbsp;
</div>
<div id="body1" style="margin-top:70px;">
<p class="downloadLinks">
<?php
echo anchor('excel/none', 'Download all data', array('title' => 'Download all data','target' => '_blank'));
echo '<br/>';
echo anchor('excel/jan', 'Download Excel data for January Clearance', array('title' => 'Download Excel data for January Clearance','target' => '_blank'));
echo '<br/>';
echo anchor('excel/feb', 'Download Excel data for February Clearance', array('title' => 'Download Excel data for February Clearance','target' => '_blank'));
echo '<br/>';
echo anchor('excel/mar', 'Download Excel data for March Clearance', array('title' => 'Download Excel data for March Clearance','target' => '_blank'));
echo '<br/>';
echo anchor('excel/apr', 'Download Excel data for April Clearance', array('title' => 'Download Excel data for April Clearance','target' => '_blank'));
echo '<br/>';
echo anchor('excel/may', 'Download Excel data for May Clearance', array('title' => 'Download Excel data for May Clearance','target' => '_blank'));
echo '<br/>';
echo anchor('excel/jun', 'Download Excel data for June Clearance', array('title' => 'Download Excel data for June Clearance','target' => '_blank'));
echo '<br/>';
echo anchor('excel/jul', 'Download Excel data for July Clearance', array('title' => 'Download Excel data for July Clearance','target' => '_blank'));
echo '<br/>';
echo anchor('excel/aug', 'Download Excel data for August Clearance', array('title' => 'Download Excel data for August Clearance','target' => '_blank'));
echo '<br/>';
echo anchor('excel/sep', 'Download Excel data for September Clearance', array('title' => 'Download Excel data for September Clearance','target' => '_blank'));
echo '<br/>';
echo anchor('excel/oct', 'Download Excel data for October Clearance', array('title' => 'Download Excel data for October Clearance','target' => '_blank'));
echo '<br/>';
echo anchor('excel/nov', 'Download Excel data for November Clearance', array('title' => 'Download Excel data for November Clearance','target' => '_blank'));
echo '<br/>';
echo anchor('excel/dec', 'Download Excel data for December Clearance', array('title' => 'Download Excel data for December Clearance','target' => '_blank'));
echo '<br/>';
?>
</p>
</div>