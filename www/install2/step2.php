<?php
require_once './lib/installpage.php';
require_once('./lib/config.php');

$page = new Installpage();
$page->title = "Database setup";

$cfg = new Config();

if (!$cfg->isInitialized()) {
	header("Location: index.php");
	die();
}

$cfg = $cfg->getSession();

if  ($page->isPostBack()) {
	$cfg->doCheck = true;
	$cfg->DB_HOST = trim($_POST['host']);
	$cfg->DB_USER = trim($_POST['user']);
	$cfg->DB_PASSWORD = trim($_POST['pass']);
	$cfg->DB_NAME = trim($_POST['db']);
	
	$cfg->dbConnCheck = @mysql_connect($cfg->DB_HOST, $cfg->DB_USER, $cfg->DB_PASSWORD);
	if ($cfg->dbConnCheck === false) {
		$cfg->error = true;
	}
	$cfg->dbNameCheck = mysql_select_db($cfg->DB_NAME);
	if ($cfg->dbNameCheck === false) {
		$cfg->error = true;
	}
	
	if (!$cfg->error) {
		$cfg->setSession();
	}
	
	//Load schema.sql
	if (file_exists($cfg->WWW_DIR.'/../db/schema.sql')) {
		$dbData = file_get_contents($cfg->WWW_DIR.'/../db/schema.sql');
		$bom = pack("CCC", 0xef, 0xbb, 0xbf);
		if (0 == strncmp($dbData, $bom, 3)) {
			$dbData = substr($dbData, 3);
		}
		$queries = explode(";", $dbData);
		$queries = array_map("trim", $queries);
		foreach($queries as $q) {
			mysql_query($q);
		}
	}
}

$page->smarty->assign('cfg', $cfg);

$page->smarty->assign('page', $page);

$page->content = $page->smarty->fetch('step2.tpl');
$page->render();

?>