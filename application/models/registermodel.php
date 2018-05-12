<?php

class RegisterModel
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

    public function addAccount($id, $password, $name)
    {
        // clean the input from javascript code for example

        $sql = "INSERT INTO account (id, password, name ) VALUES (:id, :password, :name)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id, ':password' => password_hash($password,PASSWORD_DEFAULT),':name' => $name));
    }

}
