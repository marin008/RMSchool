<?php if (!isXHR()) Site::getHeader(); ?>



<?php 

Site::getSegment('about_network_heading');
Site::getSegment('about_network_text');
Site::getSegment('about_network_cta');


if (!isXHR()) Site::getFooter();