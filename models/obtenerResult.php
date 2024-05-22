<?php
$PDO = new PDO("mysql:host=localhost;dbname=ansamar;charset=utf8","root","");
$PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//sanitize post value
if(isset($_POST["page"])){
 $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
 if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
}else{
 $page_number = 1;
}

//get current starting point of records
$position = (($page_number-1) * 5);

//$prueba->listar1($position);

$results = $PDO->prepare("SELECT nombres,apellidos FROM paciente ORDER BY id DESC LIMIT $position,5");
$results->execute();

//getting results from database
?>
<ul class="page_result">
<?php
while($row = $results->fetch(PDO::FETCH_ASSOC))
{
 ?>
    <li>
    <a href="<?php echo $row['apellidos']; ?>"><?php echo $row['nombres']; ?></a>
    </li>
    <?php
}
?>
</ul>