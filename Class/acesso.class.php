<?php
/**
 * Classe Acesso
 *
 * Essa classe representa a entidade de Acesso e fornece métodos para interagir com o banco de dados.
 *
 * @package Press Release
 * @category Modelos
 * @author Márcio Maia <https://github.com/bacmarcio>
 * @version 1.0
 * @access public
 */

class Acesso
{
    /**
     * @var PDO Uma instância da conexão PDO.
     */

    private $pdo;

    /**
     * @var Acesso|null Uma instância única da classe Acesso.
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
     * Obtém uma instância única da classe Acesso.
     *
     * @param PDO $conexao Uma instância da conexão PDO.
     * @return Acesso Uma instância da classe Acesso.
     */

    public static function getInstance($conn)
    {
        if (self::$instance === null) {
            self::$instance = new Acesso($conn);
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
     * Realiza o processo de login de um usuário.
     *
     * @param string $login O nome de usuário ou email.
     * @param string $senha A senha fornecida pelo usuário.
     *
     * @return bool Retorna true se o login for bem-sucedido, ou false em caso contrário.
     */

    public function login($login, $senha)
    {
        if (empty($login) || empty($senha)) {
            
            // Verifique se tanto o login quanto a senha são fornecidos
            return "Por favor, preencha ambos os campos.";
        }
        
        try {
            $sql = "SELECT * FROM tbl_usuarios WHERE email = :login ";
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(':login', $login, PDO::PARAM_STR);
            $stm->execute();
            $usuario = $stm->fetch(PDO::FETCH_OBJ);
           
            
            if ($usuario) {
                
                if (password_verify($senha, $usuario->senha)) {
                    // Senha correta, proceda com o login
                    session_start();
                    $_SESSION['usuarioLogado'] = true;
                    $_SESSION['dadosUsuario'] = $usuario;
                    header("Location: usuarios.php");
                    exit;
                } else {
                    // Senha incorreta
                    return "Senha incorreta. Tente novamente.";
                }
            } else {
                // Dados inválidos
                return "Usuário não encontrado.";
            }
        } catch (PDOException $erro) {
            // Lida com erros de banco de dados
            return "Erro no banco de dados: " . $erro->getMessage();
        }

        return "Erro desconhecido.";
    }

    /**
     * Realiza o processo de logout do usuário.
     * Verifica se a ação 'logout' foi solicitada e, em caso afirmativo, encerra a sessão do usuário.
     *
     * @return void
     */
    
    public function logout()
    {
        if (isset($_GET['acao']) && $_GET['acao'] == 'logout') {
            // Certifique-se de que o usuário realmente deseja sair
            session_start();
        
            if (isset($_SESSION['admLogado'])) {
                // Encerra a sessão
                session_unset();
                session_destroy();
            
                // Redireciona para a página de login ou para onde for apropriado
                header("Location: login.php");
                exit;
            }
        }
    }

    public function restritoAdmin()
    {
        session_start();
        if (empty($_SESSION['usuarioLogado'])&& $_SESSION['usuarioLogado']['adm'] !== 'S') {
            echo "<script>window.location='login.php'</script>";
            exit;
        }
    }



}
