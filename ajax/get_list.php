<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
global $wpdb;

$search = trim( $_POST['search'] );

$anlizes = get_posts( array(
	'numberposts'     => -1,
	'offset'          => 0,
	'category'        => '',
	//'orderby'         => 'post_title',
	'include'         => '',
	'exclude'         => '',
	'meta_key'        => '',
	'meta_value'      => '',
	'post_type'       => 'anlizes',
	'post_parent'     => '',
	'post_status'     => 'publish',
) );

$list = array();
foreach( $anlizes as $obj ){
	if( mb_strpos( mb_strtoupper($obj->post_title), mb_strtoupper($search)  ) === false ){}
	else {
		$list[] = $obj;
	}
}
if( count($list) ){

	$search = '?search=';
	foreach( $list as $index=>$obj ){
		$search .= '' . $obj->ID;
		if( $index != count($list) - 1 ){
			$search .= ',';
		}
	}


foreach( $list as $obj ){ ?>
	<a href="<?php echo $obj->guid . $search; ?>">
		<div class="search_box"">
			<div class="groups-item-arrow"></div>
			<div class="groups-item-text"><?php echo $obj->post_title; ?></span>
			<!--<div class="groups-item-more">подробно</div>-->
		</div>
	</a>
<? }
} else { ?>
	<div class="search_box"">
		Ничего не найдено!
	</div>
<? }