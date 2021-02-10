<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Sistema de Gestión de la Innovación de Atlántica Agrícola">
    <meta name="author" content="Iván Navarro">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
	<meta property="og:site_name" content="" /> <!-- website name -->
	<meta property="og:site" content="" /> <!-- website link -->
	<meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
	<meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
	<meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
	<meta property="og:url" content="" /> <!-- where do you want your post to link to -->
	<meta property="og:type" content="article" />

    <!-- Website Title -->
    <title><?=$data['page_tag']?></title>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,600,700,700i&amp;subset=latin-ext" rel="stylesheet">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Front CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Assets/front/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Assets/front/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Assets/front/css/swiper.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>Assets/front/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Assets/front/css/styles.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Assets/front/css/mystyles.css">
	
	<!-- Favicon  -->
    <link rel="icon" href="<?= base_url();?>Assets/front/images/favicon.ico">
</head>

<body data-spy="scroll" data-target=".fixed-top">
    
    <!-- Preloader -->
	<div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- end of preloader -->
    

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <!-- Text Logo - Use this if you don't have a graphic logo -->
        <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Evolo</a> -->

        <!-- Image Logo -->
        <a class="navbar-brand logo-image" href="<?= base_url();?>"><img src="<?= base_url();?>Assets/front/images/logo.jpg" alt="Atlántica Agrícola"></a>
        
        <!-- Mobile Menu Toggle Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-awesome fas fa-bars"></span>
            <span class="navbar-toggler-awesome fas fa-times"></span>
        </button>
        <!-- end of mobile menu toggle button -->

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#header">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" title="Solicitudes" href="#services">Solicitudes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" title="Panel de Control" href="<?= base_url();?>dashboard"><i class="fa fa-home fa-lg"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" title="Perfil" href="<?= base_url();?>usuarios/perfil"><?php echo $_SESSION['userData']['nombre']." ".$_SESSION['userData']['apellidos'];?></a>
                </li>
            </ul>
        </div>
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->
    <!-- Header -->
    <header id="header" class="header">
        <div class="header-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="text-container">
                            <h1><span class="turquoise">Gestión de la Innovación</span></h1>
                            <p>Descubre una nueva manera de comunicar</p>
                            <p>tus necesidades en <strong> I+D+i</strong></p>
                            <a class="btn-solid-lg page-scroll" href="#services">VER</a>
                        </div> <!-- end of text-container -->
                    </div> <!-- end of col -->
                    <div class="col-lg-6">
                        <div class="image-container">
                            <img class="img-fluid" src="<?= base_url();?>Assets/front/images/plant.png" alt="">
                        </div> <!-- end of image-container -->
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of header-content -->
      </header> <!-- end of header -->
    <!-- end of header -->