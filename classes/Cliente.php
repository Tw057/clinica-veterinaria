<?php
class Cliente {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function cadastrar($nome, $telefone, $endereco, $observacoes) {
        try {
            $sql = "INSERT INTO clientes (nome, telefone, endereco, observacoes) 
                    VALUES (:nome, :telefone, :endereco, :observacoes)";
            
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(':nome', $nome);
            $stm->bindParam(':telefone', $telefone);
            $stm->bindParam(':endereco', $endereco);
            $stm->bindParam(':observacoes', $observacoes);
            
            $stm->execute();
            return $this->pdo->lastInsertId();
            
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar cliente: " . $e->getMessage());
            return false;
        }
    }
    
    public function listarTodos() {
        $sql = "SELECT * FROM clientes ORDER BY nome";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }
    
    public function buscarPorId($id) {
        $sql = "SELECT * FROM clientes WHERE id = :id";
        $stm = $this->pdo->prepare($sql);
        $stm->bindParam(':id', $id);
        $stm->execute();
        return $stm->fetch();
    }
}
?>