<?php
// set this for position of this file relative
$file_root = ".";

// load libraries
require($file_root."/include/"."incl.php");
require($file_root."/include/"."scr-categories.php");

$offset = $cat1 = $cat2 = $screenshotID = "";

if (array_key_exists('offset', $_GET)) {
  $offset = $_GET['offset'];
}

if (array_key_exists('cat1', $_GET)) {
  $cat1 = $_GET['cat1'];
}

if (array_key_exists('cat2', $_GET)) {
  $cat2 = $_GET['cat2'];
}

// TODO: Replace screenshotID by cat3 field (this will require changes to the JavaScript code)
if (array_key_exists('screenshotID', $_GET)) {
  $screenshotID = $_GET['screenshotID'];
}

// If a full screenshotID was provided, ignore all other params and display the corresponding page
if (preg_match("/^(\d+)_(\d+)_(\d+)\$/", $screenshotID)) {
	// FIXME:
	$caption = screenshot_caption($screenshotID);
	$path = screenshot_path($screenshotID);
?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
	<html><head><title>Screenshot: <?php echo $caption; ?></title><link rel="stylesheet" href="style.css" type="text/css"></head>
	<body onClick="javascript:self.close();" style="margin:0px;text-align:center;">
	<img src="<?php echo $path; ?>">
	</body>
	</html>
<?php
exit;
}


html_page_header('Residual :: Screenshots', array("screenshots.css"));

html_content_begin('Screenshots');

if ($cat1 == "") {
?>
  <div class="par-item">
    <div class="par-head">
       Screenshots
    </div>
    <div class="par-intro">
<?php


  // Random screenshot
  $randImg = rand(0, count($screenshots) - 1);
?>
<br>
<table border=0 width="100%">
<tr><td align="left" valign="middle">


</td><td style="width:300px; vertical-align:center; align:left">

<table border=0 align="left" cellspacing=0>
<tr><td width=280 height=37 colspan=4><img src="<?php echo $file_root; ?>/images/rs-top.png" alt=""></td></tr>
<tr><td width=17 height=10 colspan=2><img src="<?php echo $file_root; ?>/images/rs-top-left.png" alt=""></td><td rowspan=2 width=256 height=192>
<?php
  $image = $screenshots[$randImg];
  echo screenshot_previewer_link("'" . $image . "'", 
  	'<img src="'.screenshot_thumb_path($image).'" width=256 height=192 align=right alt="Random Screenshot" title="Click to view Full Size">');
?>
</td><td style="background:#a82709;" width=7 height=192 rowspan=2></td></tr>
<tr><td width=10 height=182></td><td style="background:#a82709;" width=7></td></tr>
<tr><td width=280 height=21 colspan=4><img src="<?php echo $file_root; ?>/images/rs-bottom.png" alt=""></td></tr>
</table>

</td></tr>
</table>

    <p>&nbsp;</p>
    </div>
    <div class="par-content">

<?php    

  display_categories();

?>
    </div>
  </div>
<?php
}
if ($cat1 != "") {
  // generate list of all shots to show
  $showlist = array();

  foreach ($categories as $i) {
    if ($cat1 == $i->_catnum || $cat1 == -1) {
      foreach ($i->_list as $j) {
        if ($cat2 == $j['catnum'] || $cat2 == -1) {
          $showlist = array_merge($showlist, $scrcatnums[$i->_catnum][$j['catnum']]);
        }
      }
    }
  }

  $num = 0;
  $where = 0;
  
  echo html_frame_start("Screenshot Gallery","540",2,0,"color0")."<tr>";

  while (list($c,$image) = each($showlist)) {
    // do not show images less than current pos
    if ($offset > $c)
      continue;

    // display image
    echo html_frame_td(
	'<table cellpadding="0" cellspacing="0"><tr><td align="center">'.
	screenshot_previewer_link("'" . $image . "'", 
		'<img src="'.screenshot_thumb_path($image).'" width=256 height=192 alt="Screenshot '.$c.'">').
	'</td></tr><tr><td align="center">'.
	screenshot_caption($image).
	'</td></tr></table>',
	'align=center class="color0" style="padding-top: 10px; font-style: italic;"'
    );

    // count number of images displayed.
    $num++;

    // end row at 2
    if (($num % 2 == 0) && ($num != 1)) {
      echo "</tr><tr>\n";
    }
  }

  echo "<td></td></tr>";

  echo html_frame_end();
 }

html_content_end();
html_page_footer();

?>
