<section class="container-fluid pt-5 rmvideos">
    <img src="assets/img/jpg/lab.jpg" alt="">
    <div class="container">
        <h3 class="col mb-3 font-weight-bolder pt-5">RM@Schools Videos on YouTube</h2>
    </div>
    <div class="videos container d-flex flex-column flex-md-row pb-5">
        <?php 
                for($i=1; $i <= 3; $i++){
                    Site::getSegment('video-card', 
                    array(
                    'video-card-url'=>'https://www.youtube.com/embed/0hZMXYTiWt4',
                    'video-card-desc'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, similique!',
                    ));
                }
            ?>
    </div>

</section>