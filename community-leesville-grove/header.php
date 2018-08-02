<?php
    include('includes/functions.php');

    // Set phone number
    $phone_tracking = '919-230-8405';
    $phone_non_tracking = '919-241-7444';

    $_SESSION['phone'] = ($_GET['thank_you'] ? $phone_non_tracking : $phone_tracking);

    // Get the source for subject line customization
    if ($_GET['src']) {

        $src = htmlspecialchars(stripslashes(trim($_GET['src'])), ENT_QUOTES);

        switch($src) {
            case 'f':
                $_SESSION['src'] = 'Facebook';
                break;
            case 'g':
                $_SESSION['src'] = 'Google';
                break;
            default:
                $_SESSION['src'] = 'Organic';
                break;
        }
    }

    // Get the utm source for subject line customization
    if ($_GET['utm_medium']) {

        $utm = htmlspecialchars(stripslashes(trim($_GET['utm_medium'])), ENT_QUOTES);

        switch($utm) {
            case 'email':
                $_SESSION['src'] = 'Email';
                break;
            default:
                $_SESSION['src'] = 'Email';
                break;
        }

    }

    // Initialize the form data
    $form = array(
        'input' => array(),
        'errors' => array(),
        'required' => array(
            array('field' => 'user_name', 'error' => 'Name is required'),
            array('field' => 'user_phone', 'error' => 'Phone number is required'),
            array('field' => 'user_email', 'error' => 'Email is required')
        ),
        'spam' => array(
			'12345',
            '@mail.ru',
            'backlinks',
            'case studies',
            'freelance',
            'Google',
            'href',
            'http',
            'optimization',
            'optimizer',
            'pitch',
            'programmer',
            'rankings',
            'redesign',
            'SEO',
            'web designer',
            'web developement',
            'web developer',
            'webmaster',
            'website',
            'wordpress'
		),
        'email' => array(
            'to' => 'info@terramorhomes.com, sharon.bott@terramorhomes.com, reid.byers@terramorhomes.com, kellie@trimarkdigital.com, terramorhomesbuilder@gmail.com'
        )
    );

    // This functions cycles through the $_POST data and sanitizes it. It also works for arrays of data
    function sanitize_form($input) {
        // If it's an array break it apart and resubmit to the function
        if (is_array($input)) {
            $array = [];
            foreach ($input as $key => $val) {
                $array[$key] = sanitize_form($val);
            }
            return $array;
        } else {
            return htmlspecialchars(stripslashes(trim($input)), ENT_QUOTES);
        }
    }

    // This function performs validation checks for required fields, and human testing
    function form_is_valid() {
        global $form;

        // Cycle through the required fields and make sure they all have data
        foreach ($form['required'] as $required) {
            if (empty($form['input'][$required['field']])) {
                $form['status'] = 'error';
                $form['errors'][] = $required['error'];
            }
        }

        // Cycle through spam values
        foreach ($form['input'] as $input_key => $input_val) {
            foreach ($form['spam'] as $spam_key => $spam_val) {
                if (stripos($input_val, $spam_val) !== false) {
                    $form['status'] = 'error';
                }
            }
        }

        // Validate email address
        if (!filter_var($form['input']['user_email'], FILTER_VALIDATE_EMAIL)) {
            $form['status'] = 'error';
        }

        // Test for humans
        if (!empty($form['input']['breathing'])) {
            $form['status'] = 'error';
        }

        if ($form['status'] != 'error') {
            return true;
        } else {
            return false;
        }

    }

    // If there is any $_POST data, let's get this party started
    if (!empty($_POST)) {

        // Sanitize all inputs and store in $form
        $form['input'] = sanitize_form($_POST);

        // If data passes validation, then proceed to mail processing
        if (form_is_valid()) {

            // Format recipients for Mandrill
            $recipients = [];
            foreach (explode(',', $form['email']['to']) as $to) {
                $recipients[] = array(
                    'email' => $to
                );
            }

            if (!isset($_SESSION['src'])) {
                $_SESSION['src'] = 'Organic';
            }

            $subject = $_SESSION['src'] . ' Contact Form for Leesville Grove';

            // Create the body of the email
            $body = "NAME:  " . $form['input']['user_name'] . "\r\n";
            $body .= "PHONE:  " . $form['input']['user_phone'] . "\r\n";
            $body .= "EMAIL:  " . $form['input']['user_email'] . "\r\n";
            $body .= "COMMENTS:  " . $form['input']['user_comments'] . "\r\n";
            $body .= "\n\n\n";
            $body .= "-- End of Message. (" . date('m/d/Y') . ")";

            // Set up data for sending through Mandrill
            $mandrill_params = array(
                "key" => "j8pH1k-ExFm5TtEMPRCyLQ",
                "message" => array(
                    "text" => $body,
                    "to" => $recipients,
                    "from_name" => "Terramor Homes",
                    "from_email" => "noreply@trimarkleads.com",
                    "subject" => $subject
                )
            );

            // Send the messages
            $post_string = json_encode($mandrill_params);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://mandrillapp.com/api/1.0/messages/send.json');
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);

            // This is the executable curl statement that will send the emails
            $mandrill_result = curl_exec($ch);


            // Integration with MailChimp
    		if (!empty($form['input']['user_email'])) {

                // Split the full name into First and Last
                $full = explode(' ', $form['input']['user_name']);

                if (count($full) > 1) {
                    $last = array_pop($full);
                    $first = implode(' ', $full);
                } else {
                    $first = implode(' ', $full);
                    $last = null;
                }

    			require_once($_SERVER['DOCUMENT_ROOT'].'/library/includes/send-to-mailchimp.php');
    			send_to_mailchimp($form['input']['user_email'], $first, $last, 'Leesville Grove');
    		}

            // Redirect user to the thank you url
            header("Location:?thank_you=true");
            exit;
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow">
    
    <title>Terramor Homes | Leesville Grove</title>
    <link rel="shortcut icon" href="//newhomes.terramorhomes.com/library/img/favicon.png">
    <link rel="stylesheet" href="//use.typekit.net/deo6ntv.css">
    <link rel="stylesheet" href="library/css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700i" rel="stylesheet">

    <!-- START: Google Analytics (terramorhomes.com) -->
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-17782991-1']);
	  _gaq.push(['_trackPageview']);
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
	<!-- END: Google Analytics -->

    <?php /*<!-- Hotjar Tracking Code for https://www.terramorhomes.com/ -->
	<script type="text/javascript" async>
	    (function(h,o,t,j,a,r){
	        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
	        h._hjSettings={hjid:141413,hjsv:5};
	        a=o.getElementsByTagName('head')[0];
	        r=o.createElement('script');r.async=1;
	        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
	        a.appendChild(r);
	    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
	</script> */ ?>
	
	<!-- Hotjar Tracking Code for https://newhomes.terramorhomes.com/ -->
	<script>
	    (function(h,o,t,j,a,r){
	        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
	        h._hjSettings={hjid:954361,hjsv:6};
	        a=o.getElementsByTagName('head')[0];
	        r=o.createElement('script');r.async=1;
	        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
	        a.appendChild(r);
	    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
	</script>

    <!-- Facebook Pixel Code -->
    <script type="text/javascript" async>
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
    document,'script','https://connect.facebook.net/en_US/fbevents.js');
    
    fbq('init', '566935810320351');
    fbq('track', "PageView");
    <?php if(isset($_GET['thank_you'])) { ?>
        fbq('track', 'Lead');
    <?php } ?>
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=566935810320351&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->

</head>
<body>

<header class="header">
    <div class="wrapper">
        <a href="//newhomes.terramorhomes.com"><img class="logo" src="library/img/logo-leesville.png" alt="Leesville Grove"></a>
        <div class="phone">
	        <a href="tel:<?=$_SESSION['phone']?>"><img src="library/img/img-kristy-phone.png" alt="Ask Kristy Today!"></a>
            <div class="text">Ask Kristy:</div>
            <a class="number" href="tel:<?=$_SESSION['phone']?>"><?=$_SESSION['phone']?></a>
        </div>
    </div>
</header>