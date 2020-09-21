<div class="about-card col col-sm-12 col-md-6 col-lg-4 d-flex flex-column justify-content-center mx-3">
    <a href="<?php echo $params["about-card-link"];?>">
        <div class="card-img">
            <img src="<?php echo $params["about-card-img"];?>" alt="">
            <div class="card-title">
                <h3><?php echo $params["about-card-title"];?></h3>
            </div>
        </div>
        
            <div class="card-text d-flex flex-column justify-content-center p-5"><?php echo $params["about-card-text"];?></div>
        <div class="d-flex justify-content-end align-items-center">
            <div class="card-button btn btn-outline-primary font-weight-bold"> Learn More</div>
        </div>
    </a>
</div>