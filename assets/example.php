<?php
error_reporting(0);
include('inc/config.php');
$page['title'] = 'Example - table usage';

# delete handler
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if($_POST['action'] == 'delete') {
		# delete some records
		$sql = 'DELETE FROM user WHERE id_user = :id';
		$stmt = cnn()->prepare($sql);
		$stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
		$stmt->execute();
		exit(true);
	}
}

# table
$sql['table'] = 'user INNER JOIN company ON company.id_company = user.id_company';

# cols array(column, alias, asc/desc, type)
$sql['cols'][] = array('user.id_user', 'id');
$sql['cols'][] = array('user.flg_access', 'flg_access', false, 'boolean');
$sql['cols'][] = array('user.name', 'name', 'asc');
$sql['cols'][] = array('company.name', 'id_company');
$sql['cols'][] = array('user.birthday', 'birthday', false, 'date');
$sql['cols'][] = array('user.id_user', 'action_edit');
$sql['cols'][] = array('user.id_user', 'action_delete');

/*
# SPECIFIC sql options

# filters
$sql['filters'][] = array('user.name LIKE :name', ':name', "%Veronica%", PDO::PARAM_STR);
$sql['filters'][] = array('user.id_level = :id_level', ':id_level', 2, PDO::PARAM_INT);

# group
$sql['groupby'] = 'exchange.id_exchange';
*/
?>

<?include('header.php')?>
<?grid($sql)?>
<?include('footer.php')?>