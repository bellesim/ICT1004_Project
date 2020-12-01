<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Marketing - UIkit 3 KickOff</title>
		<link rel="icon" href="img/favicon.ico">
		<!-- CSS FILES -->
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/uikit@latest/dist/css/uikit.min.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

	</head>
	<body>
		<!-- TOP -->
		<!--<div class="top-wrap uk-position-relative uk-light uk-background-secondary"> !-->
        <div class="top-wrap uk-position-relative" uk-background-primary style="background-color: #515151;"> 
        <div class="uk-flex uk-flex-center uk-flex-middle h-20">
            <?php include "nav.inc.php";?>
            </div>
        </div>
	<!-- /TOP -->
		<section id="content" class="uk-section uk-section-default">
			<div class="uk-container">
				<div class="uk-section uk-section-small uk-padding-remove-top">
					<ul class="uk-subnav uk-subnav-pill uk-flex uk-flex-center" data-uk-switcher="connect: .uk-switcher; animation: uk-animation-fade">
						<li><a class="rounded" href="#">About Us</a></li>
						<li><a class="rounded" href="#">Our services</a></li>
					</ul>
				</div>

				<ul class="uk-switcher uk-margin">
					<li>
						<div class="uk-grid uk-child-width-1-2@l uk-flex-middle" data-uk-grid data-uk-scrollspy="target: > div; cls: uk-animation-slide-left-medium">
							<div>
                                <img src="images/indeximage.png" alt="aboutus"data-uk-img>
                            </div>
							<div data-uk-scrollspy-class="uk-animation-slide-right-medium">
								<h2 class="font-semibold text-4xl">Who are we?</h6>
								<p class="subtitle-text">
									Clinic Finder offers a comprehensive range of primary healthcare services through our clinics located island-wide. 
                                                                        Our experienced medical team consisting of doctors, specialists, nurses and phlebotomists seek to provide quality care
                                                                        in an enriching, welcoming and tech-enabled environment.
								</p>
								
							</div>
						</div>
					</li>
					<li>
						<div class="uk-grid uk-child-width-1-2@l uk-flex-middle" data-uk-grid data-uk-scrollspy="target: > div; cls: uk-animation-slide-left-medium">
							<div>
								<img src="images/aboutus2.png" alt="services" data-uk-img>
							</div>
							<div data-uk-scrollspy-class="uk-animation-slide-right-medium">
								<h6 class="uk-text-primary">Services we provide</h6>
								<h2 class="uk-margin-small-top">Take decisions with real time data based on users interaction.</h2>
								<p class="subtitle-text">
									Clinic Finder is a platform application where selected partnered clinics are gathered for Clinic Finder's members easier reference 
                                                                        be able to select their preferred clinics and make an appointment straight from this website. Saves users time and ensures users satisfactory.
								</p>
								
							</div>
						</div>
					</li>
					
				</ul>
				
				
			</div>
		</section>

		<section class="uk-cover-container overlay-wrap">
			<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="https://picsum.photos/640/650/?image=770 640w,
			https://picsum.photos/960/650/?image=770 960w,
			https://picsum.photos/1200/650/?image=770 1200w,
			https://picsum.photos/2000/650/?image=770 2000w"
			data-sizes="100vw"
			data-src="https://picsum.photos/1200/650/?image=770" alt="" data-uk-cover data-uk-img
			>
			<div class="uk-container uk-position-z-index uk-position-relative uk-section uk-section-xlarge uk-light">
				<div class="uk-grid uk-flex-right">
					
					
					
				</div>
			</div>
		</section>

		<!-- LOGOS -->
		<div class="uk-section uk-section-small uk-section-muted">
			<div class="uk-container uk-container-small">
				<div class="uk-grid uk-child-width-1-4 uk-child-width-expand@m logos-grid" data-uk-grid data-uk-scrollspy="cls: uk-animation-scale-down; target: > div > img; delay: 100">
					<div>
						<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="img/logo-1.svg" data-uk-img alt="Image">
					</div>
					<div>
						<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="img/logo-2.svg" data-uk-img alt="Image">
					</div>
					<div>
						<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="img/logo-3.svg" data-uk-img alt="Image">
					</div>
					<div>
						<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="img/logo-6.svg" data-uk-img alt="Image">
					</div>
					<div>
						<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="img/logo-7.svg" data-uk-img alt="Image">
					</div>
					<div>
						<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="img/logo-8.svg" data-uk-img alt="Image">
					</div>
					<div>
						<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="img/logo-4.svg" data-uk-img alt="Image">
					</div>
					<div>
						<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="img/logo-5.svg" data-uk-img alt="Image">
					</div>
				</div>
			</div>
		</div>
		<!-- /LOGOS -->
		
		<!-- OFFCANVAS -->
		<div id="offcanvas-nav" data-uk-offcanvas="flip: true; overlay: false">
			<div class="uk-offcanvas-bar uk-offcanvas-bar-animation uk-offcanvas-slide">
				<button class="uk-offcanvas-close uk-close uk-icon" type="button" data-uk-close></button>
				<ul class="uk-nav uk-nav-default">
					<li class="uk-active"><a href="#">Active</a></li>
					<li class="uk-parent">
						<a href="#">Parent</a>
						<ul class="uk-nav-sub">
							<li><a href="#">Sub item</a></li>
							<li><a href="#">Sub item</a></li>
						</ul>
					</li>
					<li class="uk-nav-header">Header</li>
					<li><a href="#js-options"><span class="uk-margin-small-right uk-icon" data-uk-icon="icon: table"></span> Item</a></li>
					<li><a href="#"><span class="uk-margin-small-right uk-icon" data-uk-icon="icon: thumbnails"></span> Item</a></li>
					<li class="uk-nav-divider"></li>
					<li><a href="#"><span class="uk-margin-small-right uk-icon" data-uk-icon="icon: trash"></span> Item</a></li>
				</ul>
				<h3>Title</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			</div>
		</div>
		 <?php include "footer.inc.php"; ?>

        <!-- JS FILES -->
        <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
    </body>
</html>
