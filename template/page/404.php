<?php 
$isHeader = Site::$isHeader;

$isPage = ((!is_null($params) and is_string($params)) ? " (<b><i>'{$params}'</i></b>) " : '');

if ($isHeader == false) {
	Site::addBodyClass('error-404');
	Site::getHeader(); 
}
?>

<section class="content-404">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6 order-lg-last text-center py-lg-5">
				<h1 class="pb-100">404</h1>
				<img class="img-fluid" src="assets/img/voeslauer-glas-high@2y.png" alt="">			
			</div>
			<div class="col-lg-6 col-xxl-5 offset-xxl-1">
				<p class="h1">Oops!</p>
				<p class="h1">Seite nicht gefunden</p>
				<p class="big mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent luctus convallis semper. Donec elementum dignissim ligula a gravida.</p>
				<a class="btn mt-5" href="<?php echo Site::url(); ?>" title="">zur homepage</a>
			</div>		
		</div>
	</div>
</section>

<?php if ($isHeader == false) Site::getFooter('footer'); ?>