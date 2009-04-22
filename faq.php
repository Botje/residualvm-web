<?php

/*
 * FAQ Page
 *
 */

// set this for position of this file relative
$file_root = ".";

// load libraries
require($file_root."/include/"."incl.php");

// start of html
html_page_header("Residual :: FAQ", array("faq.css"));

html_content_begin('FAQ :: Frequently Asked Questions');

?>
  <div class="par-item">
    <div class="par-head">
       FAQ
    </div>
    <div class="par-content">
    <div class="news-author">last updated: <?php echo date("F d, Y",filemtime("faq.inc")); ?></div>
<?php
include $file_root."/faq.inc";

?>
    </div>
  </div>

<?php

html_content_end();
html_page_footer();

?>
