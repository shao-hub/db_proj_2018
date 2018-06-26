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

    public function findAccount($id)
    {
        $sql = "select * from account where id=:id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));
        return $query->fetch();
    }

    public function addAccount($id, $password, $name, $email)
    {
        // clean the input from javascript code for example

        $sql = "INSERT INTO account (id, password, name, email ) VALUES (:id, :password, :name, :email)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id, ':password' => password_hash($password,PASSWORD_DEFAULT),':name' => $name,':email' => $email));
    }

    public function verifyReCaptcha($response)
    {
        $post_data = http_build_query(
            array(
                'secret' => RECAPTCHA_SECRETKEY,
                'response' => $response,
            )
        );

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $post_data
            )
        );

        $context  = stream_context_create($opts);
        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
        $result = json_decode($response);

        if($result->success == 'true')
            return TRUE;
        else
            return FALSE;
    }

    // check if a user id is valid
    public function isValidId($id) {
        // In NCTU, student id is 7 digits
        if (strlen($id) != 7) return FALSE;
        if (!ctype_digit($id)) return FALSE;
        return TRUE;
    }
}
