<?php
define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
define('CONTENT_DIR', ROOT_DIR .'content/'); // change this to change which folder you want your content to be stored in

$default_title = 'HoneDrops';
$file_format = ".md"; // change this to choose a file type, be sure to include the period

// Get request url and script url
$url = '';
$request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
$script_url  = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';

// Get our url path and trim the / of the left and the right
if($request_url != $script_url) $url = trim(preg_replace('/'. str_replace('/', '\/', str_replace('index.php', '', $script_url)) .'/', '', $request_url, 1), '/');
// Get js and css path
$js_url = str_replace('index.php', 'js/', $script_url);
$css_url = str_replace('index.php', 'css/', $script_url);

// Get the file path
if($url) $file = strtolower(CONTENT_DIR . $url);
else $file = CONTENT_DIR .'index';

// Load the file
if(is_dir($file)) $file = CONTENT_DIR . $url .'/index' . $file_format;
else $file .=  $file_format;

// Show 404 if file cannot be found
if(file_exists($file)) $content = file_get_contents($file);
else $content = file_get_contents(CONTENT_DIR .'404' . $file_format);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $default_title; ?></title>
<!-- css -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap-responsive.css">
<link rel="stylesheet" href= "<?php echo $css_url."github-markdown.css"; ?>">
<style>
	.markdown-body {
		box-sizing: border-box;
		min-width: 200px;
		max-width: 980px;
		margin: 0 auto;
		padding: 45px;
	}

	@media (max-width: 767px) {
		.markdown-body {
			padding: 15px;
		}
	}
</style>
</head>
<body>
    <div class="container">
    <div class="row">
    <div class="col-12 col-sm-6 col-lg-8">
        <div id="md_out" class="markdown-body"></div>
        <div id="md_src"><?php echo $content; ?></div>
    </div>
    </div>
</div>

<!-- Javascript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript" src="<?php echo $js_url."marked.min.js"; ?>"></script>
<script type="text/javascript">
$(function() {
    var mdsrc = $('#md_src');
    var mdtxt = mdsrc.text();
    mdsrc.hide();

    $('#md_out').html(marked(mdtxt));

    var title_txt = $("title").text();
    var h1_txt = $("h1").text();
    $("title").text(h1_txt + " / " + title_txt);
});
</script>
</body>
</html>