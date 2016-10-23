<?php
    require_once 'usuario.php';

    class PrestadorBPO extends Usuario{
        private $codigoPrestador;
        private $dsProfissional;
        private $qtAreaDeAlcance;
        
        public function __construct($codigoPrestador, $nome, $email, $telefone, LoginBPO $login, EnderecoBPO $endereco, $dsProfissional, $qtAreaDeAlcance){
            parent::__construct($nome, $email, $telefone,$endereco,$login);
            $this->codigoPrestador = $codigoPrestador;
            $this->dsProfissional = $dsProfissional;
            $this->qtAreaDeAlcance = $qtAreaDeAlcance;
        }
        public function getCodigoPrestador(){
            return $this->codigoPrestador;
        }
        public function getDescricaoProfissional(){
            return $this->dsProfissional; 
        }
        public function getAreaAlcance(){
            return $this->qtAreaDeAlcance;
        }

        public function solicitarConexao(AnuncianteBPO $u) {
            return Chat::abrirChat($u);
        }
        public function aceitarConexao(Chat $c) {
            return Chat::aceitarChat($c);
        }
    }
?>
