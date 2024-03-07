<?php

header('Content-type: image/svg+xml');
header("Cache-Control: max-age=2592000");

$wh = explode('x', $_GET['wh']);
$wh[0] = (int)$wh[0];
$wh[1] = (int)$wh[1];
$fill = isset($_GET['fill']) ? $_GET['fill']: '666666';
$color = isset($_GET['color']) ? $_GET['color']: 'FFFFFF';
$size = isset($_GET['size']) ? (int)$_GET['size']: 60;
$fontfamily = isset($_GET['font']) ? $_GET['font']: 'Arial';
header('Content-Type: image/svg+xml');
?>
<svg viewBox="0 0 <?php echo $wh[0] ?> <?php echo $wh[1] ?>" xmlns="http://www.w3.org/2000/svg">
<g>
<title></title>
<rect id="svg_1" height="<?php echo $wh[0] ?>" width="<?php echo $wh[1] ?>" y="0" x="0" fill="<?php echo $fill ?>"/>
</g>
</svg>