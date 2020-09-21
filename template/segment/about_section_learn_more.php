<section class="about-learn-more container-fluid">
    <img src="assets/img/jpg/internet.jpg" class="pozadina" alt="">
    <div class="container">
        <h3 class="col font-weight-bold">Learn more about RM@Schools</h3>
        <p class="col">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi culpa consequatur nesciunt doloremque, dolore vitae alias, eum nihil cum quidem dolorem aut illo a minima!</p>
        
        <div class="about-cards col d-flex flex-column flex-md-row justify-content-center align-items-center">
           <?php 
           for($i=1; $i <= 3; $i++){
            Site::getSegment('about_card', 
            array(
            'about-card-img'=>'assets/img/jpg/kartica.jpg',
            'about-card-title'=>'OUR NETWORK',
            'about-card-text' =>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi culpa consequatur nesciunt doloremque, dolore vitae alias, eum nihil cum quidem dolorem aut illo a minima!',
            ));
        }
           ?>
        </div>
        
        
    </div>
</section>