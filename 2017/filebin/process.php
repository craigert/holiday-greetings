<?php
$fromName = $_POST['name'];
$fromEmail = $_POST['email'];
$emailRecipients = $_POST['emailRecipients'];
$emailList = explode(",", $emailRecipients);

$customMessage = $_POST['customMessage'];

$htmlHeader = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns:v="urn:schemas-microsoft-com:vml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<style type="text/css">
	.ReadMsgBody {width: 100%;}
	.ExternalClass {width: 100%;}
	body {width: 100%; margin:0; padding:0; -webkit-font-smoothing: antialiased; font-family: Helvetica, Arial, sans-serif; color: #ffffff;}
	table, table td {border-collapse: collapse;}
	table {table-layout: fixed;}
	body[yahoo] .hide-lg-table {display: none !important;}
	html, body {
		margin: 0;
		padding: 0;
	}
</style>
</head>';

$htmlBody = '<body marginwidth="0" marginheight="0" yahoo="fix" style="background-color: #ffffff; font-family: Helvetica, Arial, sans-serif">

	<!-- Wrapper -->
	<table cellpadding="0" cellspacing="0" align="center" style="width: 100%; background: #ffffff; text-align: center">
		<tr>
			<td>
				<table width="580" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                
					<!-- Start Header and Content -->
                    <tr>
                   		<td bgcolor="#db2c27" width="600" valign="top"><img width="600" src="http://landing.landesk.com/holiday-greetings-2017/images/top-card.jpg" alt="" border="0" style="width: 600px; max-width: 100%;" class="deviceWidth" />
						  <table style="width: 100%" cellpadding="20">
						  	<tr>
						  		<td style="padding-left: 33px;">
						  			<div style="mso-table-lspace:0; mso-table-rspace:0; margin:0; min-height: 100px; max-height: 400px; color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size: 15px; font-weight: bold; line-height: 20px; text-align: left; word-wrap: break-word; vertical-align: top; padding-left:33px" class="main-message">'. $customMessage .'
								  	</div>
								  	<!--[if gte mso 9]>
										</v:textbox>
								  	</v:rect>
								  	<![endif]-->
						  		</td>
						  	</tr>
						  </table>
						  
						</td>
                    </tr>
                    <!-- End Header -->
                   
                   <!-- Start Footer -->
				   	<tr>
						<td align="center" valign="top">
							<div style="mso-table-lspace:0; mso-table-rspace:0; margin:0; width: 600px;" class="footerAdjustHeight">
								<img width="600" src="http://landing.landesk.com/holiday-greetings-2017/images/bottom-card.jpg" alt="" border="0" style="width: 600px; max-width: 100%;" class="deviceWidth" />
							</div>
						</td>
					</tr>
					<!-- End Footer -->

				</table>
			</td>
		</tr>
	</table>
	<!-- End Wrapper -->

</body>';
$htmlFooter = '</html>';

require('C:\inetpub\campaigns\landing\holiday-greetings-2017\filebin\class.phpmailer.php');

$numEmailsSent = 1;

//send email to following recipients
foreach($emailList as $addr){
	
	// Email confirmation to user
	$mail = new PHPMailer();
	$mail->CharSet = "UTF-8";

	// Add SMTP Configuration
	$mail->IsSMTP();
	$mail->Host = "slc-cas1.landesk.com";
	$mail->Port = 25;
	
	$mail->AddAddress($addr);
	
	$mail->FromName = $fromName;
	$mail->From = $fromEmail;

	$mail->IsHTML(true);

	$mail->Subject  =  'Holiday Greetings from Ivanti';
	$mail->Body     =  $htmlHeader . $htmlBody . $htmlFooter;
	
	$myFile = "numEmailsSent.txt";
	$fh = fopen($myFile, 'a') or die("can't open file");
	fwrite($fh, $numEmailsSent . PHP_EOL);
	fclose($fh);
	$numEmailsSent++;

	if(!$mail->Send()) {
		$recipient = 'craig.boren@ivanti.com';
		$subject = 'Wrike Task Request failed';
		$content = $body;	
	  mail($recipient, $subject, $content, "From: $email\r\nReply-To: $email\r\nX-Mailer: DT_formmail");
		echo "mail not sent";
	  exit;
	}
}

Header("Location: http://landing.landesk.com/holiday-greetings-2017/thankyou.html");
?>