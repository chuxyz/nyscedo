<!--
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

-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NYSC EDO | <?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/layout.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/general.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/home.css'); ?>" />
    <script src="<?php echo base_url('scripts/jquery.js'); ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('scripts/scripts.js'); ?>" type="text/javascript"></script>
</head>
<body>

<div id="container">
	<h1>NYSC EDO</h1>
<?php
if(@$ie_box == ''){
$this->load->view($content);
}else{
	echo @$ie_box;
}
?>

	<p class="footer"><span style="float:left;">NYSC EDO &copy; Copyright 2013</span>Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
<span style="float:left; text-align:left; padding-left:10px; font-size:10px; line-height:1;"><b>By Ikpeama Chukwudi K. - ED/13A/0862<br />+2348068450263, +2348032618110</b></span>

</body>
</html>