<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/** @var JDocumentHtml $this */

$app  = JFactory::getApplication();
$user = JFactory::getUser();

// Output as HTML5
$this->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');

if ($task === 'edit' || $layout === 'form')
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add Stick js
JHtml::_('script', 'stick.js', array('version' => 'auto', 'relative' => true));

// Add template js
JHtml::_('script', 'template.js', array('version' => 'auto', 'relative' => true));

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add Stylesheets
JHtml::_('stylesheet', 'template.css', array('version' => 'auto', 'relative' => true));


// Use of Google Font
if ($this->params->get('googleFont'))
{
	$font = $this->params->get('googleFontName');

	// Handle fonts with selected weights and styles, e.g. Source+Sans+Condensed:400,400i
	$fontStyle = str_replace('+', ' ', strstr($font, ':', true) ?: $font);

	JHtml::_('stylesheet', 'https://fonts.googleapis.com/css?family=' . $font);
	$this->addStyleDeclaration("
	h1, h2, h3, h4, h5, h6, .site-title {
		font-family: '" . $fontStyle . "', sans-serif;
	}");
}

// Template color
if ($this->params->get('templateColor'))
{
	$this->addStyleDeclaration('
	
	a {
		color: ' . $this->params->get('templateColor') . ';
	}
	.nav-list > .active > a,
	.nav-list > .active > a:hover,
	.dropdown-menu li > a:hover,
	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover,
	.nav-pills > .active > a,
	.nav-pills > .active > a:hover,
	.btn-primary {
		background: ' . $this->params->get('templateColor') . ';
	}');
}

// Check for a custom CSS file
JHtml::_('stylesheet', 'user.css', array('version' => 'auto', 'relative' => true));

// Check for a custom js file
JHtml::_('script', 'user.js', array('version' => 'auto', 'relative' => true));

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
$position7ModuleCount = $this->countModules('position-7');
$position8ModuleCount = $this->countModules('position-8');

if ($position7ModuleCount && $position8ModuleCount)
{
	$span = 'span6';
}
elseif ($position7ModuleCount && !$position8ModuleCount)
{
	$span = 'span9';
}
elseif (!$position7ModuleCount && $position8ModuleCount)
{
	$span = 'span9';
}
else
{
	$span = 'span12';
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . htmlspecialchars(JUri::root() . $this->params->get('logoFile'), ENT_QUOTES) . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
</head>
<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '')
	. ($this->direction === 'rtl' ? ' rtl' : '');
?>">
	<!-- Body -->
	<div class="body" id="top">
		<header class="header" role="banner">
			<div class="container header-inner clearfix">
				<a class="brand pull-left" href="<?php echo $this->baseurl; ?>/">
					<?php echo $logo; ?>
					<?php if ($this->params->get('sitedescription')) : ?>
						<?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription'), ENT_COMPAT, 'UTF-8') . '</div>'; ?>
					<?php endif; ?>
				</a>
				<div class="header-search pull-right">
					<jdoc:include type="modules" name="position-0" style="none" />
				</div>
			</div>
		</header>
		<div class="container-fluid<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<!-- Header -->
			<div class="banner">
				<jdoc:include type="modules" name="banner" style="none" />
			</div>
		</div>
		<div class="container" style="padding:4% 0%;">
			<jdoc:include type="component" />
			<jdoc:include type="modules" name="position-3" style="xhtml" />
			<jdoc:include type="modules" name="position-1" style="xhtml" />
			<jdoc:include type="modules" name="position-4" style="xhtml" />
			<br />
			<jdoc:include type="modules" name="features-position-1" style="none" />
			<jdoc:include type="modules" name="department-position-1" style="none" />

			<div class="span7">
				<jdoc:include type="modules" name="about-position-1" style="xhtml" />
			</div>
			<div class="span7">
				<jdoc:include type="modules" name="about-position-3" style="none" />
			</div>
			<div class="span7">
				<jdoc:include type="modules" name="about-position-0" style="none" />
			</div>
			<div class="span7">
				<jdoc:include type="modules" name="about-position-2" style="none" />
			</div>
			<br/>
			<div class="span3">
				<jdoc:include type="modules" name="position-5" style="xhtml" />
				<jdoc:include type="modules" name="position-1" style="xhtml" />
			</div>
			<div class="span3">
				<jdoc:include type="modules" name="position-6" style="xhtml" />
				<jdoc:include type="modules" name="position-1" style="xhtml" />
			</div>
			<div class="span3">
				<jdoc:include type="modules" name="position-7" style="xhtml" />
				<jdoc:include type="modules" name="position-1" style="xhtml" />
			</div>
			<div class="span3">
				<jdoc:include type="modules" name="position-8" style="xhtml" />
				<jdoc:include type="modules" name="position-1" style="xhtml" />
			</div>
		</div>
		<div class="image" style="background: #f8f9fa; padding:1% 0%;">
			<div class="container" style="background: none">
				<jdoc:include type="modules" name="position-9" style="xhtml" />
				<jdoc:include type="modules" name="about-position-4" style="none" />
				<jdoc:include type="modules" name="about-position-5" style="none" />
				<jdoc:include type="modules" name="position-1" style="xhtml" />
				<jdoc:include type="modules" name="Add-to-cart" style="none" />

				<br/>
				<div class="span7">
					<jdoc:include type="modules" name="position-left-img" style="none" />
				</div>
				<div class="span7">
					<jdoc:include type="modules" name="position-10" style="xhtml" />
					<jdoc:include type="modules" name="position-11" style="xhtml" />
					<jdoc:include type="modules" name="position-12" style="xhtml" />
				</div>
				<div class="span3">
					<jdoc:include type="modules" name="features-position-2" style="xhtml" />
				</div>
				<div class="span3">
					<jdoc:include type="modules" name="features-position-3" style="xhtml" />
				</div>
				<div class="span3 package-white">
					<jdoc:include type="modules" name="features-position-4" style="xhtml" />
				</div>
				<div class="span3">
					<jdoc:include type="modules" name="features-position-5" style="xhtml" />
				</div>
			</div>
		</div>
		<div class="container" style="padding:2% 0 2% 0;">
			<jdoc:include type="modules" name="position-13" style="xhtml" />
			<jdoc:include type="modules" name="about-position-6" style="none" />
		</div>
	</div>
	<jdoc:include type="modules" name="footer" style="xhtml" />
	<!-- Footer -->
	<footer class="footer" role="contentinfo" style="background: #0e5442; padding: 0px 20px">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<hr />
			<jdoc:include type="modules" name="footer" style="none" />
			<p class="pull-right">
				<a href="#top" id="back-top" style="color: #fff; font-size: 10px;">
					<?php echo JText::_('BACK TO TOP'); ?>
				</a>
			</p>
			<p style="color: #fff; font-size: 12px;">
				&copy; <?php echo date('Y'); ?> <?php echo $sitename;?> <?php echo "By Jyoti";?>
			</p>
		</div>
	</footer>
</body>
</html>
<script type="text/javascript">
	jQuery(document).ready(function($){

    var headerwrap = $('.header');

    $(window).scroll(function(){

        var scroll = $(this).scrollTop();
        var topDist = 20;

        if( scroll > topDist ) {
            headerwrap.addClass('scroll');
        }
        else {
            headerwrap.removeClass('scroll');
        }
    });

});
</script>

<script>
jQuery(document).ready(function($){
    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
});
</script>
