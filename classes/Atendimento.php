<?php
class Atendimento {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function criar($pet_id, $servico_id, $data, $hora, $observacoes) {
        try {
            // Verifica se horário está ocupado
            $sql = "SELECT id FROM atendimentos WHERE data = :data AND hora = :hora";
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(':data', $data);
            $stm->bindParam(':hora', $hora);
            $stm->execute();

            if ($stm->rowCount() > 0) {
                return ['sucesso' => false, 'mensagem' => 'Horário já está ocupado!'];
            }

            // Insere atendimento
            $sql = "INSERT INTO atendimentos 
                    (pet_id, servico_id, data, hora, observacoes, status)
                    VALUES 
                    (:pet_id, :servico_id, :data, :hora, :observacoes, 'agendado')";
            
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(':pet_id', $pet_id);
            $stm->bindParam(':servico_id', $servico_id);
            $stm->bindParam(':data', $data);
            $stm->bindParam(':hora', $hora);
            $stm->bindParam(':observacoes', $observacoes);
            
            if ($stm->execute()) {
                return ['sucesso' => true, 'mensagem' => 'Atendimento agendado com sucesso!'];
            }

        } catch (PDOException $e) {
            return [
                "sucesso" => false,
                "mensagem" => $e->getMessage()
            ];
        }
    }

    public function listarPorPet($pet_id) {
        $sql = "SELECT 
                    a.*, 
                    s.nome as nome_servico 
                FROM atendimentos a 
                JOIN servicos s ON a.servico_id = s.id 
                WHERE a.pet_id = :pet_id 
                ORDER BY a.data DESC, a.hora DESC";
        
        $stm = $this->pdo->prepare($sql);
        $stm->bindParam(':pet_id', $pet_id);
        $stm->execute();
        return $stm->fetchAll();
    }
    
    public function listarPorPeriodo($data_inicio, $data_fim) {
        $sql = "SELECT 
                    a.*, 
                    p.nome as nome_pet, 
                    c.nome as nome_cliente,
                    s.nome as nome_servico
                FROM atendimentos a 
                JOIN pets p ON a.pet_id = p.id 
                JOIN clientes c ON p.cliente_id = c.id 
                JOIN servicos s ON a.servico_id = s.id
                WHERE a.data BETWEEN :data_inicio AND :data_fim 
                ORDER BY a.data, a.hora";
        
        $stm = $this->pdo->prepare($sql);
        $stm->bindParam(':data_inicio', $data_inicio);
        $stm->bindParam(':data_fim', $data_fim);
        $stm->execute();
        return $stm->fetchAll();
    }
}
?>