<?php 
class controllerStatus{
    
    //Listar todos os Status
    public function getAll(){
        try {
            $modelStatus = new modelStatus();
            return $modelStatus->getAll();

        } catch (PDOException $e) {
            return false;
        }
    }

    //Listar status por ID
    public function getById($idStatus){
        try {
            $modelStatus = new modelStatus();
            return $modelStatus->getById($idStatus);
        } catch (PDOException $e) {
            return false;
        }
    }

    //Inserir um novo Status
    public function save($data){
        try {
            
            $modelStatus = new modelStatus();
            return $modelStatus->save($data);

        } catch (PDOException $e) {
            return false;
        }
    }

    //Atualizar um status existente
    public function update($idStatus, $data){
        try {

            $modelStatus = new modelStatus();
            return $modelStatus->update($idStatus, $data);

        } catch (PDOException $e) {
            return false;
        }
    }

    //Deletar um status existente
    public function delete($idStatus){
        try {
            $modelStatus = new modelStatus();
            return $modelStatus->delete($idStatus);
        } catch (PDOException $e) {
            return false;
        }
    }




}

?>