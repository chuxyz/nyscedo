<div id="body1">

<form action="" id="loginForm" method="post">
<?php
echo '<div class="lastLogin"><b>Last Login:</b> '.strtolower(timespan($last_active[0]->last_active, time())).' ago</div>';;
?>
    <table width="300" border="0" align="center" class="loginTable">
      <tr>
        <td colspan="2" class="error">
        <?php
		if(isset($ses_msg)){
			echo $ses_msg;
		}
		?>
        </td>
      </tr>
      <tr>
        <td><span class="italicBold">Username:</span></td>
        <td><input type="text" name="username" placeholder="Username" id="username" class="textField" /></td>
      </tr>
      <tr>
        <td><span class="italicBold">Password:</span></td>
        <td><input type="password" name="password" placeholder="Password" id="password" class="textField" /></td>
      </tr>
      <tr>
        <td><span class="italicBold">Batch:</span></td>
        <td align="left">
        <select name="batch" id="batch" class="textField" style="width:auto; margin-left:5px;">
        <option value="a" selected="selected">Batch A</option>
        <option value="b">Batch B</option>
        <option value="c">Batch C</option>
        </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="enter" type="submit" class="button" id="enter" value="Enter" style="float:right; margin-right:12px;" /></td>
      </tr>
    </table>
  </form>
</div>
<!--<div id="footer"></div>-->