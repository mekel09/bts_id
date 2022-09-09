<?php
$facultyDao = new FacultyDaoImpl();
$cid = filter_input(INPUT_GET, 'cid');
if (isset($cid)) {
    $faculty = $facultyDao->fetchFaculty($cid);
}

$submitPressed = filter_input(INPUT_POST, 'Submit');
if (isset($submitPressed)) {
    $id = filter_input(INPUT_POST, 'id');
    $name = filter_input(INPUT_POST, 'name');
    $establish = filter_input(INPUT_POST, 'establish');
    $updatedFaculty = new Faculty();
    $updatedFaculty->setId($faculty->getId());
    $updatedFaculty->setName($name);
    $updatedFaculty->setEstablish($establish);
    $result = $facultyDao->updateFaculty($updatedFaculty);
    if ($result) {
        header("location:index.php?menu=cat");
    } else {
        echo '<div class="bg-success">Error update faculty data</div>';
    }
}
?>
<form action='' method="post">
    <div class="form-group">
        <label for="catID">Name :</label><input type="text" name="name" value="<?php echo $faculty->getName(); ?>" /></br>
        <label>Establish :</label><input type="text" name="establish" value="<?php echo $faculty->getEstablish(); ?>" /></br>
    </div>
    <input name='Submit' type="submit" class='btn btn-default' />
</form>