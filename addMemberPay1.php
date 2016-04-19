<?php
//error_reporting(1);
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
  
<link rel="stylesheet" href="assets/css/font.awesome.css">
<link rel="stylesheet" href="assets/css/common.css">
<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="assets/css/bootstrap.theme.css">
<link rel="stylesheet" href="assets/css/datatables.css">
<link rel="stylesheet" href="assets/css/datepicker.css">

<!-- javascript -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.bootbox.js"></script>
<script src="assets/js/jquery.datatables.js"></script>
<script src="assets/js/jquery.accounting.js"></script>
<script src="assets/js/jquery.timeout.js"></script>
<script src="assets/js/jquery.validate.js"></script>
<script src="assets/js/jquery.datepicker.js"></script>

<div class="row">
 
        <?php grid($sql)?>
    </div>

 
 
			
 

	</div> <!-- #end main-container -->
  

</body>

</html>