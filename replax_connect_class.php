<?php
declare(strict_types=1);

/**
* 2022
* ReplaX program 
* @author Damian Narodzonek
*/

class ReplaXConnectDB
{

    private $dbConnection;
    public $connectionStatus = 0;
    public $connectionStatusAlert = "Connection not initiated.";

    /**
     * Function that sets up a database connection
     * @param string $dbHost | Server host adress
     * @param string $dbName | Name of database
     * @param string $dbUser | User login for database
     * @param string $dbPass | User password for database
     */
    public function setDbConnection(string $dbHost, string $dbName, string $dbUser, string $dbPass)
    {
        try {
            //TODO: Check array (switch?) PDO::getAvailableDrivers() to every single driver build $dns value
            if (!in_array("mysql",PDO::getAvailableDrivers())) {
                throw new PDOException("MYSQL Driver on server not aviable.");
            } else {
                try {
                    $dbConnection = new PDO("mysql:host=" . $dbHost . ";dbname=" . $dbName , $dbUser, $dbPass);
                    $this->connectionStatus = 3;
                    $this->connectionStatusAlert = "Succesful connected to database!";
                } catch (PDOException $pdoEx) {
                    $this->connectionStatus = 2;
                    $this->connectionStatusAlert = "Database connection error. Check the entered data. Details: ${$pdoEx->getMessage()}";
                } 
            }
        } catch (PDOException $pdoEx) {
            $this->connectionStatus = 1;
            $this->connectionStatusAlert = $pdoEx->getMessage();
        }
        
    }

    /**
     * Function thats return $dbConnection PDO Object
     * @return PDO Object
     */
    public function getDbConnection() : PDO
    {
        return $this->dbConnection;
    }

}

