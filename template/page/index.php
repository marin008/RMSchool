<?php if (!isXHR()) Site::getHeader(); ?>



<?php 

Site::getSegment('hero_rotator');
Site::getSegment('cta_image');
Site::getSegment('ambassadors');
Site::getSegment('events');
Site::getSegment('rmvideos');
//Site::getSegment('typography');


if (!isXHR()) Site::getFooter();