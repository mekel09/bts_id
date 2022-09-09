<?php

function fetchActivityData() {
    $link = createConnection();
    $query = "SELECT * FROM activity ";
    $result = $link->query($query);
    closeConnection($link);
    return $result;
}

function fetchAktivitasData($cod) {
    $link = createConnection();
    $query = "SELECT * FROM activity WHERE id = ?";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1,$cod);
    $stmt->execute();
    closeConnection($link);
    return $stmt->fetch();
}

function addActivity($title,$description,$place,$start_date,$end_date,$doc_photo,$faculty_id,$cover = null){
    $result=0;
    $link = createConnection();
    $query = "INSERT INTO activity(title,description,place,start_date,end_date,doc_photo,faculty_id,cover) VALUES(?,?,?,?,?,?,?,?)";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $title);
    $stmt->bindParam(2, $description);
    $stmt->bindParam(3, $place);
    $stmt->bindParam(4, $start_date);
    $stmt->bindParam(5, $end_date);
    $stmt->bindParam(6, $doc_photo);
    $stmt->bindParam(7,$faculty_id);
    $stmt->bindParam(8,$cover);
    $link->beginTransaction();
    if($stmt->execute()){
        $link->commit();
        $result=1;
    } else{
        $link->rollBack();
    }
    closeConnection($link);
    return $result;
}
?>