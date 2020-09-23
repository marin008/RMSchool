<section class="about-eu-members-list">
    <div class="container">

        <!-- Accordion -->

        <div class="accordion" id="accordionExample">
            <!-- Accordion card -->
            <div class="card">
                <div class="card-header" id="headingOne">
                
                    <div class="d-flex" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <div class="card-title col d-flex justify-content-between align-items-center px-0 py-2">
                            <div class="left d-flex flex-column">
                                <h4 class="font-weight-bold my-2">Lorem Ipsum</h4>
                                <h5 class="font-weight-light">COUNTRY</h5>
                            </div>
                            <div class="right">
                                <button class="btn"></button>
                            </div>
                        </div>
                    </div>
               
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body p-0 py-4 m-0">
                        <p class="mb-2">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                        <div class="btn btn-success my-3"><a href="#">www.homepage.com</a></div>
                    </div>
                </div>
            </div>
            <!-- Accordion Card -->
            <?php 
                $accordIndex = 1;
                
                for($i=1; $i <= 8; $i++){
                    Site::getSegment('about_members_accord_card', 
                    array(
                    'accord-index'=>'target'.$accordIndex,
                    'accord-target'=>'notarget'.$accordIndex,
                    'accord-title' =>'Lorem Ipsum',
                    'accord-country' => 'Country',
                    'accord-text'=>'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae perferendis minus assumenda laborum voluptas maxime deleniti ex ullam reiciendis eum!',
                    'accord-link'=>'www.homepage.com',
                    )); 
                    
                    $accordIndex++;
                }
            ?> 
        </div>    
        <!-- Accordion end -->
        
    </div>
</section>