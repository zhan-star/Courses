<?php
require_once 'secure.php';
if (isset($_POST['organization_id'])) {
$organization = new Organization();
$organization->organization_id =Helper::clearInt($_POST['organization_id']);
$organization->name = Helper::clearString($_POST['name']);
$organization->address =Helper::clearString($_POST['address']);
$organization->phone =Helper::clearString($_POST['phone']);
$organization->email =Helper::clearString($_POST['email']);
if ((new OrganizationMap())->save($organization)) {
header('Location: view-organization.php?id='.$organization->organization_id);
} else {
if ($organization->organization_id) {
header('Location: add-organization.php?id='.$organization->organization_id);
} else {
header('Location: add-organization.php');
}
}
}