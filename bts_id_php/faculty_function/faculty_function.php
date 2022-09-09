<?php
function fetchFacultyData() {
    $link = createConnection();
    $query = "SELECT * FROM faculty ";
    $result = $link->query($query);
    closeConnection($link);
    return $result;
}

function fetchFaculty($cid){
    $link = createConnection();
    $query="SELECT * FROM faculty WHERE id = ?";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1,$cid);
    $stmt->execute();
    $result = $stmt->fetch();
    closeConnection($link);
    return $result;
}

function addFaculty($id,$name,$establish){
    $result=0;
    $link = createConnection();
    $query = "INSERT INTO faculty(id,name,establish) VALUES(?,?,?)";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1,$id);
    $stmt->bindParam(2,$name);
    $stmt->bindParam(3,$establish);
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

function deleteFaculty($id){
    $result = 0;
    $link = createConnection();
    $query = 'DELETE FROM faculty WHERE id = ?';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1,$id);
    $link->beginTransaction();
    if ($stmt->execute()){
        $link->commit();
        $result = 1;
    }else{
        $link->rollBack();
    }
    closeConnection($link);
    return $result;
}

function updateFaculty($name, $establish){
    $link = createConnection();
    $query = 'UPDATE faculty SET name=? , establish =? WHERE id=?';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1,$name);
    $stmt->bindParam(2,$establish);
    $link->beginTransaction();
    if ($stmt->execute()){
        $link->commit();
    }else{
        $link->rollBack();
    }
    closeConnection($link);
    header("location:index.php?menu=cat");
}