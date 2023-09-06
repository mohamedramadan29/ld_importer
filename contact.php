<?php
ob_start();
session_start();
include "init.php";
?>
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-140" style="background-image: url('images/contact.png');">
	<h2 class="ltext-105 cl0 txt-center">
		צור קשר
	</h2>
</section>
<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
	<div class="container">
		<?php
		function sanitizeInput($input)
		{
			// Use appropriate sanitization or validation techniques based on your requirements
			$sanitizedInput = htmlspecialchars(trim($input));
			return $sanitizedInput;
		}
		if (isset($_POST['send_message'])) {
			$name = sanitizeInput($_POST['name']);
			$subject = sanitizeInput($_POST['subject']);
			$email = sanitizeInput($_POST['email']);
			$message = sanitizeInput($_POST['message']);
			$formerror = [];
			if (empty($name) || empty($email) || empty($message)) {
				$formerror[] = 'נא להזין מידע מלא';
			}
			if (empty($formerror)) {
				$stmt = $connect->prepare("INSERT INTO contact_us (name,email,subject,message)
                    VALUES(:zname,:zemail,:zsubject,:zmessage)
                    ");
				$stmt->execute(array(
					"zname" => $name,
					"zsubject" => $subject,
					"zemail" => $email,
					"zmessage" => $message,
				));
				if ($stmt) {
					$to = "info@ldimporter.com";
					$subject = $subject . " /// " . $email;
					$message = $message;
					$headers = "From: info@ldimporter.com";

					// Send the email
					$mailSent = mail($to, $subject, $message, $headers);


		?>
					<div class="alert alert-success"> הודעה שליחת הצלחה </div>
				<?php
					header('refresh:3;url=contact');
				}
			} else {
				?>
				<div class="alert alert-danger"> Please Enter All Informations </div>
		<?php
			}
		}
		?>
		<div class="flex-w flex-tr">

			<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
				<form method="post" action="">
					<h4 class="mtext-105 cl2 txt-center p-b-30">
						השאירו פרטים ואנו ניצור אתכם קשר
					</h4>
					<div class="bor8 m-b-20 how-pos4-parent">
						<input class="stext-111 cl2 plh3 size-116 p-r-30 p-lr-10" type="text" name="name" placeholder="שם מלא">
					</div>
					<div class="bor8 m-b-20 how-pos4-parent">
						<input class="stext-111 cl2 plh3 size-116 p-r-30 p-lr-10" type="email" name="email" placeholder="מייל">
					</div>

					<div class="bor8 m-b-20 how-pos4-parent">
						<input class="stext-111 cl2 plh3 size-116 p-r-30 p-lr-10" type="text" name="subject" placeholder="טלפון">
					</div>

					<div class="bor8 m-b-30">
						<textarea class="stext-111 cl2 plh3 size-120 p-lr-10 p-tb-25" name="message" placeholder=" כתוב לנו"></textarea>
					</div>

					<button name="send_message" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
						שלחו
					</button>
				</form>
			</div>

			<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
				<div class="flex-w w-full p-b-42">
					<span class="fs-18 cl5 txt-center size-211">
						<span class="lnr lnr-map-marker"></span>
					</span>

					<div class="size-212 p-t-2">
						<span class="mtext-110 cl2">
							כתובת
						</span>

						<p class="stext-115 cl6 size-213 p-t-18">
							גדיידה מכר 1007 ישראל
						</p>
					</div>
				</div>

				<div class="flex-w w-full p-b-42">
					<span class="fs-18 cl5 txt-center size-211">
						<span class="lnr lnr-phone-handset"></span>
					</span>

					<div class="size-212 p-t-2">
						<span class="mtext-110 cl2">
							צור קשר
						</span>

						<p class="stext-115 cl1 size-213 p-t-18">
							0505245003
						</p>
					</div>
				</div>

				<div class="flex-w w-full">
					<span class="fs-18 cl5 txt-center size-211">
						<span class="lnr lnr-envelope"></span>
					</span>

					<div class="size-212 p-t-2">
						<span class="mtext-110 cl2">
							אימייל
						</span>

						<p class="stext-115 cl1 size-213 p-t-18">
							info@ldimporter.com
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
include $tem . "footer.php";
ob_end_flush();

?>