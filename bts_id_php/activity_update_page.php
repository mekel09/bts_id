<?php
$activityDao = new ActivityDaoImpl();
$cod = filter_input(INPUT_GET,'cod');
if (isset($cod)){
    $result = $activityDao->fetchAktivitasData($cod);
}

$submitPressed = filter_input(INPUT_POST, 'Submit');
if (isset($submitPressed)) {
    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');
    $place = filter_input(INPUT_POST, 'place');
    $start_date = filter_input(INPUT_POST, 'start_date');
    $end_date = filter_input(INPUT_POST, 'end_date');
    $doc_photo = filter_input(INPUT_POST, 'doc_photo');
    $faculty_id = filter_input(INPUT_POST,'faculty_id');
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
    $activity->setId($result->getId());
    $result = $activityDao->updateActivity($activity);
    if ($result) {
        echo '<div class="bg-success">Data successfully added  </div>';
    } else {
        echo '<div class="bg-error">Failed to add data</div>';
    }
    header("location:index.php?menu=book");
}
?>
<form action='' method="post">
    <div class="form-group">
        <label>ID :<input type="text" name="id" value=<?php echo $result->getId();?>></label></br>
        <label>Title :<input type="text" name="title" value=<?php echo $result->getTitle();?>></label><br>
        <label>Description : <input type="text" name="description" value=<?php echo $result->getDescription();?>></label></br>
        <label>Place :<input type="text" name="place" value=<?php echo $result->getPlace();?>></label></br>
        <label>Start_date :<input type="text" name="start_date" value=<?php echo $result->getStartDate();?>></label></br>
        <label>End_date :<input type="text" name="cover" value=<?php echo $result->getEndDate();?>></label></br>
        <label>Doc_photo :<input type="text" name="doc_photo" value=<?php echo $result->getDocPhoto();?>></label>
        <label>Faculty_id :<input type="int" name="faculty_id" value=<?php echo $result->getFacultyId();?>></label>
    </div>
    <input name='Submit' type="submit" class='btn btn-default' />
</form>