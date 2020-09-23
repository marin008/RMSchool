<?php if (!isXHR()) Site::getHeader(); ?>



<?php 

Site::getSegment('about_eu_heading');
Site::getSegment('about_eu_text');
Site::getSegment('about_eu_info');
Site::getSegment('about_eu_members');
Site::getSegment('about_eu_members_list');


if (!isXHR()) Site::getFooter();