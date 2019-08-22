<html>
	<head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./../styles/bootstrap.css">
		
        <link rel="stylesheet" href="./../styles/styles.css">
        <link rel="stylesheet" href="./styles/style.css">
        <link rel="stylesheet" href="./styles/registerlogin.css">
        <title>Question</title>
	</head>
	<body>
		<div>
            <?php include './../header.php' ?>   
        </div>
        <div class="container box">
            <div class="row">
				<div class="col-11 col-sm-11 col-md-10 col-lg-5 col-xl-5 membershipcard">4$ <br>One Question</div>
				<div class="membershipcard">20$ <br>Ten Questions</div>
			</div>      
			<div>
				<button onclick="showpayment()">Proceed to buy</button>
			</div>
        
<!-- =======================================================================================================================================================================
======================================================================================================================================================================= -->
                                                          <!-- Payment Paypal -->
<!-- =======================================================================================================================================================================
======================================================================================================================================================================= -->
			<div id="paypalpayment" style="display:none">
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="JU3JFGURB7N26">
					<table>
						<tr>
							<td>
								<input type="hidden" name="on0" value="Choose Your Plan">Choose Your Plan
							</td>
						</tr>
						<tr>
							<td>
								<select name="os0">
									<option value="1 Question">1 Question : $4.00 USD - monthly</option>
									<option value="10 Questions">10 Questions : $20.00 USD - monthly</option>
								</select> 
							</td>
						</tr>
					</table>
					<input type="hidden" name="currency_code" value="USD">
					<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>

<!-- =======================================================================================================================================================================
======================================================================================================================================================================= -->

		</div>
		<?php include './../footer.php' ?>
        
    </body>
</html>

<script>
	function showpayment(){
		var x = document.getElementById("paypalpayment");
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}
</script>