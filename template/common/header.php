<!DOCTYPE html>
<html lang="<?php echo Site::$lang; ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="<?php echo Site::url(); ?>">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="shortcut icon" href="<?php echo Site::url('assets/img/favicon.ico'); ?>">
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;700&display=swap" rel="stylesheet">

	<title><?php echo Site::__('page_title'); ?></title>	

	<meta property="og:site_name" content="">
	<meta property="og:title" content="">
	<meta property="og:image" content="">
	<meta property="og:description" content="">

	<link rel="stylesheet" type="text/css" href="assets/css/style.min.css">

	<script type="text/javascript">
		var assetsPath = '';
	</script>
</head>

<body class="<?php echo Site::$bodyClass; ?>">

<header>

<?php Site::getSegment('navbar'); ?>

</header>

<main id="main" class="">
	
