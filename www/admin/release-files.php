<?php
require_once($_SERVER['DOCUMENT_ROOT']."/lib/adminpage.php");
require_once($_SERVER['DOCUMENT_ROOT']."/lib/users.php");
require_once($_SERVER['DOCUMENT_ROOT']."/lib/binaries.php");
require_once($_SERVER['DOCUMENT_ROOT']."/lib/releases.php");

$page = new AdminPage;
$users = new Users;

if (!$users->isLoggedIn())
	$page->show403();

if (isset($_GET["id"]))
{

	$releases = new Releases;
	$rel = $releases->getByGuid($_GET["id"]);
	if (!$rel)
		$page->show404();
	
	
	$binaries = new Binaries;
	$data = $binaries->getForReleaseId($rel["ID"]);

	$page->smarty->assign('rel', $rel);
	$page->smarty->assign('binaries', $data);

	$page->title = "File List";
	$page->meta_title = "View Nzb file list";
	$page->meta_keywords = "view,nzb,file,list,description,details";
	$page->meta_description = "View Nzb File List";
	
	$page->content = $page->smarty->fetch('admin/release-files.tpl');
	$page->render();
}

?>