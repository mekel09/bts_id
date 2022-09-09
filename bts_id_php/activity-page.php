<?php
$activityDao = new ActivityDaoImpl();
$komen = filter_input(INPUT_GET, 'cad');
if (isset($komen) && $komen == 'del') {
    $cod = filter_input(INPUT_GET, 'cod');
    if (isset($cod)) {
        $activity = $activityDao->fetchAktivitasData($cod);
        unlink('Upload/' . $activity->getCover());
        $result = $activityDao->deleteActivity($cod);
        if ($result) {
            echo '<div class="bg-success">Activity successfully deleted</div>';
        } else {
            echo '<div class="bg-danger">Error delete Activity</div>';
        }
    }
}

$submitPressed = filter_input(INPUT_POST, 'Submit');
if (isset($submitPressed)) {
    $id = filter_input(INPUT_POST, 'id');
    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');
    $place = filter_input(INPUT_POST, 'place');
    $start_date = filter_input(INPUT_POST, 'start_date');
    $end_date = filter_input(INPUT_POST, 'end_date');
    $doc_photo = filter_input(INPUT_POST, 'doc_photo');
    $faculty_id = filter_input(INPUT_POST, 'faculty_id');
    $newFileName = "";
    if (isset($_FILES['activityCover']['name'])) {
        $targetDirectory = 'Upload/';
        $fileExtension = pathinfo($_FILES['activityCover']['name'], PATHINFO_EXTENSION);
        $newTitle = str_replace(' ', '_', $title);
        $newFileName = $id . '.' . $fileExtension;
        $targetFile = $targetDirectory . $newFileName;
        if ($_FILES['activityCover']['size'] > 1024 * 2048) {
            echo '<div class="bg-info">Upload error. File size exceed 2 MB </div>';
        } else {
            move_uploaded_file($_FILES['activityCover']['tmp_name'], $targetFile);
        }
    }
    $activity = new Activity();
    $activity->setTitle($title);
    $activity->setDescription($description);
    $activity->setStartDate($start_date);
    $activity->setEndDate($end_date);
    $activity->setPlace($place);
    $activity->setDocPhoto($doc_photo);
    $activity->setFacultyId($faculty_id);
    $activity->setCover($newFileName);
    $activity->setId($id);
    $result = $activityDao->addActivity($activity);
    if ($result) {
        echo '<div class = "bg-success">Data Successfully added(activity)</div>';
    } else {
        echo '<div class = "bg-error">Error add data</div>';
    }
    header("location:index.php?menu=book");
}
?>
<form action='' method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>ID :<input type="text" name="id" /></label></br>
        <label>Title :<input type="text" name="title" /></label><br>
        <label>Description : <input type="text" name="description" /></label></br>
        <label>Place :<input type="text" name="place" /></label></br>
        <label>Start_date :<input type="text" name="start_date" /></label></br>
        <label>End_date :<input type="text" name="end_date" /></label></br>
        <label>Doc_photo :<input type="text" name="doc_photo" /></label></br>
        <label>Faculty_id :<input type="int" name="faculty_id" /></label>
    </div>
    <div class="form-group">
        <label class="control-label">Foto :</label>
        <input type="file" name="activityCover" class="form-control" accept="image/png, image/jpeg">
    </div>
    <input name='Submit' type="submit" class='btn btn-default' />
</form>
<table border="1px">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Foto</th>
            <th>Description</th>
            <th>Place</th>
            <th>Start_date</th>
            <th>End_date</th>
            <th>Doc_photo</th>
            <th>Faculty_id</th>
            <th>Action</th>
        </tr>
        <t/head> <tbody>
            <?php
                $result = $activityDao->fetchActivityData();
                foreach ($result as $row) {
                    echo '<tr>';
                    echo '<td>' . $row->getId() . '</td>';
                    echo '<td>' . $row->getTitle() . '</td>';
                    echo '<td>';
                    if ($row->getCover()) {
                        echo '<img class="img-tbl" src="Upload/' . $row->getCover() . '">';
                    }
                    echo '</td>';
                    echo '<td>' . $row->getDescription() . '</td>';
                    echo '<td>' . $row->getPlace() . '</td>';
                    echo '<td>' . $row->getStartDate() . '</td>';
                    echo '<td>' . $row->getEndDate() . '</td>';
                    echo '<td>' . $row->getPlace() . '</td>';
                    echo '<td>' . $row->getFacultyId() . '</td>';
                    echo '<td><button onclick="ubahValue(\'' . $row->getId() . '\')">Update</button>
                        <button onclick="hapusValue(\'' . $row->getId() . '\')">Delete</button></td>';
                    echo '</tr>';
                }
            $link = null;
            ?>
            </tbody>
</table>