<?php

/**
 * @package capsule
 *
 * This file is part of the Capsule Theme for WordPress
 * http://crowdfavorite.com/capsule/
 *
 * Copyright (c) 2012 Crowd Favorite, Ltd. All rights reserved.
 * http://crowdfavorite.com
 *
 * **********************************************************************
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
 * **********************************************************************
 */

$blog_desc = get_bloginfo('description');
$title_description = (is_home() && !empty($blog_desc) ? ' - '.$blog_desc : '');

if (get_option('permalink_structure') != '') {
	$search_onsubmit = "location.href=this.action+'search/'+encodeURIComponent(this.s.value).replace(/%20/g, '+'); return false;";
}
else {
	$search_onsubmit = '';
}

?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	
	<title><?php wp_title( '|', true, 'right' ); echo esc_html( get_bloginfo('name'), 1 ).$title_description; ?></title>
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<nav class="main-nav">

	<a href="index.php" class="logo">Capsule</a>

	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="<?php echo esc_url(admin_url('post-new.php')); ?>" class="post-new-link"><?php _e('New Post', 'capsule'); ?></a></li>
		<li><a href="index.php" class="projects">Projects</a>
			<ul class="project-list">
				<li><a href="#">@test</a></li>
				<li><a href="#">@social</a></li>
				<li><a href="#">@capsule</a></li>
				<li><a href="#">@tacos</a></li>
				<li><a href="#">@persnickety</a></li>
				<li><a href="#">@threads</a></li>
				<li class="list-last"><a href="#">All Projects</a></li>
			</ul>
		</li>
		<li><a href="index.php">Search</a></li>
		<li><a href="/wp/wp-admin/">Settings</a></li>
	</ul>
</nav>

<div id="wrap">
	<header id="header">
		<div class="inner">
			<h1>All Posts</h1> 
			<form class="clearfix" action="<?php echo esc_url(home_url('/')); ?>" method="get" onsubmit="<?php echo $search_onsubmit; ?>">
				<input type="text" name="s" value="" placeholder="<?php _e('Search projects, code, tags, etc...', 'capsule'); ?>" />
				<input type="submit" name="search_submit" value="<?php _e('Search', 'capsule'); ?>" />
			</form>
		</div>
	</header>
	<div class="body">
<?php

if (is_search() || is_archive()) {
	include(STYLESHEETPATH.'/lib/cf-archive-title/cf-archive-title.php');
	cfpt_page_title('<h2 class="page-title">', '</h2>');
}

if (have_posts()) {
	while (have_posts()) {
		the_post();
		
		if (is_singular()) {
			include('views/content.php');
		}
		else {
			include('views/excerpt.php');
		}
	}
	if ( $wp_query->max_num_pages > 1 ) {
?>
		<nav class="pagination clearfix">
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts <span class="meta-nav">&rarr;</span>', 'capsule' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer posts', 'capsule' ) ); ?></div>
		</nav>
<?php
	}

}

?>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>

<!-- $ymd = get_the_time('Ymd', $post);
$sticky_class = is_sticky() ? "date-title-sticky" : "";
the_date('F j, Y', '<h2 class="date-title date-'.$ymd.' '.$sticky_class.'">', '</h2>'); -->