<?php
include_once 'include/header.php';
?>
	<section class="body">
		<div class="contact-container">
			<h1>contact us</h1>
			<form>
				<input type="text" name="name" placeholder="Your Name" /><br/>
				<input type="text" name="email" placeholder="Email Address" /><br/>
				<textarea placeholder="Your Message..."></textarea><br/>
				<input type="submit" name="send" value="Send" />
			</form>

			<div class="right-content">
				<h2>satish web design</h2>
				<p>Kathmandu, Nepal</p><br/>
				<br/>
				<p>(+977)9860776653</p><br/>
				<br/>
				<p>satish4link@gmail.com</p><br/>
				<hr/>
				<br/>
				<p>You can also contact us on,</p>
				<ul>
					<li><a target="_blank" href="https://www.facebook.com/imperfect0"><img src="images/facebook.png" alt="facebook" /></a></li>
					<li><a target="_blank" href="https://www.linkedin.com/in/satish-chaudhary-63a261117/"><img src="images/linkedin.png" alt="linkedin" /></a></li>
					<li><a target="_blank" href="https://twitter.com/satish4link"><img src="images/twitter.png" alt="twitter" /></a></li>
					<li><a target="_blank" href="https://plus.google.com/u/0/112563613518147208817"><img src="images/googleplus.png" alt="google plus" /></a></li>
				</ul>
				<p>You can find us on this following map,</p>
				<br/>
			</div>
		</div>
		<div id="map" style="width:100%; height:500px;">
			You can also contact us here
		</div>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIgcrTjFDJCDExP-J3WSonI8Cg0Cu9gSg&callback=myMap"></script>
	</section>
<?php
include_once 'include/footer.php';
?>