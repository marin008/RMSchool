<section class="about-network container-fluid">
    
    <div class="container">

        <h3 class="col font-weight-bold color-primary">Headline here</h3>
        <p class="col color-primary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident a dolores velit neque autem consequatur animi atque, cum tempore ad omnis asperiores recusandae necessitatibus eum. Ratione non, tenetur suscipit praesentium eligendi omnis commodi a, et quos asperiores distinctio corporis? Hic, tempore natus assumenda repellat accusantium unde quam aut nulla consequatur.</p>
        
        <div class="about-cards col d-flex flex-column flex-md-row justify-content-center align-items-center">
           <?php 
           for($i=1; $i <= 3; $i++){
            Site::getSegment('about_card', 
            array(
            'about-card-img'=>'assets/img/jpg/kartica.jpg',
            'about-card-title'=>'OUR NETWORK',
            'about-card-text' =>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi culpa consequatur nesciunt doloremque, dolore vitae alias, eum nihil cum quidem dolorem aut illo a minima!',
            'about-card-link'=>'about-network'
            ));
        }
           ?>
        </div>
        
        
    </div>
</section>