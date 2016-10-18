<?php
    class CategoriaBPO{
        private $codigoCategoria, $nome, $descricao;

        public function __construct($codigoCategoria, $nome, $descricao){
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->codigoCategoria = $codigoCategoria;
        }
        
        public function getNome(){
            return $this->nome;
        }
        public function getCodigo(){
            return $this->codigoCategoria;
        }
        public function getDescricao(){
            return $this->descricao;
        }
    }

?>