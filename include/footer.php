<!-- Footer -->
<!-- Whats App button -->
<div class="whatsapp_bottom">
	<a href="https://wa.me/+9720503088409"> צור קשר <i class="fa fa-whatsapp"></i> </a>
</div>
<!--  Whats App Button  -->
<footer class="bg3 p-t-75 p-b-32">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30">
					קטגוריות
				</h4>

				<ul>
					<?php
					$stmt = $connect->prepare("SELECT * FROM categories");
					$stmt->execute();
					$allcat = $stmt->fetchAll();
					foreach ($allcat as $cat) {
					?>
						<li class="p-b-10">
							<a href="category_models?cat=<?php echo $cat['slug']; ?>" class="stext-107 cl7 hov-cl1 trans-04">
								<?php echo $cat['name']; ?>
							</a>
						</li>
					<?php
					}
					?>
				</ul>
			</div>

			<div class="col-sm-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30">
					עזרה
				</h4>

				<ul>
					<li class="p-b-10">
						<a href="shop" class="stext-107 cl7 hov-cl1 trans-04">
							כל הדגמים
						</a>
					</li>

					<li class="p-b-10">
						<a href="contact" class="stext-107 cl7 hov-cl1 trans-04">
							צור קשר
						</a>
					</li>
				</ul>
			</div>

			<div class="col-sm-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30">
					צור קשר
				</h4>

				<p class="stext-107 cl7 size-201">

				<ul>
					<li class="p-b-10">
						<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
							<i class="fa fa-phone"> + 9720505245003 </i>
						</a>
					</li>
					<li class="p-b-10">
						<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
							<i class="fa fa-whatsapp"> + 972050-3088409 </i>
						</a>
					</li>
				</ul>
				</p>

				<div class="p-t-27">
					<a href="https://www.facebook.com/Ldimporter" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
						<i class="fa fa-facebook"></i>
					</a>

					<a href="https://instagram.com/l.dimporter?igshid=OGQ5ZDc2ODk2ZA==" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
						<i class="fa fa-instagram"></i>
					</a>
				</div>
			</div>

			<div class="col-sm-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30 text-center">
					LD Importer
				</h4>
				<img style="margin: auto; display: block;" width="200px" src="images/logo.svg" alt="">
			</div>
		</div>

		<div class="p-t-40">
			<p class="stext-107 cl6 txt-center">
				<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				זכויות יוצרים &copy;<script>
					document.write(new Date().getFullYear());
				</script> כל הזכויות שמורות | עשוי מ <i class="fa fa-heart-o" aria-hidden="true"></i> על ידי <a href="https://wa.me/+201011642731" target="_blank">אדון</a>
				<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

			</p>
		</div>
	</div>
</footer>


<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
	<span class="symbol-btn-back-to-top">
		<i class="zmdi zmdi-chevron-up"></i>
	</span>
</div>

 

<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->

<!--===============================================================================================-->

<!--===============================================================================================-->
<script src="vendor/slick/slick.min.js"></script>
<script src="<?php echo $js; ?>/slick-custom.js"></script>
<!--===============================================================================================-->
<script src="vendor/parallax100/parallax100.js"></script>
<script>
	$('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<script>
	$('.gallery-lb').each(function() { // the containers for all your galleries
		$(this).magnificPopup({
			delegate: 'a', // the selector for gallery item
			type: 'image',
			gallery: {
				enabled: true
			},
			mainClass: 'mfp-fade'
		});
	});
</script>
<!--===============================================================================================-->
<script src="vendor/isotope/isotope.pkgd.min.js"></script>
<!-- nice vide -->
<script src='<?php echo $js; ?>/plyr.min.js'></script>
<!--===============================================================================================-->

<!--===============================================================================================-->
<script src="<?php echo $js; ?>/main.js"></script>
<script>
    const player = new Plyr('#player'); 
</script>
</body>

</html>