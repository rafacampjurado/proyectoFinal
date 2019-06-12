<?php

// CLASE PARA LA CONEXIÓN CON LA BASE DE DATOS

class Conexion {

    const DB_HOST_NAME = 'sql307.epizy.com';
    const DB_NOMBRE = 'epiz_23036069_foodnation';
    const DB_CHARSET = 'utf8';
    const DB_USER = 'epiz_23036069';
    const DB_PASS = '34wYMq1gJcsvM';
    const DB_FORMATO = 'mysql:host=%s;dbname=%s;';

    private $pdo;

    public function __construct() {
        $this->pdo = new PDO(sprintf(self::DB_FORMATO, self::DB_HOST_NAME, self::DB_NOMBRE), self::DB_USER, self::DB_PASS);
    }

    public function select($query, $params = array()) {
        $statement = $this->pdo->prepare($query);
        if (!$statement->execute($params)) {
            throw new PDOException('Error en la consulta select: ' . $query . var_dump($params) . var_dump($this->pdo->errorInfo()));
        }
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    }

    public function selectLimit($query, $limite, $idProducto,$paramWhere) {
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
        $statement->bindParam($paramWhere, $idProducto);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    }

//$statement->bindValue(':limite', $limite, PDO::PARAM_INT);
    public function insert($query, $params) {
        $statement = $this->pdo->prepare($query);
        $rowsAffected = 0;
        foreach ($params as $param) {
            $statement->execute($param);
            $rowsAffected += $statement->rowCount();
        }
        return $rowsAffected;
    }

    public function delete($query, $params) {
        $statement = $this->pdo->prepare($query);
        $statement->execute($params[0]);
    }

}
	