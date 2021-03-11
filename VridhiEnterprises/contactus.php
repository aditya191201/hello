<?php
//index.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\PHPMailer\src\Exception.php';
require 'C:\PHPMailer\src\PHPMailer.php';
require 'C:\PHPMailer\src\SMTP.php';

$error = '';
$name = '';
$email = '';
$message = '';
$email_from = 'ishansarode95@gmail.com';
$to = 'ishansarode95@gmail.com';
$headers = "From: $email_from \r\n";
$email_subject = "Form Submission by: $name";
$headers .= "Reply-To: $email \r\n";



function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["email"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }
 if(empty($_POST["message"]))
 {
  $error .= '<p><label class="text-danger">Message is required</label></p>';
 }
 else
 {
  $message = clean_text($_POST["message"]);
 }

 if($error == '')
 {
  $file_open = fopen("contact_data.csv", "a");
  $no_rows = count(file("contact_data.csv"));

  $mail = new PHPMailer;

  $mail->isSMTP();                      // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;               // Enable SMTP authentication
  $mail->Username = 'dumbon14@gmail.com';   // SMTP username
  $mail->Password = 'ishan1414';   // SMTP password
  $mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 587;                    // TCP port to connect to

  $mail->setFrom('dumbon14@gmail.com', 'CodexWorld');
  $mail->addReplyTo($email);

  // Add a recipient
  $mail->addAddress('dumbon14@gmail.com');
  $mail->isHTML(true);

  // Mail subject
  $mail->Subject = $name;
  $mail->Body    = $message;


  if(!$mail->send()) {
      echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
  } else {
      echo 'Message has been sent.';
  }

  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'sr_no'  => $no_rows,
   'name'  => $name,
   'email'  => $email,
   'message' => $message
  );
  fputcsv($file_open, $form_data);
  $error = '<label class="text-success">Thank you for contacting us</label>';
  $name = '';
  $email = '';
  $message = '';
 }
}

?>

<!DOCTYPE html>
<!-- Created By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Vridhi Enterprises</title>
    <link rel="icon" href="img/logos.png" type="image/x-icon" class="logo" />
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/nav.css">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="static/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="static/css/mdb.min.css" rel="stylesheet">

</head>
<body>
  <nav class="navb">
    <div class="content">
      <a href="#" class="logo-align"><img src="img/logo.webp" class="logo-out"></a>
      <ul class="menu-list">
        <div class="icon cancel-btn">
          <i class="fas fa-times"></i>
        </div>
        <li class="items"><a href="index.html">Home</a></li>
        <li class="items"><a href="horeca.html">Horeca Products</a></li>
        <li class="items" id="ima"><a href="index.html" ><img src="img/logo.webp" class="logo-in"></a></li>
        <li class="items"><a href="aboutus.html">About Us</a></li>
        <li class="items"><a href="tamys.html">Tamy's</a></li>
        <li class="items"><a href="contactus.php" class="active">Contact Us</a></li>
      </ul>
      <ul class="nav navbar-right">
        <li class="nav-item one"><a href="https://www.facebook.com/Vridhi-Enterprises-Food-Processing-100923131560687/?modal=suggested_action&notif_id=1609788843626906&notif_t=page_user_activity&ref=notif" class="nav-link" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
        <li class="nav-item two"><a href="https://www.instagram.com/vridhi_enterprises_pune/" class="nav-link" target="_blank"><i class="fab fa-instagram"></i></a></li>
        <li class="nav-item three"><a href="#" class="nav-link" target="_blank"><i class="fab fa-linkedin"></i></a></li>
      </ul>

      <div class="icon menu-btn">
        <i class="fas fa-bars"></i>
      </div>

    </div>

  </nav>
  <div class="banner"></div>

  <header>
    <section class="map">
      <div id="map-container-demo-section" class="z-depth-1-half map-container-section mb-4" style="height: 70vh">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.2569125361074!2d73.77047201472132!3d18.562452687384603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2bec9f49c83cd%3A0x4b34a99b708e98c8!2sVridhi%20Enterprises!5e0!3m2!1sen!2sin!4v1610462781177!5m2!1sen!2sin" frameborder="0" style="border:0"></iframe>
      </div>
    </section>

  </header>

