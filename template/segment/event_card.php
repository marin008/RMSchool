<div class="p-2 col-12 col-sm-6 col-md-4">
    <div class="event-card">
        <div class="mb-n2 overflow-hidden d-flex justify-content-center align-items-center">
            <img src="<?php echo $params["event-card-img"];?>" alt="">
        </div>
        <span class="card-date mt-n4 p-2">
            <?php echo $params["event-card-date"]; ?>
        </span>
        <div class="event-card-text p-4 my-3">
            <span class="row font-weight-bold"><?php echo $params["event-card-title"];?></span>
            <span class="row"><?php echo $params["event-card-subtitle"];?></span>
        </div>
        <button class="btn btn-outline-primary ml-2">More details</button>
    </div>
</div>