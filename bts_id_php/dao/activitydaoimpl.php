<?php


class ActivityDaoImpl
{
    public function fetchActivityData()
    {
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM activity";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Activity');
        PDOUtil::closeConnection($link);
        return $result;
    }

    public function fetchAktivitasData($cod)
    {
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM activity WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $cod);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeConnection($link);
        return $stmt->fetchObject('Activity');
    }

    public function addActivity(Activity $activity)
    {
        $result = 0;
        $link = PDOUtil::createConnection();
        $query = 'INSERT INTO activity(title,description,place,start_date,end_date,faculty_id,doc_photo,cover,id) VALUES(?,?,?,?,?,?,?,?,?)';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $activity->getTitle());
        $stmt->bindValue(2, $activity->getDescription());
        $stmt->bindValue(3, $activity->getPlace());
        $stmt->bindValue(4, $activity->getStartDate());
        $stmt->bindValue(5, $activity->getEndDate());
        $stmt->bindValue(6, $activity->getFacultyId());
        $stmt->bindValue(7, $activity->getDocPhoto());
        $stmt->bindValue(8, $activity->getCover());
        $stmt->bindValue(9, $activity->getId());        
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
            $result = 1;
        } else {
            $link->rollBack();
        }
        PDOUtil::closeConnection($link);
        return $result;
    }

    public function updateActivity(Activity $activity)
    {
        $result = 0;
        $link = PDOUtil::createConnection();
        $query = 'UPDATE activity SET title=?, description=?,start_date=? , end_date=?,place=? ,doc_photo=?, faculty_id=? WHERE id=?';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $activity->getTitle());
        $stmt->bindValue(2, $activity->getDescription());
        $stmt->bindValue(3, $activity->getStartDate());
        $stmt->bindValue(4, $activity->getEndDate());
        $stmt->bindValue(5, $activity->getPlace());
        $stmt->bindValue(6, $activity->getDocPhoto());
        $stmt->bindValue(7, $activity->getFacultyId());
        $stmt->bindValue(8, $activity->getId());
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
            $result = 1;
        } else {
            $link->rollBack();
        }
        PDOUtil::closeConnection($link);
        return $result;
    }

    public function deleteActivity($cod)
    {
        $result = 0;
        $link = PDOUtil::createConnection();
        $query = 'DELETE FROM activity WHERE id = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $cod);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
            $result = 1;
        } else {
            $link->rollBack();
        }
        PDOUtil::closeConnection($link);
        return $result;
    }
}