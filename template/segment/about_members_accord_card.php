<div class="card">
    <div class="card-header" id="<?php echo $params["accord-index"];?>">
    
        <div class="d-flex" type="button" role="button" data-toggle="collapse" data-target="#<?php echo $params["accord-target"];?>" aria-expanded="false" aria-controls="<?php echo $params["accord-target"];?>">
            <div class="card-title col d-flex justify-content-between align-items-center px-0 py-2">
                <div class="left d-flex flex-column">
                    <h4 class="font-weight-bold my-2"><?php echo $params["accord-title"];?></h4>
                    <h5 class="font-weight-light"><?php echo $params["accord-country"];?></h5>
                </div>
                <div class="right">
                    <button class="btn"></button>
                </div>
            </div>
        </div>
    
    </div>

    <div id="<?php echo $params["accord-target"];?>" class="collapse" aria-labelledby="<?php echo $params["accord-index"];?>" data-parent="#accordionExample">
        <div class="card-body p-0 py-4 m-0">
            <p class="mb-2"><?php echo $params["accord-text"];?></p>
            <div class="btn btn-success my-3"><a href="#"><?php echo $params["accord-link"];?></a></div>
        </div>
    </div>
</div>

   

