<?php

class FacultyDaoImpl
{
    public function fetchFacultyData()
    {
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM faculty";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'faculty');
        closeConnection($link);
        return $result;
    }

    /**
     * @param $id
     * @return Faculty
     */
    public function fetchFaculty($id){
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM faculty WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeConnection($link);
        return $stmt->fetchObject('Faculty');
    }

    public function addFaculty(Faculty $faculty)
    {
        $result = 0;
        $link = createConnection();
        $query = "INSERT INTO faculty(id,name,establish) VALUES(?,?,?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $faculty->getId());
        $stmt->bindValue(2, $faculty->getName());
        $stmt->bindValue(3, $faculty->getEstablish());
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
            $result = 1;
        } else {
            $link->rollBack();
        }
        closeConnection($link);
        return $result;
    }

    public function updateFaculty(Faculty $faculty){
        $result = 0;
        $link = PDOUtil::createConnection();
        $query = "UPDATE faculty SET name = ?, establish = ? WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $faculty->getName());
        $stmt->bindValue(2, $faculty->getEstablish());
        $stmt->bindValue(3, $faculty->getId());
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

    public function deleteFaculty($id)
    {
        $result = 0;
        $link = PDOUtil::createConnection();
        $query = 'DELETE FROM faculty WHERE id = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $id);
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