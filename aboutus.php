<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>About Us</title>
        <link rel="icon" href="img/favicon.ico">
        <!-- CSS FILES -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/uikit@latest/dist/css/uikit.min.css">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/index.css">


        <style>
            .lead {
                font-size: 1.175em;
                font-weight: 300;
            }
            .uk-logo img {
                height: 28px;
            }
        </style>
    </head>
    <body>
        <?php include "timeout.inc.php"; ?>
        <div class="top-wrap uk-position-relative pb-40"> 
     
            <?php include "nav.inc.php";?>
       		
		<div class="uk-grid-medium " uk-grid>
		<div class="mt-24 ml-40 ">
		<h1 class="k-heading-primary font-bold text-4xl ">About Our Company </h1>
		<p class="text-base mt-4 w-3/4 text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec tellus felis. Phasellus fringilla 
			finibus turpis id commodo. Vivamus eu nisl sit amet tellus consequat gravida. Sed lobortis mattis eros, in luctus ex porttitor quis. Proin laoreet
			lacus neque, a pellentesque dui porttitor eget. Pellentesque congue, tortor viverra suscipit pretium, </p>
			  <img src="images/about_us.jpg" class="h-auto w-3/4 mt-12 "></div>
    		</div>

			<div class="mt-24 ml-40 flex">
			<img src="images/about_us2.jpg" class="h-auto w-1/4 ">
			<div class="row">
			<h1 class="k-heading-primary font-bold text-4xl ml-12">Our Concept </h1>
			<p class="text-base ml-12 mt-4 w-3/4 text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec tellus felis. Phasellus fringilla 
			finibus turpis id commodo. Vivamus eu nisl sit amet tellus consequat gravida. Sed lobortis mattis eros, in luctus ex porttitor quis. Proin laoreet
			lacus neque, a pellentesque dui porttitor eget. Pellentesque congue, tortor viverra suscipit pretium, </p></div>
			  </div>

    		</div>
		</div>       
        </section>

	
		<section class="uk-section uk-section-default">
			<div class="uk-grid-divider uk-child-width-expand@s p-24" uk-grid>
			<h1 class="k-heading-primary font-bold text-4xl ml-12">Why People Choose Us </h1>

		<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
		<div>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
</div>
		</section>
        
        <?php include "footer.inc.php"; ?>
        <!-- JS FILES -->
        <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
    </body>
</html>