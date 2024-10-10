<?php 

include_once("../services/connectionDB.php");


class modelUsers{

    protected $salt = "Tit0s@2024";

    public function save($data){
        try {
            
            $firstname = htmlspecialchars($data["firstname"], ENT_NOQUOTES);
            $lastname = htmlspecialchars($data["lastname"], ENT_NOQUOTES);
            //Usuario e email= username
            $username = htmlspecialchars($data["username"], ENT_NOQUOTES);
            $password = htmlspecialchars($data["password"], ENT_NOQUOTES);
            $birthday = htmlspecialchars($data["birthday"], ENT_NOQUOTES);
            $cpf = filter_var($data["cpf"], FILTER_SANITIZE_NUMBER_INT);
            //permissão
            $permission = htmlspecialchars($data["permission"], ENT_NOQUOTES);


            //Irá chamar a função de criptografia de senha
            $password_Secure = $this->tokenize($password);

            $conn = connectionDB::connect();
            $save = $conn->prepare("INSERT INTO tblUsers VALUES(':firstname',':lastname',':username',':password_secure',':birthday', ':cpf', ':mail', 2, NOW() )");
            $save->bindParam(":firstname",$firstname);
            $save->bindParam(":lastname",$lastname);
            $save->bindParam(":username",$username);
            $save->bindParam(":password_secure",$password_secure);
            $save->bindParam(":birthday",$birthday);
            $save->bindParam(":cpf",$cpf);
            $save->bindParam(":mail",$mail);
            $save->execute();


        } catch (PDOException $e) {
            return false;
        }
    }

    protected function tokenize($value){
        try {

            $combinePassword = $value . $this->salt;
            
            return password_hash($combinePassword, PASSWORD_BCRYPT);
            
        } catch (PDOException $e) {
            return false;
        }
    }

    private function searchUserByEmail($username){
        try {
            $conn = connectionDB::connect();
            $search = $conn->prepare("SELECT id_user FROM tblUsers WHERE username =':username' ");
            $search->bindParam(":username", $username);
            $search->execute();
            $result = $search->fetch(PDO::FETCH_ASSOC);

            return $result;
            
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function saveGroup($id_user, $group){
        try {
            $conn = connectionDB::connect();
            $saveGroup = $conn->prepare("INSERT INTO  tbluserroules VALUES (':id_user', ':group')");
            $saveGroup->bindParam(':id_user', $id_user);
            $saveGroup->bindParam(':group', $group);
            $saveGroup->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }

    }

    public function auth($data){
        try {

            $username = htmlspecialchars($data["username"], ENT_NOQUOTES);

            $conn = connectionDB::connect();
            $auth = $conn->prepare("SELECT * FROM tblUsers WEHERE username = ':username' ");
            $auth->bindParam('username', $username);
            $auth->execute();
            $result = $auth->fetch(PDO::FETCH_ASSOC);

            if($result){
                $passwordDB = $result->pass_user;

                $validatePassword = password_verify($data->password . $this->salt, $passwordDB);

                if($validatePassword){
                    return $result;
                } else {
                    return false;    
                }
            }  
            
        } catch (PDOException $e) {
            return false;
            
        }
    }

    public function generateTwoFactor($data){
        try {

            //dados recebidos da requisição
            $username =    htmlspecialchars($data["username"], ENT_NOQUOTES);

            //EXPIRAÇÃO DO TOKEN
            $expired_at = date('d/m/y H:i:s', time() + (15*60));

            
            //GERAR TOKEN COM A DATA E HORA ATUAL ATUAL COM NOME DO USUÁRIO
            $token = md5(date('d/m/y H:i:s') . $data->username);
            $finalToken = substr($token, 6);

            //GRAVAR OS DADOS DO TOKEN
            $conn = connectionDB::connect();
            $saveToken = $conn->prepare("INSERT INTO tblTokens VALUES(':token', ':username', ':expired')");
            $saveToken->bindParam(':token', $finalToken);
            $saveToken->bindParam(':username', $username);
            $saveToken->bindParam(':expired', $expired_at);
            $saveToken->execute();

            if($saveToken){
                //texto do corpo do email
                $message = "Utilize o token: $finalToken";

                $sendMail = mail($username, 'Token', $message);

                if($sendMail){
                    return true;
                } else { 
                    return false;
                }
                
            }




        } catch (PDOException $e) {
            return false;
        }
    }

    public function validateTwoFactor($data){
        try {
            $token = htmlspecialchars($data["token"], ENT_NOQUOTES);
            $username = htmlspecialchars($data["username"], ENT_NOQUOTES);

            $conn = connectionDB::connect();
            $validate = $conn->prepare("SELECT * FROM tbltokens WHERE username = ':username' AND token = ':token'");
            $validate->bindParam('username', $username);
            $validate->bindParam('token', $token);
            $result = $validate->fetch(PDO::FETCH_ASSOC);
            $validate->execute();

            //obter data e hora atual
            $now = date('d/m/y H:i:s');
            //converter data atual para validar expiração
            $date = strtotime($now);
            //converter data expiração para validação
            $expired_at = strtotime($result["expired_at"]);

            //deletar o token após o uso
            $deleteToken = $conn->prepare("DELETE  FROM tblTokens WHERE username = ':username', AND token = ':token'");
            $deleteToken->bindParam(":username", $username);
            $deleteToken->bindParam(":token", $token);
            $deleteToken->execute();

            // validar se a date e hora atual é superior a data de expiração
            if($date > $expired_at){
                return false;
            }else{
                return true;
            }

        } catch (PDOException $e) {
            return false;
        }
    }

    public function listAll(){
        try {
            $conn = connectionDB::connect();
            $list = $conn->query("SELECT * FROM tblUsers");
            $result = $list->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function searchById($id){
        try {
            $id = filter_list($id, FILTER_SANITIZE_NUMBER_INT);

            $conn = connectionDB::connect();
            $search = $conn->prepare("SELECT * FROM tblUsers WHERE id_user = ':id_user'");
            $search->bindParam(":id_user",$id_user);
            $search->execute();
            $result = $search->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id){
        try {
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            $conn = connectionDB::connect();
            $delete = $conn->prepare("DELETE FROM tblUsers WHERE id_user = 'id_user'");
            $delete->bindParam(":id_user", $id_user);
            $delete->execute();
            
            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($id, $data){
        try {
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $firstname = htmlspecialchars($data["firstname"], ENT_NOQUOTES);
            $lastname = htmlspecialchars($data["lastname"], ENT_NOQUOTES);
            $mail = filter_var($data ["mail"], ENT_NOQUOTES);
            $password = htmlspecialchars($data ["password"], ENT_NOQUOTES);
            $status = filter_var($data["status"], FILTER_SANITIZE_NUMBER_INT);

            $conn = connectionDB::connect();
            $update = $conn->prepare("UPDATE tblUsers SET firstname = ':firstname', lastname = ':lastname', mail = ':mail', pass_user = ':password', id_status = ':id_status', updated_at = NOW(), WHERE id_user = ':id_user' ");
            $update->bindParam(':firstname', $firstname);
            $update->bindParam(':lastname', $lastname);
            $update->bindParam(':mail', $mail);
            $update->bindParam(':password', $password);
            $update->bindParam(':status', $status);
            $update->execute();

            return true;


        } catch (PDOException $e) {
            return false;
        }
    }



}



?>