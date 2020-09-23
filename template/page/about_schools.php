<?php if (!isXHR()) Site::getHeader(); ?>



<?php 

Site::getSegment('about_schools_heading');
Site::getSegment('about_schools_text');


if (!isXHR()) Site::getFooter();