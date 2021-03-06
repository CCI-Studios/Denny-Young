<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]> <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]> <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php
// get current menu name
$menu = JSite::getMenu();
if ($menu && $menu->getActive())
    $menu = $menu->getActive()->alias;
else
	$menu = "";

if ($_SERVER['SERVER_PORT'] === 8888 ||
		$_SERVER['SERVER_ADDR'] === '127.0.0.1' ||
		stripos($_SERVER['SERVER_NAME'], 'ccistaging') !== false ||
		stripos($_SERVER['SERVER_NAME'], 'dev') === 0) {

	$testing = true;
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
} else {
	$testing = false;
}

$hasSidebar = !!$this->countModules('sidebar');
JHTML::_('behavior.mootools');
$analytics = "UA-27181882-1";
?>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" contents="IE=edge,chrome=1">
 	<jdoc:include type="head" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/templates/<?= $this->template ?>/resources/favicon.ico">
	<link rel="apple-touch-icon" href="/templates/<?= $this->template ?>/resources/apple-touch-icon.png">

	<!-- load css -->
	<?php if ($testing): ?>
		<link rel="stylesheet" href="/templates/<?= $this->template ?>/css/template.css">
	<?php else: ?>
		<link rel="stylesheet" href="/templates/<?= $this->template ?>/css/template.min.css">
	<?php endif; ?>

	<!-- load modernizer, all other at bottom -->
	<?php if ($testing): ?>
		<script src="/templates/<?= $this->template ?>/js/libs/modernizr-1.7.js"></script>
	<?php else: ?>
		<script src="/templates/<?= $this->template ?>/js/libs/modernizr-1.7.min.js"></script>
	<?php endif; ?>

	<script type="text/javascript" src="http://use.typekit.com/hlu0rwl.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>

<body class="<?= $menu ?>">

	<div id="header"><div><div><jdoc:include type="modules" name="header" style="rounded" /></div></div></div>
	<? if ($this->countModules('sidebar')): ?>
		<div id="sidebar"><div><div><jdoc:include type="modules" name="sidebar" style="rounded" /></div></div></div>
	<? endif; ?>

	<div id="wrapper">
		<div id="body" <? echo ($hasSidebar)? '': 'class="wide"'; ?>>
			<div id="content">
				<? if ($this->countModules('top')): ?>
					<div id="top"><jdoc:include type="modules" name="top" style="rounded" /></div>
				<? endif; ?>
				<div id="component">
					<jdoc:include type="message" />
					<jdoc:include type="component" />
				</div>
				<? if ($this->countModules('bottom')) :?>
					<div id="bottom"><jdoc:include type="modules" name="bottom" style="rounded" /></div>
				<? endif; ?>
			</div>

			<div class="clear"></div>
		</div>
	</div>

	<div class="hidden">
		<jdoc:include type="modules" name="hidden" style="raw" />
	</div>

	<!-- load scripts -->
	<?php if ($testing): ?>
		<script src="/templates/<?= $this->template ?>/js/columns.js"></script>
		<script src="/templates/<?= $this->template ?>/js/dropmenu.js"></script>
		<script src="/templates/<?= $this->template ?>/js/html5.js"></script>
	<?php else: ?>
		<script>
			var _gaq=[["_setAccount","<?php echo $analytics?>"],["_trackPageview"]];
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
				g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
				s.parentNode.insertBefore(g,s)}(document,"script"));
	  	</script>
		<script src="/templates/<?= $this->template ?>/js/scripts.min.js"></script>
	<?php endif; ?>
</body>
</html>
