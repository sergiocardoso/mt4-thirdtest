<?php
require_once 'vendor/autoload.php';

$auditoria = MT4\Singleton\Auditoria::getInstance();
$auditoria->check();
$files = MT4\File::listFiles();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MT4 - Auditoria</title>

	<!--CSS-->
	<link rel="stylesheet" href="public/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="public/css/app.css">

	<!--JS-->
	<script src="public/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="public/bower_components/bootstrap/dist/js/bootstrap.js"></script>
	<script src="public/bower_components/angular/angular.min.js"></script>
	<script src="public/js/app.js"></script>


</head>
<body>

	<div class="body">
		<form action="upload.php" method="post" enctype="multipart/form-data">
			<div class="base">
				<label>Arquivo para UPLOAD</label>
				<input type="file" name="cFile" required>
				<input type="submit" name="submit" value="Enviar" id="btnEnviar">
			</div>
		</form>
	</div>

	<div class="files">
		<label>Arquivos adicionados no sistema</label>

		<ul class="list">
<?php
foreach ($files as $file) {
    echo '<li>';
    echo '<div class="dType">' . $file['type'] . '</div>';
    echo '<div class="dName">' . $file['name'] . '</div>';
    echo '<a class="dChange" data-toggle="tooltip" data-placement="bottom" title="Verificar Arquivo"><i class="fa fa-file-text" aria-hidden="true"></i></a>';
    echo '<div class="clear"></div>';
    echo '<form action="upload.php?id=' . $file['id'] . '" method="post" enctype="multipart/form-data" class="fileChange">';
    echo '<div class="base">';
    echo '<label>Arquivo para UPLOAD</label>';
    echo '<input type="file" name="cFile" required>';
    echo '<input type="hidden" name="id_file" value="' . $file['id'] . '">';
    echo '<input type="submit" name="submit" value="Enviar" id="btnEnviar" class="btnEnviar2">';
    echo '</div>';
    echo '</form>';
    echo '</li>';
}
?>
		</ul>
	</div>

</body>
</html>
