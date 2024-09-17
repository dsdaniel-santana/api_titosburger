<?php
class controllerCategories{
    public function save($data){
        try {
            $modelCategories = new modelCategories();
            return $modelCategories->save($data);
        } catch (PDOException $e) {
            return false;
            
        }
    }

    //listar todas as categorias
    public function listAll(){
        try {
            $modelCategories = new modelCategories();
            return $modelCategories->listAll();
        } catch (PDOException $e) {
            return false;
        }
    }

    //listar categoiras por ID
    public function searchById($id){
        try {
            $modelCategories = new modelCategories();
            return $modelCategories->searchById($id);
        } catch (PDOException $e) {
            return false;
        }
    }

    //Atualizar categorias por ID
    public function update($id, $data){
        try {
            $modelCategories = new modelCategories();
            return $modelCategories->update($id, $data);
        } catch (PDOException $e) {
            return false;
        }
    }

    //deletar categorias por id
    public function delete($id){
        try {
            $modelCategories = new modelCategories();
            return $modelCategories->delete($id);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>