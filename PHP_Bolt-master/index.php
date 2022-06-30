<?php
session_start();
//echo "<pre>";
print_r($_SERVER);
$hash = "";
//echo $_SERVER['REQUEST_METHOD'];exit;
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') == 0){
	//Request hash
	
	//echo $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';	exit;
	//if(strcasecmp($contentType, 'application/json') == 0){
		$data = json_decode(file_get_contents('php://input'));
		$hash=hash('sha512', $data->key.'|'.$data->txnid.'|'.$data->amount.'|'.$data->pinfo.'|'.$data->fname.'|'.$data->email.'|||||'.$data->udf5.'||||||'.$data->salt);
		$json=array();
		$json['success'] = $hash;
    	//echo json_encode($json);
	//	exit;
	
	//}
	//exit(0);
}
 
function getCallbackUrl()
{
	
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 80) ? "https://" : "http://";
	return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'response.php';
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PayUmoney BOLT PHP7 Kit</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<!-- this meta viewport is required for BOLT //-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >
<!-- BOLT Sandbox/test //-->
<script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
color="e34524" bolt-logo="https://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>
<!-- BOLT Production/Live //-->
<!--// script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script //-->

</head>
<style type="text/css">
	.main {
		margin-left:30px;
		font-family:Verdana, Geneva, sans-serif, serif;
	}
	.text {
		float:left;
		width:180px;
	}
	.dv {
		margin-bottom:5px;
	}
</style>
<body>
<div class="main">
	<div>
    	<img src="images/payumoney.png" />
    </div>
    <div>
    	<h3>PHP7 BOLT Kit</h3>
    </div>
	<form action="#" id="payment_form">
    <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
    <input type="hidden" id="surl" name="surl" value="<?php echo getCallbackUrl(); ?>" />
    <div class="dv">
    <span class="text"><label>Merchant Key:</label></span>
    <span><input type="text" id="key" name="key" placeholder="Merchant Key" value="qXgMhE" /></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Merchant Salt:</label></span>
    <span><input type="text" id="salt" name="salt" placeholder="Merchant Salt" value="MIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQDyPRl3hqBmegs/WZnqAnphMo+OxeB0GHti2UqW0sd4dm6xu+ZuPGjFs0OBR/ycLE2PKNe93DVxLEIg1bFrRUJDehQBJnwNyR6Tp+1RTzBpGDE1cPg8ip2YDZB56WDLevzqPW0vkMkhk1+Bn5KT/OWG1EUmpVIL/9stCbXxJHiVUiF3SOQiHzvul+Hj3GMi/PTCkU6FSAsRBJCoZQinjOR2XK5B5770vr3SdY5525n7V5T4vJfNMygBX3ejUEFDg/imOqV5SsJqxOlo8JVb1Xgc0oet+skKWzWo+Nt+z3Cr3WheQwiJeoKnTpexdjq8o+D3Ml72QJQyHGeQdTtjs8lRAgMBAAECggEBAJCtWVZ/+7D411rgwwJ2tGz067TUDjiInrjtGpV2EliqM3bHyNqyDcl2Ra0jN4Z3F2OXezMUIH8VdfFyb+KnnOn8MZJ2T8VUB4Uc2KqlZz59inZmoHxYNcOo5k9Jydv9+qxUP7AXA2mgQXyDt+HXO6cJhLuOJbCxAVCm6hm6NKLJH2ha5MkRlmGLpdI2yox7RrdH9Rpu/tzSz30gS1yZvDscuGcTLabfJPsSOtULrwhfmrgR93tTjojhKdHCR9HwEdlQyLH94j7WeQuEDyXlnhbEyMwgG94KlbisUzw0QLdl2vbzGvM+Sn0Cw+TZuZ0+gbNyYstInbqok5EJZldQDKECgYEA+fvtaZTgvopBKZwz9ByjyARbRxICxbzNu/aoDbio+GoYV9ThWMa9upXlmdGZAIXPnHvG/DOGT5Suz5jUYvaejPzqXE0wgP8Tf2hLFLlNl9qAbuweDMov2aXgrd04juZSDZaOjAfRwA4aTA9EdURx83F/13ceQ4AUsGawSp/7Ef0CgYEA+BF0ezgWS/qsdD+svst//XdWCOZQSg1fNWLnKXEdBsQYXSaQCpN6VgJR1i8rfE1X6yXnVv9N8lxJ+30v0hTpehfhLehDTQS3z62NKxM6X6lPu2HU8Hr9YftPqqo9LrAP8zdE0W+3toeW8Xi+m16v5pOnXraqOpgQLVlFiis9GuUCgYEA4nT3EGNe6R1DhJdNdUGQmPxhV9OYEVtFIJaEjNGQuGEcJkzhy1NWwrVR5nM6YH/XoFF85DEk5eiyJ7uyAuiYnu3qvKzsWJ86IXvwMBjhksPM/y8E1d8/U7JyA+7YcpNxF4AhJ/dZatsbtXVLNdRIShmyjxUIpGtd0qNj5mZgwl0CgYEAriujOvhwPzxrZNtoMDW1UYM+NtVuPfARjuw4HVK77Io2CQEQVTyiwkyypM1NnOK4/fMI8H4kfivqDdchgkEIhJ7LjW3sAuFzJS9XVI0ViSDZSFkyJv5TdT37+3m3p1YafMurV9k2hcPBaR07xt6+Zgf5lXhvIOCvSwfI2W/uYTkCgYAd7uMUmW1ZjKYvCC0YnTvl0Oa8DL+xxoVIMVBel1+e33cjUTwc2mcccdZwP7PwTofaofOI3KzvjTbSNRummBE/NsOR6LV3xKjQx9zku+ixAY0kPhoncoMPv1F6H+nT/TTiL2LxdjBcNR2ubFO0WkR+ppFNb3GmPEFR4CUAMwZCCw==" /></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Transaction/Order ID:</label></span>
    <span><input type="text" id="txnid" name="txnid" placeholder="Transaction ID" value="<?php echo  "Txn" . rand(10000,99999999)?>" /></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Amount:</label></span>
    <span><input type="text" id="amount" name="amount" placeholder="Amount" value="<?php if(isset($_SESSION['amount'])){echo $_SESSION['amount'];} ?>" /></span>    
    </div>
    
    <div class="dv">
    <span class="text"><label>Product Info:</label></span>
    <span><input type="text" id="pinfo" name="pinfo" placeholder="Product Info" value="P01,P02" /></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>First Name:</label></span>
    <span><input type="text" id="fname" name="fname" placeholder="First Name" value="<?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?>" /></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Email ID:</label></span>
    <span><input type="text" id="email" name="email" placeholder="Email ID" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];} ?>" /></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Mobile/Cell Number:</label></span>
    <span><input type="text" id="mobile" name="mobile" placeholder="Mobile/Cell Number" value="<?php if(isset($_SESSION['mobile'])){echo $_SESSION['mobile'];} ?>" /></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Hash:</label></span>
    <span><input type="text" id="hash" name="hash" placeholder="Hash" value="<?php echo $hash;?>" /></span>
    </div>
    
    
    <div><input type="submit" value="Pay" onclick="launchBOLT(); return false;" /></div>
	</form>
