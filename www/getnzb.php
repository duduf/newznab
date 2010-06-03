<?php

require_once("config.php");
require_once(WWW_DIR."/lib/page.php");
require_once(WWW_DIR."/lib/nzb.php");
require_once(WWW_DIR."/lib/users.php");
require_once(WWW_DIR."/lib/releases.php");

$page = new Page;
$users = new Users;

//
// page is accessible only by the rss token, or logged in users.
//
if (!$users->isLoggedIn())
{
	if ((!isset($_GET["i"]) || !isset($_GET["r"])))
		$page->show403();

	$res = $users->getByIdAndRssToken($_GET["i"], $_GET["r"]);
	if (!$res)
		$page->show403();
}

if (isset($_GET["id"]))
{
	$rel = new Releases;
	$reldata = $rel->getByGuid($_GET["id"]);

	$zd = gzopen($page->site->nzbpath.$_GET["id"].".nzb.gz", "r");
	if (!$zd)
		$page->show404();
	else
	{
		$nzbfile = gzread($zd, 5000000);
		gzclose($zd);	
	}

	if ($reldata)
	{
		$rel->updateGrab($_GET["id"]);
		$users->incrementGrabs($users->currentUserId());
	}
	else
		$page->show404();
		
	header("Content-type: application/x-nzb");
	header("X-DNZB-Name: ".$reldata["searchname"]);
	header("X-DNZB-Category: ".$reldata["category_name"]);
	header("X-DNZB-MoreInfo: "); //TODO:
	header("X-DNZB-NFO: "); //TODO:
	header("Content-Disposition: attachment; filename=".$reldata["searchname"].".nzb");
	
	echo $nzbfile;
}

?>
