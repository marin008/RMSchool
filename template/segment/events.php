<section class="container-fluid events">
    <div class="container">
        <h2 class="col mb-3 font-weight-bolder">Events</h2>
        <p class="col text-justify mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore quidem sapiente recusandae ab. Libero ducimus nobis consequatur natus earum aspernatur aperiam! Nam illum nostrum rerum?</p>
        <div class="filter-events pt-5">
            <button class="btn btn-outline-success filter-events-title">Filter Events</button>
            <button class="btn btn-outline-success">Upcoming</button>
            <button class="btn btn-outline-success">Past</button>
        </div>

        <div class="event-cards pt-3 d-flex flex-wrap justify-content-between align-items-center">
            <?php 
                for($i=1; $i <= 3; $i++){
                    Site::getSegment('event_card', 
                    array(
                    'event-card-display'=>'event-card-hide',
                    'event-card-date'=>'9.11.2020.',
                    'event-card-title'=>'The future of Education',
                    'event-card-subtitle' =>'Virtual Conference',
                    'event-card-img' => 'assets/img/jpg/placeholder.jpg'
                    ));
                }
                for($i=1; $i <= 3; $i++){
                    Site::getSegment('event_card', 
                    array(
                    'event-card-display'=>'event-card-show',
                    'event-card-date'=>'9.11.2020.',
                    'event-card-title'=>'The future of Education',
                    'event-card-subtitle' =>'Virtual Conference',
                    'event-card-img' => 'assets/img/jpg/placeholder.jpg'
                    ));
                }
            ?>
        </div>
        <div class="d-flex justify-content-end p-5">
            <button class="btn btn-outline-primary ml-2">Show all events</button>
        </div>

        <div class="p-4 d-flex flex-wrap flex-column flex-sm-row align-items-center justify-content-between">
            <button class="btn btn-outline-primary ml-2 mt-4 become-button font-weight-light col-12 col-sm-5 col-md-6 col-lg-5">Become an <span class="font-weight-bold row m-0">rm ambassador</span></button>
            <button class="btn btn-outline-success ml-2 mt-4 become-button font-weight-light text-align-justify col-12 col-sm-5 col-md-6 col-lg-5">Become a <span class="font-weight-bold">young <span class="row m-0">rm ambassador</span></span></button>
        </div>
    </div>
   
</section>