<?php
class Connection
{
    //private string $_host = '192.168.1.17';
    private string $_host = 'localhost';
    //private string $_user = 'local';
    private string $_user = 'root';
    //private string $_password = 'local123';
    private string $_password = '';
    private string $_dbname = 'ketal';
    private int $_port = 3307;

    public function connect(): PDO
    {
        try {
            $connection = new PDO("mysql:host=$this->_host;port=$this->_port;dbname=$this->_dbname", $this->_user, $this->_password);
        }
        catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $connection;
    }
}