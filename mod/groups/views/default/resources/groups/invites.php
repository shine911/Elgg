<?php
/**
 * Show a listing of all users who are invited to join this group
 */

$group = elgg_get_page_owner_entity();

elgg_push_breadcrumb(elgg_echo('groups'), "groups/all");
elgg_push_breadcrumb($group->getDisplayName(), $group->getURL());

elgg_register_menu_item('title', [
	'name' => 'groups:invite',
	'icon' => 'user-plus',
	'href' => elgg_generate_entity_url($group, 'invite'),
	'text' => elgg_echo('groups:invite'),
	'link_class' => 'elgg-button elgg-button-action',
]);

// build page elements
$title = elgg_echo('groups:invitedmembers');

$content = elgg_list_relationships([
	'relationship' => 'invited',
	'relationship_guid' => $group->guid,
	'no_results' => true,
]);

$tabs = elgg_view_menu('groups_members', [
	'entity' => $group,
	'class' => 'elgg-tabs'
]);

// build page
$body = elgg_view_layout('default', [
	'title' => $title,
	'content' => $content,
	'filter' => $tabs,
]);

// draw page
echo elgg_view_page($title, $body);
