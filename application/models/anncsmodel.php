<?php

class AnncsModel
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

    public function getAllAnncs()
    {
        $sql = "SELECT id, title, `date`, description FROM anncs";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    public function getAnnc($annc_id)
    {
        $sql = "SELECT id, title, `date`, description FROM anncs Where id=:annc_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':annc_id' => $annc_id));

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetch();
    }

    public function addAnnc($title, $date, $descritpion)
    {
        // clean the input from javascript code for example

        $sql = "INSERT INTO anncs (title, `date`, description ) VALUES (:title, :date, :description)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':title' => $title, ':date' => $date, ':description' => $descritpion));
    }

    public function deleteAnnc($annc_id)
    {
        $sql = "DELETE FROM anncs WHERE id = :annc_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':annc_id' => $annc_id));
    }
}
