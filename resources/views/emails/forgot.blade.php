<?php
$current_month = date("M");
$current_day = date("d");
$current_year = date("Y");
$full_name = "Trilok";//session('full_name');?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" style="background-color:#CCCCCC; padding-top:20px; padding-bottom:20px;"><table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td style="background-color:#FFFFFF;"><table width="670" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="169" height="20">&nbsp;</td>
            <td width="501">&nbsp;</td>
          </tr>
          <tr>
            <td><a href="{{url('public/images/demo.jpg')}}" target="_blank"><img src="{{url('public/images/demo.jpg')}}" alt="" border="0" height="80" /></a></td>
            <td align="right" style="font-family:Arial, Helvetica, sans-serif;"><strong>Date</strong><br /><?php echo $current_month.' '.$current_day.', '.$current_year;?></td>
          </tr>
          <tr>
            <td style="height:20px; border-bottom:1px solid #CCCCCC;">&nbsp;</td>
            <td style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
          </tr>
          <tr>
            <td style="height:20px;">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
          <table width="670" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td style="font-family:Arial, Helvetica, sans-serif;"><p>Dear  <?php echo $name?> </p>
			<p> Your Password is<?php echo $password;?></p><br/></td>
            </tr>
            <tr>
              <td style="font-family:Arial, Helvetica, sans-serif;"><br />
			  Thanks,<br />
			 <br/>
			  <a href="{{url('/')}}">{{url('/')}}</a>
			  <br/>
			  <br/>
			  </td>
            </tr>
            <tr>
              <td style="border-top:1px solid #CCCCCC; padding-top:15px;"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="20">&nbsp;</td>
            </tr>
          </table></td>
      </tr>
    </table>
      <table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td style="text-align:center; padding-top:15px; font-family:Arial, Helvetica, sans-serif; font-size:11px;">
            
            
          </td>
        </tr>
      </table></td>
  </tr>
</table>