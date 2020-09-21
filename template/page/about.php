<?php if (!isXHR()) Site::getHeader(); ?>



<?php 


Site::getSegment('about_section_heading');
Site::getSegment('about_section_text');
Site::getSegment('about_section_learn_more');

if (!isXHR()) Site::getFooter();