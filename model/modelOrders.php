 <?php
 include_once("../services/connectionDB.php");
 

 class modelOrder{
    public function litOrderByClient ($id_user) {
        try {
            $conn = connectionDB::connect();
            $list = $conn->query("SELECT * FROM tblOrders WHERE id_user = :id_user ");
            $list->bindParam(":id_user", $id_user);
            $list->execute();

            $result = $list->fetchAll(PDO:: FETCH_ASSOC);

            return $result;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function listAllOrders(){
        try {
            $conn = connectionDB::connect();

            $listAll = $conn->query("SELECT * FROM tblOrders");
            $result = $listAll->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function listOrderByStatus($id_status){
        try {
            $conn = connectionDB::connect();

            $list = $conn->prepare("SELECT * FROM tblOrders WHERE id_status = :id_stauts");
            $list->bindParam(":id_status", $id_status);
            $list->execute();

            $result = $list(PDO::FETCH_ASSOC);

            return $result;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function insertItenCart ($data){
        try {            

            $id_cart = filter_var($data["id_cart"], FILTER_SANITIZE_NUMBER_INT);
            $id_product = filter_var($data["id_product"], FILTER_SANITIZE_NUMBER_INT);
            $price_product = filter_var($data["price_product"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $qtd = filter_var($data["qdt"], FILTER_SANITIZE_NUMBER_INT);

            $conn = connectionDB::connect();
            $insert = $conn->prepare("INSERT INTO tblInterCart (id_cart, id_product, price_product, qtd,created_at)VALUES(:id_cart, :id_product, :price_product, :qtd, NOW() )");
            $insert->bindParam(":id_cart", $id_cart);
            $insert->bindParam(":id_product", $id_product);
            $insert->bindParam(":price_product", $price_product);
            $insert->bindParam(":qtd", $qtd);
            $insert->execute();
            

            return true;

        } catch (PDOException $e) {
            return false;
        }

        
    }


    public function createCart($data){
        try {
            $id_user = filter_var($data ["id_user"], FILTER_SANITIZE_NUMBER_INT);
            //expirar carrinho em 24H
            $fuso = new DateTimeZone('Amerrica/Sao_paulo');
            $dataHoraAtual = new DateTime();
            $dataHoraAtual->setTimezone($fuso);
            //Adciona 24H
            $dataHoraAtual->modify('+1days');
            $expired_at = $dataHoraAtual->format('Y-m-d H:i:s');

            $conn = connectionDB::connect();
            $create = $conn->prepare("INSERT INTO tblCart (id_user, expired_at, created_at)VALUES(:id_user, :expired_at, NOW() )");
            $create->bindParam(":id_user", $id_user);
            $create->bindParam(":expired_at", $expired_at);
            $create->execute();

            return true;

        } catch (PDOException $e) {
            return false;
        }
       
    }


    public function deleteCart($id_cart){
        try {

            $id_cart = filter_var($id_cart, FILTER_SANITIZE_NUMBER_INT);
                        
            $conn = connectionDB::connect();
            $delete = $conn->prepare("DELETE * FROM tblItensCart WHERE id_cart = :id_cart");
            $delete->bindParam(":id_cart", $id_cart);
            $delete->execute();

            if($delete){
                $deleteCart = $conn->prepare("DELETE * FROM tblCart WHERE id_cart = :id_cart");
                $deleteCart->bindParam(":id_cart", $id_cart);
                $deleteCart->execute(); 

                return true;

            } else{
                return false;
            }
    
        } catch (PDOException $e) {
            return false;
        }
    
        
    }

    //public function (){
    //    try {
    //        
    //        $conn = connectionDB::connect();
    //        $list = $conn->prepare("SELECT * FROM ");
    //
    //    } catch (PDOException $e) {
    //        return false;
    //    }
    //
    //    
    //}
    
 }
 
 ?>