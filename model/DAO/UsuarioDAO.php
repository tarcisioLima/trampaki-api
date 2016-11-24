<?php
    require_once 'configuration/autoload-geral.php';
    
    abstract class UsuarioDAO{
        protected function cadastrarUsuario($nome, $email, $codigoLogin, $codigoEndereco, $tel, $tipoUsuario, $codigoImagem){
            $bancoDeDados = DataBase::getInstance();
            $querySQL = "INSERT INTO usuario (nm_usuario, ds_email, cd_login, cd_endereco, ds_telefone, cd_tipo, cd_imagem) 
                                VALUES (:nm_usuario, :ds_email, :cd_login, :cd_endereco, :ds_telefone, :cd_tipo, :cd_imagem)";
                         
            $comandoSQL   = $bancoDeDados->prepare($querySQL);
            $comandoSQL -> bindParam(':ds_email', $email);
            $comandoSQL -> bindParam(':nm_usuario', $nome);
            $comandoSQL -> bindParam(':ds_telefone', $tel);
            $comandoSQL -> bindParam(':cd_login', $codigoLogin);
            $comandoSQL -> bindParam(':cd_endereco', $codigoEndereco);
            $comandoSQL -> bindParam(':cd_tipo', $tipoUsuario);
            $comandoSQL -> bindParam(':cd_imagem', $codigoImagem);
            $comandoSQL->execute();
            return $bancoDeDados->lastInsertId();
        }
        protected function editarUsuario($objetoUsuario){
            $bancoDeDados = Database::getInstance();
            $querySQL   = "UPDATE usuario SET 
                           nm_usuario = :nm_usuario, ds_email = :ds_email, ds_telefone = :ds_telefone  
                           WHERE cd_usuario = :cd_usuario";
            $comandoSQL =  $bancoDeDados->prepare($querySQL);
            $comandoSQL -> bindParam(':nm_usuario',  $objetoUsuario->getNome());
            $comandoSQL -> bindParam(':ds_email',    $objetoUsuario->getEmail());
            $comandoSQL -> bindParam(':ds_telefone', $objetoUsuario->getTelefone());
            $comandoSQL -> bindParam(':cd_usuario',  $objetoUsuario->getCodigoUsuario());
            $comandoSQL->execute();
        }
        protected function novaConexao($codigoPrestador, $codigoAnuncio){
            $bancoDeDados = Database::getInstance();
            $querySQL = "INSERT INTO conexao (cd_usuario, cd_anuncio, cd_status) 
                                VALUES (".$codigoPrestador.", ".$codigoAnuncio.", '0')";
            $comandoSQL = $bancoDeDados->prepare($querySQL);
            $comandoSQL->execute();                
        }
        public function aceitarConexao($codigoConexao){
            $bancoDeDados = Database::getInstance();
            $comandoSQL = $bancoDeDados->prepare("UPDATE conexao SET cd_status = '1' WHERE cd_conexao = :cd_conexao");
            $comandoSQL->bindParam(':cd_conexao', $codigoConexao);
            $comandoSQL->execute();       
        }
        protected function getCodigo($token) {
            $cmd = Database::getInstance()->prepare(
                "SELECT cd_usuario FROM usuario INNER JOIN login
                    ON usuario.cd_login = login.cd_login
                        WHERE cd_token = :token");
            $cmd->bindParam(":token", $token);
            $cmd->execute();
            return $cmd->fetch(PDO::FETCH_OBJ)->cd_usuario;
        }
    }
?>