<div class="cards">

<section class="disinfo">
  <div class="container">
    <h1 class="info">GET TO US AT...</h1>
    <div class="row">
      <div class="col-lg-4">
        <p class="image"><img id="one" src="img/images.jpg" alt=""></p>
        <p class="txt"> 601, Sierra Vista, Veerbhadhra Nagar, Lane No. 5 Shri Krishna Housing Society, Opposite Paranjape Yutika, Near Ganaraj Mangal Karyalay, Baner, Pune-411045, Maharashtra, India</p>
      </div>

      <div class="col-lg-4">
        <p class="image"><img id="two" src="img/download2.png" alt=""></p>
        <p class="txt"><a href="mailto:vridhibiz@gmail.com?subject=Mail" class="call">vridhibiz@gmail.com</a></p>
      </div>

      <div class="col-lg-4">
        <p class="image"><img id="three" src="img/download3.png" alt=""></p>
        <p class="txt"><a href="tel:+919527720097" class="call">+91 9527720097</a></p>
        <p class="txt"><a href="tel:+919767148118" class="call">+91 9767148118</a></p>
        <p class="txt"><a href="tel:+917722040917" class="call">+91 7722040917</a></p>
      </div>
    </div>
</section>

</div>

<div>
<section class="bg" style="background: linear-gradient(rgba(255,255,255,.1), rgba(255,255,255,.1)),url(./img/newspices3.jpg)">
  <div class="container" id="forms">
    <div class="text">Leave Us A Message</div>
    <form method="post">
      <div class="xxx"><?php echo $error; ?></div>
      <div class="form-row">
        <div class="input-data">
          <input type="text" name="name" value="<?php echo $name; ?>" />
          <div class="underline">
          </div>
          <label for="">Name</label>
        </div>
      </div>

      <div class="form-row">
        <div class="input-data">
          <input type="text" name="email" value="<?php echo $email; ?>" />
          <div class="underline">
          </div>
          <label for="">Email Address</label>
        </div>
      </div>

      <div class="form-row">
        <div class="input-data textarea">
          <textarea name="message" required><?php echo $message; ?></textarea>
          <br />
          <div class="underline">
          </div>
          <label for="">Write your message</label>
          <br />
        </div>
      </div>

      <div class="form-row submit-btn">
        <div class="input-data">
          <div class="inner"></div>
          <input type="submit" name="submit" value="submit">
        </div>
      </div>
    </form>
  </div>

</section>
</div>

<footer style="background-color:#262626;">
    <div class="footer_vridhi">
      <div class="image-area-footer">
        <div class="single-image-footer"><img src="./img/FSSAI_logo_dark.png" alt="FSSAI_logo"></div>
        <div class="single-image-footer"><img src="./img/ISO-Logo.png" alt="ISO-Logo"></div>
      </div>
    </div>
    <div class="copyright-footer">
      <p>Copyright © 2019 Vridhi Enterprises - All Rights Reserved.</p>
    </div>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  <script>
    const body = document.querySelector("body");
    const navb = document.querySelector(".navb");
    const menuBtn = document.querySelector(".menu-btn");
    const cancelBtn = document.querySelector(".cancel-btn");
    const bar = document.querySelector(".bar-img");
    const drop = document.querySelector(".drop-img")

    menuBtn.onclick = ()=>{
      navb.classList.add("show");
      menuBtn.classList.add("hide");
      body.classList.add("disabled");
    }
    cancelBtn.onclick = ()=>{
      body.classList.remove("disabled");
      navb.classList.remove("show");
      menuBtn.classList.remove("hide");

    }
    window.onscroll = ()=>{
      this.scrollY > 20 ? navb.classList.add("sticky") : navb.classList.remove("sticky");
    }
  </script>
