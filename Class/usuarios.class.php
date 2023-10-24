<?php

/**
 * Classe Usuarios
 *
 * Essa classe representa a entidade de Usuarios e fornece métodos para interagir com o banco de dados.
 *
 * @package Press Release
 * @category Modelos
 * @author Márcio Maia <https://github.com/bacmarcio>
 * @version 1.0
 * @access public
 */

class Usuarios
{
    /**
     * @var PDO Uma instância da conexão PDO.
     */

    private $pdo;

    /**
     * @var Usuarios|null Uma instância única da classe Usuarios.
     */

    private static $instance = null;

    /**
     * Construtor privado para garantir que a classe seja instanciada apenas uma vez.
     *
     * @param PDO $conexao Uma instância da conexão PDO.
     */

    private function __construct($conn)
    {
        $this->pdo = $conn;
    }

    /**
     * Obtém uma instância única da classe Usuarios.
     *
     * @param PDO $conexao Uma instância da conexão PDO.
     * @return Usuarios Uma instância da classe Usuarios.
     */

    public static function getInstance($conn)
    {
        if (self::$instance === null) {
            self::$instance = new Usuarios($conn);
        }
        return self::$instance;
    }

    /**
     * Obtém a instância da conexão PDO.
     *
     * @return PDO Uma instância da conexão PDO.
     */

    public function getPdo()
    {
        return $this->pdo;
    }

    /**
 * Obtém dados dos usuários com opções de filtrar, ordenar e limitar resultados.
 *
 * @param string $id ID do usuário (opcional).
 * @param string $nome Nome do usuário (opcional).
 * @param string $email Email do usuário (opcional).
 * @param string $orderBy Ordenação dos resultados (opcional).
 * @param int $limite Limite de resultados (opcional).
 *
 * @return mixed Retorna um objeto ou uma lista de objetos de usuários.
 */
    public function dadosUsuarios($id = '', $nome = '', $email = '', $orderBy = '', $limite = '')
    {
        $filtro = [];
        $parametros = [];

        if (!empty($id)) {
            $filtro[] = 'id = ?';
            $parametros[] = $id;
        }

        if (!empty($nome)) {
            $filtro[] = 'nome = ?';
            $parametros[] = $nome;
        }

        if (!empty($email)) {
            $filtro[] = 'email = ?';
            $parametros[] = $email;
        }

        $sqlFiltro = !empty($filtro) ? 'WHERE ' . implode(' AND ', $filtro) : '';
        $sqlOrdem = !empty($orderBy) ? "ORDER BY {$orderBy}" : '';
        $sqlLimite = !empty($limite) ? "LIMIT 0,{$limite}" : '';

        try {
            $sql = "SELECT * FROM usuarios {$sqlFiltro} {$sqlOrdem} {$sqlLimite}";
            $stm = $this->pdo->prepare($sql);

            for ($i = 1; $i <= count($parametros); $i++) {
                $stm->bindValue($i, $parametros[$i - 1]);
            }

            $stm->execute();
            $usuarios = $stm->fetchAll(PDO::FETCH_OBJ);

            if (!empty($id) || $limite == 1) {
                return (!empty($usuarios[0])) ? $usuarios[0] : null;
            } else {
                return $usuarios;
            }
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'addUsuario') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
            $adm = filter_input(INPUT_POST, 'adm', FILTER_SANITIZE_SPECIAL_CHARS);
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            // Verifica se o email já existe
            $sqlVerificaEmail = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
            $stmVerificaEmail = $this->pdo->prepare($sqlVerificaEmail);
            $stmVerificaEmail->bindValue(1, $email, PDO::PARAM_STR);
            $stmVerificaEmail->execute();
            $emailExistente = $stmVerificaEmail->fetchColumn();
            
            if ($emailExistente > 0) {
                return "O email já está em uso. Por favor, escolha outro.";
            }
            
            try {
                $sql = "INSERT INTO usuarios (nome, email, telefone, cpf, senha, adm) VALUES (?, ?, ?, ?, ?, ?)";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, $nome, PDO::PARAM_STR);
                $stm->bindValue(2, $email, PDO::PARAM_STR);
                $stm->bindValue(3, $telefone, PDO::PARAM_STR);
                $stm->bindValue(4, $cpf, PDO::PARAM_STR);
                $stm->bindValue(5, $senha, PDO::PARAM_STR);
                $stm->bindValue(6, $adm, PDO::PARAM_STR);

                $stm->execute();
                $ultimoIdUsuario = $this->pdo->lastInsertId();

                header('Location: usuarios.php');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            }
        }
    }

    public function editar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'editarUsuario') {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
            
            


            if ($_POST['senha']==='') {
                $sqlVerificaSenha = "SELECT senha FROM usuarios WHERE id = ?";
                $stmVerificaSenha = $this->pdo->prepare($sqlVerificaSenha);
                $stmVerificaSenha->bindValue(1, $id, PDO::PARAM_STR);
                $stmVerificaSenha->execute();
                $senhaExistente = $stmVerificaSenha->fetchColumn();
                $senha = $senhaExistente;
            } else {
                $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            }
            

            try {
                $sql = "UPDATE usuarios SET nome=?, email=?, telefone=?, cpf=?, senha=? WHERE id=?";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, $nome, PDO::PARAM_STR);
                $stm->bindValue(2, $email, PDO::PARAM_STR);
                $stm->bindValue(3, $telefone, PDO::PARAM_STR);
                $stm->bindValue(4, $cpf, PDO::PARAM_STR);
                $stm->bindValue(5, $senha, PDO::PARAM_STR);
                $stm->bindValue(6, $id, PDO::PARAM_INT);

                $stm->execute();

                header('Location: usuarios.php');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            }
        }
    }

    public function excluir()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['acao']) && $_GET['acao'] === 'excluirUsuarios' && isset($_GET['id'])) {
            try {
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

                if ($id !== false) {
                    $sql = "DELETE FROM usuarios WHERE id=?";
                    $stm = $this->pdo->prepare($sql);
                    $stm->bindValue(1, $id, PDO::PARAM_INT);
                    $stm->execute();
                } else {
                    // Tratamento para o caso de 'id' não ser um inteiro válido
                    throw new Exception('ID inválido.');
                }

                // Redirecionamento após a exclusão
                header('Location: usuarios.php');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

}
