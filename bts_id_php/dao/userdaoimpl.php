<?php

class UserDaoImpl{
    
    public function login(User $user){
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM user WHERE username = ? AND password = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1,$user->getUsername());
        $stmt->bindValue(2,$user->getPassword());
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeConnection($link);
        return $stmt->fetchObject('User');
    }
}
