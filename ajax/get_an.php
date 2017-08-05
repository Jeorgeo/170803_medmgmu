<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
global $wpdb;

$groups_id = $_POST['group_id'];

$list = get_terms( 'groups', array('get' => 'all') );
$groups = array();
foreach( $list as $obj ){
	if( $obj->parent == $groups_id ){
		$groups[] = $obj;
	}
}

$groups_content = "";
foreach( $groups as $obj ) {
	$groups_content .='<div id="group' . $obj->term_id . '" class="groups-item">';
	$groups_content .='<div onclick="getGroups( ' . $obj->term_id . ' );" class="groups-item-arrow"></div>';
	$groups_content .='<span onclick="getGroups( ' . $obj->term_id . ' );" class="groups-item-text">' . $obj->name .'</span>';
	//$groups_content .='<div onclick="getGroups( ' . $obj->term_id . ' );" class="groups-item-more">подробно</div>';
	$groups_content .='<div style="clear: both"></div>';
	$groups_content .='<div id="group' . $obj->term_id . 'content" class="groups_content"></div>';
	$groups_content .='<div id="group' . $obj->term_id . 'items" class="items_content"></div>';
	$groups_content .='</div>';
}

$items = array();
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
foreach( $anlizes as $obj ){
	/*
	$groups = wp_get_object_terms( $obj->ID, 'groups');
	$found = false;
	foreach( $groups as $group ){
		if( $group->term_id == $groups_id ){
			$found = true;
		}
	}
	if( $found ){
		$items[] = $obj;
	}
	*/
	if( has_term( $groups_id, 'groups', $obj->ID ) ){
		$items[] = $obj;
	}
}
$items_content = "";
/*
foreach( $items as $obj ){
	$items_content .= '<div  id="item' . $obj->ID .'" class="items_content_item">';
	$items_content .= '<span onclick="getAnalize(' . $obj->ID . ');" class="groups-item-text">' . $obj->post_title . '</span>';
	$items_content .= '<div onclick="getAnalize(' . $obj->ID . ');" class="items_content_item_more">подробно</div>';
	$price = get_post_meta( $obj->ID, 'price' );
	$items_content .= '<div onclick="getAnalize(' . $obj->ID . ');" class="items_content_item_price">' . $price[ 0] . ' <span class="rub">Р<span></div>';
	$items_content .= '<div style="clear: both"></div>';
	$items_content .= '</div>';
	$items_content .= '<div id="item' . $obj->ID .'description" class="items_content_item_description">';
	$description = get_post_meta( $obj->ID, 'description' );
	$items_content .= '<div style="padding-right: 10%;">' . $description[ 0] . '</div>';
	if( trim($description[ 0]) != '' ){
		$items_content .= '<div onclick="hideAnalize(' . $obj->ID . ');" class="items_content_item_description_btn">свернуть</div>';
		$items_content .= '<div style="clear: both"></div>';
	}
	$items_content .='</div>';
}
*/
foreach( $items as $obj ){
	$items_content .= '<div onclick="show_item_description( ' . $obj->ID . ' );" id="item' . $obj->ID .'" class="items_content_item">';
	$items_content .=	'<div class="groups-item-arrow"></div>';
	$items_content .= 	'<div class="groups-item-text items_content_item_text">' . $obj->post_title . '</div>';
	$price = get_post_meta( $obj->ID, 'price' );
	$items_content .= 	'<div class="items_content_item_price">' . $price[ 0] . ' <span class="rub">Р<span></div>';
	$items_content .= 	'<div style="clear: both"></div>';
	$items_content .='</div>';
	$items_content .='<div id="item' . $obj->ID .'description" class="items_content_item_place" style="margin-bottom: 10px;	">';
	$items_content .= 	'<div class="groups-item-text items_content_item_text item_description_title">' . $obj->post_title . '</div>';
	$items_content .= 	'<div class="items_content_item_price red">' . $price[ 0] . ' <span class="rub red">Р<span></div>';
	$items_content .= 	'<div style="clear: both"></div>';
	$items_content .=	'<div style="float:left;width:5%;min-height:20px;margin-left:35px;"></div>';
	$items_content .=	'<div class="item_description">';
	$items_content .=		'<div class="item_description_place">';
	$description = get_post_meta( $obj->ID, 'description');
	$items_content .=		$description[ 0];
	$items_content .=		'</div>';
	$description = get_post_meta( $obj->ID, 'az_description' );
	if( trim($description[ 0]) != "" ){
		$items_content .=		'<div class="item_az_description">';
		$description_title = get_post_meta( $obj->ID, 'az_title' );
		$items_content .=			'<div class="item_az_description_title">' . $description_title[ 0] . '</div>';
		$items_content .=		$description[ 0];
		$items_content .=		'</div>';
	} else {
		$items_content .='<a href="/podgotovka-k-analizam">';
		$items_content .='<div style="float:none;margin-left:18px;margin-bottom:10px;" class="anliz_btn preparation_btn">';
		$items_content .='Подготовка к анализам';
		$items_content .='</div>';
		$items_content .='</a>';
	}
	$items_content .=	'</div>';
	$items_content .= 	'<div style="clear: both"></div>';
	$items_content .='</div>';
}

$result['groups_content'] = $groups_content;
$result['items_content'] = $items_content;

echo json_encode( $result );
