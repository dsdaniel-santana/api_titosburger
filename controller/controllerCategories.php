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
            $controllerCategories = new controllerCategories();
            return $controllerCategories->listAll();
        } catch (PDOException $e) {
            return false;
        }
    }

    //listar categoiras por ID
    public function searchById($id){
        try {
            $controllerCategories = new controllerCategories();
            return $controllerCategories->searchById($id);
        } catch (PDOException $e) {
            return false;
        }
    }

    //Atualizar categorias por ID
    public function update($id, $data){
        try {
            $controllerCategories = new controllerCategories();
            return $controllerCategories->update($id, $data);
        } catch (PDOException $e) {
            return false;
        }
    }

    //deletar categorias por id
    public function delete($id){
        try {
            $controllerCategories = new controllerCategories();
            return $controllerCategories->delete($id);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>