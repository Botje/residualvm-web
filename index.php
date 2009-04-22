<?php
$file_root = ".";

// load libraries
require($file_root."/include/"."incl.php");
require($file_root."/include/"."scr-categories.php");
require($file_root."/include/"."news.php");

html_page_header('Residual :: Home', array("index.css"));

if (array_key_exists('shownews', $_GET)) {
  $shownews = $_GET['shownews'];
} else {
  $shownews = 0;
}
  

// display welcome table
// don't show this if we are in news mode
if (!$shownews)
{

// counter vars
srand((double) microtime() * 1000000);

// Make LEC games appear in 60% of total shots
$lastLECshot = 1;
$randPart = rand(0, 10);

if ($randPart < 11) {
  $randImg = rand(0, $lastLECshot - 1);
} else {
  $randImg = $lastLECshot + rand(0, count($screenshots) - $lastLECshot - 1);
}
?>

<script type="text/javascript">

<?php
  echo "screenshotIds = [\n";
  foreach ($screenshots as $s) {
    echo " \"$s\", ";
  }
  echo "\n];\n";
  echo "screenshotPaths = [\n";
  foreach ($screenshots as $s) {
    echo " \"".screenshot_thumb_path($s)."\", ";
  }
  echo "\n];\n";

  echo "var curScreenshotId = $randImg;\n";

?>

function scrshot_jn(n) {
  curScreenshotId += n;
  if (curScreenshotId >= screenshotIds.length) curScreenshotId = 0;
  if (curScreenshotId < 0) curScreenshotId = screenshotIds.length-1;

  document['curScreenshot'].src = screenshotPaths[curScreenshotId];
}
</script>

			<table class="intro" cellspacing="0" style="margin-bottom:8px;">
			<tr>
				<td class="sshots">
<table width="100%" cellspacing="0"><tr><td>
	<table width="100%" cellspacing="0"><tr>
	<td class="tlc">&nbsp;</td>
	<td class="heading"><h2><?php
 if($isOpera)
   shadowed_text("Screenshots", '#356a02', '#ffffff', 'shadow-text-em');
 else
   shadowed_text("Screenshots", '#356a02', '#ffffff');
 ?></h2></td>
	<td class="trc">&nbsp;</td>
	</tr></table>
</td></tr>
<tr><td class="content-wrap">
<table border="0" cellpadding="0" cellspacing="0" align="center">
<tr><td>
<?php
echo screenshot_previewer_link("screenshotIds[curScreenshotId]", 
	'<img src="' . screenshot_thumb_path($screenshots[$randImg]) . '" width=128 height=96 '.
	'style="margin: 5px" ' .
	'name="curScreenshot" title="Click to view Full Size" alt="Random screenshot">');
?>
	</td></tr>
</table>					
</td></tr>
<tr><td class="foot">
<table width="100%" cellspacing="0" cellpadding="0"><tr>
<td class="blc"></td>
<td class="nav-prev">
<?php
  echo '<a href="javascript:scrshot_jn(-1);">&lt;&lt; previous</a>&nbsp;</td>';
?>
<td class="nav-next">&nbsp;
<?php
  echo '<a href="javascript:scrshot_jn(+1);">next &gt;&gt;</a>&nbsp;</td>';
?>
<td class="brc"></td>
</tr></table></td></tr>
</table>
				</td>
<td class="intro">
<table width="100%" cellspacing="0" cellpadding="0" >
<tr><td>
	<table width="100%" cellspacing="0"><tr>
	<td class="tlc">&nbsp;</td>
	<td style="background:url('images/header-background.gif')"><h2><?php
shadowed_text("What Is Residual?", '#356a02', '#ffffff');
?></h2>
	<td class="trc">&nbsp;</td>
	</tr></table>
</td></tr>
<tr><td class="content">
<br>
<p>Residual is a cross-platform interpreter which allows you to play LucasArts'
LUA-based 3D adventures: Grim Fandango and Escape from Monkey Island,
provided you already have their data files. The clever part about this: Residual just replaces
the executables shipped with the games, allowing you to play them on systems for which they were never designed!
</p>
<p>
You can find a thorough list with details on which games are supported and how well on the <a href="compatibility.php">compatibility page</a>. Residual is continually improving, so check back often.
</p>

<p>
Our forum and IRC channel, <a href="irc://irc.freenode.net/residual">#residual on
irc.freenode.net</a>, are open for comments and suggestions. Please read our <a href="http://residual.sourceforge.net/faq.php">FAQ</a>
before posting.
</p>
</td></tr>
<tr>
	<td><table width="100%" cellspacing="0" cellpadding="0"><tr>
	<td class="blc">&nbsp;</td>
	<td class="bm">&nbsp;</td>
	<td class="brc">&nbsp;</td>
	</tr></table></td>
</tr>
</table>
</td></tr>
</table>

<?php

}

html_content_begin('Latest Developments');

// loop and display news
if ($shownews) {
  $news = list_latest_news(-1);
} else {
  $news = list_latest_news(4);
}

function displayNewsItem($item) {
  // Display news item
  echo '<div class="par-item">'.
	 '<div class="par-head">'.
	   '<a name="' . date("Y-m-d", $item["date"]) . '"></a>'.
	    '<a href="http://residual.sourceforge.net/?shownews=' . $item["filename"] . '">'.
	      '<span class="newsdate">' . date("M. jS, Y", $item["date"]) . "</span>: ".
           $item["title"].
        '</a>'.
	 '</div>'.
         '<div class="par-content">'.
		 	 '<div class="news-author">Posted by '.$item["author"]."</div> ".
  		$item["img"].
		$item["body"].
	 '</div>'.
       '</div>';
}

if (!$shownews or $shownews == "archive") {
	while (list($key,$item) = each($news)) {
	  // Display news item
	  displayNewsItem($item);
	}
} else if ($news[$shownews] != "") {
	displayNewsItem($news[$shownews]);
} else {
	echo "ERROR";
}

?>

<div class="bottom-feed-floater">
<a href="http://residual.sourceforge.net/feed-atom.php">Atom</a> | 
<a href="http://residual.sourceforge.net/feed-rss20.php">RSS</a>
</div>

<?php
// Show 'More News...' link, unless we are already in the showsnews mode.
if (true || !$shownews) {
  echo '<p class="bottom-link"><a href="?shownews=archive">More News...</a></p>'."\n";
}

html_content_end();
html_page_footer();

?>
