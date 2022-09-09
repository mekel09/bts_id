<?php
$facultyDao = new FacultyDaoImpl();
$command = filter_input(INPUT_GET, 'cmd');
if (isset($command) && $command == 'del') {
    $cid = filter_input(INPUT_GET, 'cid');
    if (isset($cid)) {
        $result = $facultyDao->deleteFaculty($cid);
        if ($result) {
            echo '<div class="bg-success">Faculty successfully deleted</div>';
        } else {
            echo '<div class="bg-danger">Error delete Faculty</div>';
        }
    }
}

$submitPressed = filter_input(INPUT_POST, 'Submit');
if (isset($submitPressed)) {
    $id = filter_input(INPUT_POST,'id');
    $name = filter_input(INPUT_POST, 'name');
    $establish = filter_input(INPUT_POST,'establish');
    $faculty = new Faculty();
    $faculty->setId($id);
    $faculty->setName($name);
    $faculty->setEstablish($establish);
    $result = $facultyDao->addFaculty($faculty);
    if ($result){
        echo'<div class = "bg-success">Data Successfully added</div>';
    } else{
        echo'<div class = "bg-error">Error add data</div>';
    }
  
}
?>
<form action='' method="post">
    <div class="form-group">
        <label>ID :<input type="number" name="id"/></label></br>
        <label for="catID">Name :<input type="text" name="name" /></label></br>
        <label>Establish :<input type ="text" name="establish"/></label></br>
    </div>
    <input name='Submit' type="submit" class='btn btn-default' />
</form>
<table border="1px">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Establish</th>
            <th>Action</th>
        </tr>
        <t/head> <tbody>
            <?php

            $result= $facultyDao->fetchFacultyData();
            /*@var $faculty Faculty */
            foreach ($result as $faculty) {
                echo '<tr>';
                echo '<td>' . $faculty->getId() . '</td>';
                echo '<td>' . $faculty->getName() . '</td>';
                echo '<td>' . $faculty->getEstablish() . '</td>';
                echo '<td><button onclick="updateValue(\'' . $faculty->getId() . '\')">Update</button>
                <button onclick="deleteValue(\'' . $faculty->getId() . '\')">Delete</button></td>';
                echo '</tr>';
            }
            $link = null;

            ?> </tbody>
</table>