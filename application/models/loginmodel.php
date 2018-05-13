<?php

class LoginModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */

    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function verifyAccount($id, $password)
    {
        $sql = "select * from account where id=:id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));
        $result=$query->fetch(PDO::FETCH_ASSOC);

        if(is_array($result) && password_verify($password,$result['password']))
        {
            Auth::setSession($result['id'],$result['name'],$result['is_admin']);
            echo $result['id'].$result['name'].$result['is_admin'];
        }
        else
        {
            echo "login failed";
            echo $result['id'].$result['name'].$result['is_admin'];
        }
    }

}
