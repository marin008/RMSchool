<section class="container-fluid ambassadors">
    <div class="container">
        <h2 class="col mb-3 font-weight-light">Young RM ambassadors in action</h2>
        <p class="col text-justify mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore quidem sapiente recusandae ab. Libero ducimus nobis consequatur natus earum aspernatur aperiam! Nam illum nostrum rerum?</p>
        <div class="d-flex flex-wrap justify-content-between align-items-center">         
            <?php 
                for($i=1; $i <= 4; $i++){
                    Site::getSegment('ambassadors-card', 
                    array(
                    'ambassadors-card-date'=>'9.11.2020.',
                    'ambassadors-card-title'=>'Topic 1',
                    'ambassadors-card-img' => 'assets/img/jpg/placeholder.jpg'
                    ));
                }
            ?>
        </div>
        
        <div class="row d-flex justify-content-end pr-3 pt-5">
            <a href="#!" class="btn btn-outline-white">Show More</a>
        </div>
    </div>
   
</section>