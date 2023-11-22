<?php
/**
 * Classe Config
 *
 * Essa classe representa a entidade de Config e fornece métodos para interagir com o banco de dados.
 *
 * @package Press Release
 * @category Modelos
 * @author Márcio Maia <https://github.com/bacmarcio>
 * @version 1.0
 * @access public
 */

 class Config
 {
     private $pdo;
     private $configuracoes; // Adicionada a propriedade para armazenar as configurações
 
     private static $instance = null;
 
     private function __construct($conn)
     {
         $this->pdo = $conn;
     }
 
     public static function getInstance($conn)
     {
         if (self::$instance === null) {
             self::$instance = new Config($conn);
         }
         return self::$instance;
     }
 
     public function getPdo()
     {
         return $this->pdo;
     }
 
     public function dadosConfig()
     {
         try {
             $sql = "SELECT * FROM config";
             $stm = $this->pdo->prepare($sql);
             $stm->execute();   
             $dadosConfig = $stm->fetchAll(PDO::FETCH_OBJ);
     
             if (!empty($dadosConfig)) {
                 $config = $dadosConfig[0];
                 
                 $this->configuracoes = [
                     'favicon'      => $config->favicon,
                     'facebook'     => $config->facebook,
                     'twitter'      => $config->twitter,
                     'instagram'    => $config->instagram,
                     'youtube'      => $config->youtube,
                     'linkedln'     => $config->linkedln,
                     'nome_empresa' => $config->nome_empresa,
                     'endereco'     => $config->endereco,
                     'telefone'     => $config->telefone,
                     'email1'       => $config->email1,
                     'email2'       => $config->email2,
                     'cep'          => $config->cep,
                     'cnpj'          => $config->cnpj,
                 ];
             }

         } catch (PDOException $erro) {
             // Log de erro ou lançar uma exceção
             throw new Exception("Erro na função dadosConfig: " . $erro->getMessage());
         }
         
         return (object)$this->configuracoes;
     }
 
     // Adicione métodos adicionais ou propriedades conforme necessário
 } 