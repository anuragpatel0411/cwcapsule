<html>
	<head>
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./styles/bootstrap.css">
		<link rel="stylesheet" href="./styles/styles.css">
		<link rel="stylesheet" href="./styles/registerlogin.css">
	</head>
	<body class="body1">
		<?php include 'header.php' ?>
			<div class="container homeBanner">
				<div class="img1">
					<div class="row justify-content-center fullscreen align-items-center">
						<div class="col-lg-5 col-md-8 homeBannerLeft">
							<h1 class="text-white">
								Get the Right Answers<br/>
								For all Your Questions
							</h1>
							<p class="mx-auto text white mt-20 mb-40">
								Best plantform to provide solutions for all your problems.
							</p>
						</div>
						<!--<div class="offset-lg-2 col-lg-5 col-md-12 homeBannerRight">
							<img class="imgBooks" src="./images/bannerHome.png" alt="Books with a pen">
						</div> -->
					</div>
				</div>
			</div>
			<div class="container homeBody">
				<div class="intro">
					<div>
						<h1>
							Introduction 
					    </h1>
					</div>
					<div>
						<p>
							CW Capsule is the platform where students can post there questions and get the answers of their questions by qualified teachers. 
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-xs-12">
						<div id="std">
                            <div>
								<h1>
									Students
								</h1>
							</div>
							<div>
								<p>
									CW Capsule is the platform where students can post all there queries and get answer of their questions by qualified professional teachers.
								</p>
							</div>
                        </div>
					</div>
					<div class="col-sm-6 col-xs-12">
						<div id="tech">
							<div>
								<h1>
									Teacher
								</h1>
							</div>
							<div>
								<p>
									Teachers can help students by solving their queries and also get rewarded for that.
								</p>
							</div>
						</div>
					</div>
				</div>
				<div id="about">
					<div>
						<h1>
							About Us
						</h1>
					</div>
					<div>
						<p>We at CW Capsule provide an online platform for students to post questions and get answers whereas teachers can answer the questions of students and get rewarded.</p>
					</div>
				</div>
				<div id="contact">
					<div>
						<h1>
							 Contact Us
						</h1>
					</div>
					<div>
						<div class="row">
							<div class="col-sm-offset-1 col-sm-5">
								<div>
									<h3>
										Contact Information
									</h3>
								</div>
								<div>
									<p>
										309/T11, Ghaziabad, Uttar Pradesh 201015
									</p>
								</div>
								<div>
									<span>&#9742</span>077019 40126
								</div>
								<div>
									<span>&#9993</span>
									cwcapsule@gmail.com
								</div>
							</div>
							<div class="col-sm-5">
								<div>
									<h3>
										Leave Us a Message Here
									</h3>
								</div>
								<form method="post">
									<div class="row">
										<div class="col-sm-6 col-xs-12">
											<div>
												<input type="text" id="fname" class="formInput" placeholder="First Name" name="fname">
											</div>
										</div>
										<div class="col-sm-6 col-xs-12">
											<div>
												<input type="text" id="lname" class="formInput" placeholder="Last Name" name="lname">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6 col-xs-12">
											<div>
												<input type="email" id="email" class="formInput" placeholder="Email Address " name="email">
                                            </div>
										</div>
										<div class="col-sm-6 col-xs-12">
											<div>
												<input type="text" id="phone" class="formInput" placeholder="Telephone Number" name="phone">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div>
												<textarea rows="7" id="msg" class="formInput" placeholder="Type Your Message Here..." name="msg"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div>
												<input type="submit" class="submitButton" value="Send Message" name="submitTeacher">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php include 'footer.php' ?>
	</body>
</html>