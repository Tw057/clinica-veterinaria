<?php
class Pet {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function cadastrar($cliente_id, $nome, $especie, $raca, $idade, $peso, $temperamento, $historico_clinico) {
        try {
            $sql = "INSERT INTO pets (cliente_id, nome, especie, raca, idade, peso, temperamento, historico_clinico)
                    VALUES (:cliente_id, :nome, :especie, :raca, :idade, :peso, :temperamento, :historico_clinico)";
            
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(':cliente_id', $cliente_id);
            $stm->bindParam(':nome', $nome);
            $stm->bindParam(':especie', $especie);
            $stm->bindParam(':raca', $raca);
            $stm->bindParam(':idade', $idade);
            $stm->bindParam(':peso', $peso);
            $stm->bindParam(':temperamento', $temperamento);
            $stm->bindParam(':historico_clinico', $historico_clinico);
            
            $stm->execute();
            return $this->pdo->lastInsertId();
            
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar pet: " . $e->getMessage());
            return false;
        }
    }
    
    public function listarPorCliente($cliente_id) {
        $sql = "SELECT * FROM pets WHERE cliente_id = :cliente_id ORDER BY nome";
        $stm = $this->pdo->prepare($sql);
        $stm->bindParam(':cliente_id', $cliente_id);
        $stm->execute();
        return $stm->fetchAll();
    }
    
    public function buscarPorId($id) {
        $sql = "SELECT p.*, c.nome as nome_cliente 
                FROM pets p 
                JOIN clientes c ON p.cliente_id = c.id 
                WHERE p.id = :id";
        $stm = $this->pdo->prepare($sql);
        $stm->bindParam(':id', $id);
        $stm->execute();
        return $stm->fetch();
    }
}
?>