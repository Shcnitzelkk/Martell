<?php

class BD{

    public $Servidor;
    public $Usuario;
    public $Link;
    public $Banco;
    public $Charset;

    public function __construct($Servidor, $Usuario, $senha, $Banco, $Charset){
        $this->Abrir($Servidor, $Usuario, $senha, $Banco, $Charset);
    }

    public function __destruct(){
        $this->Fechar();
    }

    public function Abrir($Servidor, $Usuario, $senha, $Banco, $Charset){

        $this->Link = mysql_connect($Servidor, $Usuario, $senha, $Banco, $Charset)
        or die("Erro na conexão: $Servidor"
        . "<br> Erro no usuário $Usuario e ssenha ******. <br/>Erro: " . mysql_error());

        my_select_db($Banco, $this->Link)
            or die("Não foi possível abrir o banco $Banco no servidor $Servidor.<br/>"
            . "Erro: " . mysql_error() . "<br />");

        mysql_set_charset($Charset);

        $this->Servidor = $Servidor;
        $this->Usuario = $Usuario;
        $this->Banco = $Banco;
        $this->Charset = $Charset;
    }

    public function Fechar(){
        if($this->Link!=null){
            @mysql_close($this->Link);
            $this->Link = null;
        }
    }

    
}

class Consulta{
    public $resultado;
    public $BD;

    public function __construct($sq, $bd){
        if(!$bd->Link)
        {
             $bd->Abrir();
             die("entrou");
        }
        $this->resultado = mysql_query($sql, $bd->Link);
        if($this->resultado)
        {
        
        }else{
              die("Erro ao executar comando $sql<br/>"
              . "Erro: " . mysql_error()."<br />");
    }
    $this->BD=$bd;
}

public function Linhas(){
    return mysql_num_rows($this->resultado);
}
public function Campo($Linha, $Campo){
    return mysql_result($this->resultado, $linha, $campo);
}
public function InsertId(){
    return mysql_insert_id($this->Bd->Link);
}
}