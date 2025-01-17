<?php

if(!$_POST) exit;

// Email verification, do not edit.
function isEmail($email_visit) {
	return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email_visit ));
}

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

$name_visit   = $_POST['name_visit'];
$lastname_visit    = $_POST['lastname_visit'];
$email_visit   = $_POST['email_visit'];
$phone_visit   = $_POST['phone_visit'];
$date_visit  = $_POST['date_visit'];
$verify_visit  = $_POST['verify_visit'];

if(trim($name_visit) == '') {
	echo '<div class="error_message"><i class=" icon-warning-sign"></i> You must enter your Name.</div>';
	exit();
} else if(trim($lastname_visit ) == '') {
	echo '<div class="error_message"><i class=" icon-warning-sign"></i>You must enter your Last name.</div>';
	exit();
} else if(trim($email_visit) == '') {
	echo '<div class="error_message"><i class=" icon-warning-sign"></i>Please enter a valid email address.</div>';
	exit();
} else if(!isEmail($email_visit)) {
	echo '<div class="error_message"><i class=" icon-warning-sign"></i> You have enter an invalid e-mail address, try again.</div>';
	exit();
	} else if(trim($phone_visit) == '') {
	echo '<div class="error_message">Please enter a valid phone number.</div>';
	exit();
} else if(!is_numeric($phone_visit)) {
	echo '<div class="error_message">Phone number can only contain numbers.</div>';
	exit();
}
if(trim($date_visit) == '') {
	echo '<div class="error_message"><i class=" icon-warning-sign"></i> Please insert a date.</div>';
	exit();
} else if(!isset($verify_visit) || trim($verify_visit) == '') {
	echo '<div class="error_message"><i class=" icon-warning-sign"></i> Please enter the verification number.</div>';
	exit();
} else if(trim($verify_visit) != '4') {
	echo '<div class="error_message"><i class=" icon-warning-sign"></i> The verification number you entered is incorrect.</div>';
	exit();
}


//$address = "HERE your email address";
$address = "mthompson@gofetchweb.com";


// Below the subject of the email
$e_subject = 'You\'ve been contacted by ' . $name_visit. '.';

// You can change this if you feel that you need to.
$e_body = "You have been contacted by $name_visit $lastname_visit  that wont to visit the structure on $date_visit " . PHP_EOL . PHP_EOL;
$e_reply = "You can contact $name_visit via email, $email_visit or via phone $phone_visit";

$msg = wordwrap( $e_body . $e_content . $e_reply, 70 );

$headers = "From: $email_visit" . PHP_EOL;
$headers .= "Reply-To: $email_visit" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

if(mail($address, $e_subject, $msg, $headers)) {

	// Success message
	echo "<div id='success_page' style='padding:20px'>";
	echo "<strong >Email Sent.</strong>";
	echo "Thank you <strong>$name_contact</strong>,<br> your message has been submitted.";
	echo "</div>";

} else {

	echo 'ERROR!';

}