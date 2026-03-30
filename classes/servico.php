<?php
class Servico {
    private $pdo;
    

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function cadastrar($nome, $descricao) {
        try {
            $sql = "INSERT INTO servicos (nome, descricao, ativo) VALUES (:nome, :descricao, 1)";
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(':nome', $nome);
            $stm->bindParam(':descricao', $descricao);
            return $stm->execute();
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar serviço: " . $e->getMessage());
            return false;
        }
    }

    public function listarAtivos() {
        $sql ="SELECT * FROM servicos WHERE ativo = true ORDER BY nome";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }
    
    public function listarTodos() {
        $sql = "SELECT * FROM servicos ORDER BY nome";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }

    public function desativar($id) {
        $sql = "UPDATE servicos SET ativo = 0 WHERE id = :id";
        $stm = $this->pdo->prepare($sql);
        $stm->bindParam(':id', $id);
        return $stm->execute();
    }

    public function ativar($id) {
        $sql = "UPDATE servicos SET ativo = 1 WHERE id = :id";
        $stm = $this->pdo->prepare($sql);
        $stm->bindParam(':id', $id);
        return $stm->execute();
    }
}
?>