</div>
<script type="text/javascript"><!--
$('#payment_form').bind('keyup blur', function(){
	$.ajax({
          url: 'index.php',
          type: 'post',
          data: JSON.stringify({ 
            key: $('#key').val(),
			salt: $('#salt').val(),
			txnid: $('#txnid').val(),
			amount: $('#amount').val(),
		    pinfo: $('#pinfo').val(),
            fname: $('#fname').val(),
			email: $('#email').val(),
			mobile: $('#mobile').val(),
			udf5: $('#udf5').val()
          }),
		  contentType: "application/json",
          dataType: 'json',
          success: function(json) {
            if (json['error']) {
			 $('#alertinfo').html('<i class="fa fa-info-circle"></i>'+json['error']);
            }
			else if (json['success']) {	
				$('#hash').val(json['success']);
            }
          }
        }); 
});
//-->
</script>
<script type="text/javascript"><!--
function launchBOLT()
{
	bolt.launch({
	key: $('#key').val(),
	txnid: $('#txnid').val(), 
	hash: $('#hash').val(),
	amount: $('#amount').val(),
	firstname: $('#fname').val(),
	email: $('#email').val(),
	phone: $('#mobile').val(),
	productinfo: $('#pinfo').val(),
	udf5: $('#udf5').val(),
	surl : $('#surl').val(),
	furl: $('#surl').val(),
	mode: 'dropout'	
},{ responseHandler: function(BOLT){
	console.log( BOLT.response.txnStatus );		
	if(BOLT.response.txnStatus != 'CANCEL')
	{
		//Salt is passd here for demo purpose only. For practical use keep salt at server side only.
		var fr = '<form action=\"'+$('#surl').val()+'\" method=\"post\">' +
		'<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
		'<input type=\"hidden\" name=\"salt\" value=\"'+$('#salt').val()+'\" />' +
		'<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
		'<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
		'<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
		'<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
		'<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
		'<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
		'<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
		'<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
		'<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
		'</form>';
		var form = jQuery(fr);
		jQuery('body').append(form);								
		form.submit();
	}
},
	catchException: function(BOLT){
 		alert( BOLT.message );
	}
});
}
//--
</script>	

</body>
</html>
	
