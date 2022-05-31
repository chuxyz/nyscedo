<div id="adminHeader">
<span style="float:right; position:absolute; bottom:5px; right:20px;">(<a href="<?php echo base_url('logout'); ?>">Logout</a>)</span>
<div style="float:left; position:absolute; bottom:5px; left:200px; font-size:16px;"><a href="<?php echo base_url(); ?>"><button>View Records</button></a><button disabled="disabled">Upload New Record</button></div>
</div>
<div id="body1">
  <?php echo form_open_multipart(base_url('upload'));?>
    <table width="300" border="0" align="center">
      <tr>
        <td colspan="2" class="error">
        <?php
		echo $upload_msg;
		?>
        </td>
      </tr>
      <tr>
        <td><input name="record" type="file" id="record" /></td>
        <td><input name="upload" type="submit" id="upload" value="Upload" /></td>
      </tr>
    </table>
  </form>
</div>
<p align="left">
<b>Instruction: </b>First of all, arrange your excel file in the format shown in the image below. And before you upload your excel data, make sure you have saved it in .CSV file format before you upload it to the server. Please heed to this instruction to avoid corrupting the database with unwanted data whilst uploading. 
</p>
<div style="border:1px solid #CCC; padding-top:10px; margin-top:10px;">
<img src="<?php echo base_url('images/sample_img.png'); ?>" height="500" height="400" />
</div>