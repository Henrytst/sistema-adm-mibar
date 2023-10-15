<?php

class Funcionarios
{
    private $id,
        $arquivo,
        $nome_arquivo,
        $diretorio,
        $name,
        $nascimento,
        $idade,
        $sexo,
        $rg,
        $cpf,
        $tatuagem,
        $email,
        $cb,
        $phone,
        $celular,
        $camisa,
        $calca,
        $terno,
        $calcado,
        $peso,
        $altura,
        $status,
        $funcao,
        $idiomas,
        $escolaridade,
        $disponibilidade,
        $observacoes,
        $complemento,
        $created_at,
        $update_at;

    public $conectar;

    public function __construct()
    {
        try {
            $this->conectar = new PDO("mysql:host=localhost;dbname=MIBAR", "root", "");
            $this->conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            //echo 'Error: ' . $e->getMessage();
            header('location: ./migrations/index.php');
        }
    }
    public function adicionarCliente(
        $arquivo,
        $nome_arquivo,
        $diretorio,
        $name,
        $nascimento,
        $idade,
        $sexo,
        $rg,
        $cpf,
        $tatuagem,
        $email,
        $cb,
        $phone,
        $celular,
        $camisa,
        $calca,
        $terno,
        $calcado,
        $peso,
        $altura,
        $status,
        $funcao,
        $idiomas,
        $escolaridade,
        $disponibilidade,
        $observacoes,
        $complemento,
        $created_at
    ) {
        $this->dadosCadastrar(
            $arquivo,
            $nome_arquivo,
            $diretorio,
            $name,
            $nascimento,
            $idade,
            $sexo,
            $rg,
            $cpf,
            $tatuagem,
            $email,
            $cb,
            $phone,
            $celular,
            $camisa,
            $calca,
            $terno,
            $calcado,
            $peso,
            $altura,
            $status,
            $funcao,
            $idiomas,
            $escolaridade,
            $disponibilidade,
            $observacoes,
            $complemento,
            $created_at
        );
        try {
            $stmt = $this->conectar->prepare(
                'INSERT INTO funcionarios (arquivo, nome_arquivo, diretorio, name, nascimento, idade, sexo, rg, cpf, tatuagem, email, cb, phone, celular, camisa, calca, terno, calcado, peso, altura, status,
                funcao, idiomas, escolaridade, disponibilidade,  observacoes,  complemento, created_at) 
                VALUES (:ARQUIVO, :NOME_ARQUIVO, :DIRETORIO, :NOME, :NASCIMENTO, :IDADE, :SEXO, :RG, :CPF, :TATUAGEM, :EMAIL, :CB, :PHONE, :CELULAR, :CAMISA, :CALCA, :TERNO, :CALCADO, :PESO, :ALTURA, :STATUS, :FUNCAO, :IDIOMAS,
                :ESCOLARIDADE, :DISPONIBILIDADE, :OBSERVACOES, :COMPLEMENTO, :CRIADO_POR)'
            );
            $stmt->execute(
                array(
                    ":ARQUIVO" => $this->getarquivo(),
                    ":NOME_ARQUIVO" => $this->getnome_arquivo(),
                    ":DIRETORIO" => $this->getdiretorio(),
                    ":NOME" => $this->getname(),
                    ":NASCIMENTO" => $this->getnascimento(),
                    ":IDADE" => $this->getidade(),
                    ":SEXO" => $this->getsexo(),
                    ":RG" => $this->getrg(),
                    ":CPF" => $this->getcpf(),
                    ":TATUAGEM" => $this->gettatuagem(),
                    ":EMAIL" => $this->getemail(),
                    ":CB" => $this->getcb(),
                    ":PHONE" => $this->getphone(),
                    ":CELULAR" => $this->getcelular(),
                    ":CAMISA" => $this->getcamisa(),
                    ":CALCA" => $this->getcalca(),
                    ":TERNO" => $this->getterno(),
                    ":CALCADO" => $this->getcalcado(),
                    ":PESO" => $this->getpeso(),
                    ":ALTURA" => $this->getaltura(),
                    ":STATUS" => $this->getstatus(),
                    ":FUNCAO" => $this->getfuncao(),
                    ":IDIOMAS" => $this->getidiomas(),
                    ":ESCOLARIDADE" => $this->getescolaridade(),
                    ":DISPONIBILIDADE" => $this->getdisponibilidade(),
                    ":OBSERVACOES" => $this->getobservacoes(),
                    ":COMPLEMENTO" => $this->getcomplemento(),
                    ":CRIADO_POR" => $this->getcreated_at()
                )
            );
            $stmt->rowCount();
            return 1;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function dadosCadastrar(
        $arquivo,
        $nome_arquivo,
        $diretorio,
        $name,
        $nascimento,
        $idade,
        $sexo,
        $rg,
        $cpf,
        $tatuagem,
        $email,
        $cb,
        $phone,
        $celular,
        $camisa,
        $calca,
        $terno,
        $calcado,
        $peso,
        $altura,
        $status,
        $funcao,
        $idiomas,
        $escolaridade,
        $disponibilidade,
        $observacoes,
        $complemento,
        $created_at
    ) {
        $this->setarquivo($arquivo);
        $this->setnome_arquivo($nome_arquivo);
        $this->setdiretorio($diretorio);
        $this->setname($name);
        $this->setnascimento($nascimento);
        $this->setidade($idade);
        $this->setsexo($sexo);
        $this->setrg($rg);
        $this->setcpf($cpf);
        $this->settatuagem($tatuagem);
        $this->setemail($email);
        $this->setcb($cb);
        $this->setphone($phone);
        $this->setcelular($celular);
        $this->setcamisa($camisa);
        $this->setcalca($calca);
        $this->setterno($terno);
        $this->setcalcado($calcado);
        $this->setpeso($peso);
        $this->setaltura($altura);
        $this->setstatus($status);
        $this->setfuncao($funcao);
        $this->setidiomas($idiomas);
        $this->setescolaridade($escolaridade);
        $this->setdisponibilidade($disponibilidade);
        $this->setobservacoes($observacoes);
        $this->setcomplemento($complemento);
        $this->setcreated_at($created_at);
    }

    public function dadosEditar(
        $arquivo,
        $nome_arquivo,
        $diretorio,
        $name,
        $nascimento,
        $idade,
        $sexo,
        $rg,
        $cpf,
        $tatuagem,
        $email,
        $cb,
        $phone,
        $celular,
        $camisa,
        $calca,
        $terno,
        $calcado,
        $peso,
        $altura,
        $status,
        $funcao,
        $idiomas,
        $escolaridade,
        $disponibilidade,
        $observacoes,
        $complemento,
        $update_at
    ) {
        $this->setarquivo($arquivo);
        $this->setnome_arquivo($nome_arquivo);
        $this->setdiretorio($diretorio);
        $this->setname($name);
        $this->setnascimento($nascimento);
        $this->setidade($idade);
        $this->setsexo($sexo);
        $this->setrg($rg);
        $this->setcpf($cpf);
        $this->settatuagem($tatuagem);
        $this->setemail($email);
        $this->setcb($cb);
        $this->setphone($phone);
        $this->setcelular($celular);
        $this->setcamisa($camisa);
        $this->setcalca($calca);
        $this->setterno($terno);
        $this->setcalcado($calcado);
        $this->setpeso($peso);
        $this->setaltura($altura);
        $this->setstatus($status);
        $this->setfuncao($funcao);
        $this->setidiomas($idiomas);
        $this->setescolaridade($escolaridade);
        $this->setdisponibilidade($disponibilidade);
        $this->setobservacoes($observacoes);
        $this->setcomplemento($complemento);
        $this->setupdate_at($update_at);
    }
    public function editarCliente(
        $id,
        $arquivo,
        $nome_arquivo,
        $diretorio,
        $name,
        $nascimento,
        $idade,
        $sexo,
        $rg,
        $cpf,
        $tatuagem,
        $email,
        $cb,
        $phone,
        $celular,
        $camisa,
        $calca,
        $terno,
        $calcado,
        $peso,
        $altura,
        $status,
        $funcao,
        $idiomas,
        $escolaridade,
        $disponibilidade,
        $observacoes,
        $complemento,
        $update_at
    ) {
        $this->setid($id);
        $this->dadosEditar(
            $arquivo,
            $nome_arquivo,
            $diretorio,
            $name,
            $nascimento,
            $idade,
            $sexo,
            $rg,
            $cpf,
            $tatuagem,
            $email,
            $cb,
            $phone,
            $celular,
            $camisa,
            $calca,
            $terno,
            $calcado,
            $peso,
            $altura,
            $status,
            $funcao,
            $idiomas,
            $escolaridade,
            $disponibilidade,
            $observacoes,
            $complemento,
            $update_at
        );
        try {
            $stmt = $this->conectar->prepare(
                'UPDATE funcionarios SET arquivo=:ARQUIVO, nome_arquivo=:NOME_ARQUIVO, diretorio=:DIRETORIO, name=:NOME, 
                nascimento=:NASCIMENTO, idade=:IDADE, sexo=:SEXO,
                 rg=:RG, cpf=:CPF, tatuagem=:TATUAGEM, email=:EMAIL, cb=:CB, phone=:PHONE, celular=:CELULAR, camisa=:CAMISA, 
                 calca=:CALCA, terno=:TERNO, calcado=:CALCADO, peso=:PESO, 
                 altura=:ALTURA, status=:STATUS, funcao=:FUNCAO, idiomas=:IDIOMAS,
                escolaridade=:ESCOLARIDADE, disponibilidade=:DISPONIBILIDADE, observacoes=:OBSERVACOES, complemento=:COMPLEMENTO, 
                update_at=:ALTERADO_POR WHERE id=:ID'
            );
            $stmt->execute(array(
                ":ID" => $this->id,
                ":ARQUIVO" => $this->getarquivo(),
                ":NOME_ARQUIVO" => $this->getnome_arquivo(),
                ":DIRETORIO" => $this->getdiretorio(),
                ":NOME" => $this->getname(),
                ":NASCIMENTO" => $this->getnascimento(),
                ":IDADE" => $this->getidade(),
                ":SEXO" => $this->getsexo(),
                ":RG" => $this->getrg(),
                ":CPF" => $this->getcpf(),
                ":TATUAGEM" => $this->gettatuagem(),
                ":EMAIL" => $this->getemail(),
                ":CB" => $this->getcb(),
                ":PHONE" => $this->getphone(),
                ":CELULAR" => $this->getcelular(),
                ":CAMISA" => $this->getcamisa(),
                ":CALCA" => $this->getcalca(),
                ":TERNO" => $this->getterno(),
                ":CALCADO" => $this->getcalcado(),
                ":PESO" => $this->getpeso(),
                ":ALTURA" => $this->getaltura(),
                ":STATUS" => $this->getstatus(),
                ":FUNCAO" => $this->getfuncao(),
                ":IDIOMAS" => $this->getidiomas(),
                ":ESCOLARIDADE" => $this->getescolaridade(),
                ":DISPONIBILIDADE" => $this->getdisponibilidade(),
                ":OBSERVACOES" => $this->getobservacoes(),
                ":COMPLEMENTO" => $this->getcomplemento(),
                ":ALTERADO_POR" => $this->getupdate_at()
            ));
            return 1;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function excluirCliente($id)
    {
        $this->setid($id);
        try {
            $stmt = $this->conectar->prepare('DELETE FROM funcionarios where id = :ID');
            $stmt->execute(array(":ID" => $this->id));
            $retorno = $stmt->rowCount();
            return $retorno;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function listarTodosClientes()
    {
        $stmt = $this->conectar->prepare('SELECT * FROM funcionarios ORDER BY name ASC');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($results);
    }
    public function carregarCliente($id)
    {
        $this->setid($id);
        $stmt = $this->conectar->prepare('SELECT * FROM funcionarios where id = :ID ORDER BY name ASC');
        $stmt->execute(array(":ID" => $this->id));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($results);
    }

    private function setId($id)
    {
        $this->id = $id;
    }
    private function setarquivo($arquivo)
    {
        $this->arquivo = $arquivo;
    }
    private function setnome_arquivo($nome_arquivo)
    {
        $this->nome_arquivo = $nome_arquivo;
    }
    private function setdiretorio($diretorio)
    {
        $this->diretorio = $diretorio;
    }
    private function setname($name)
    {
        $this->name = $name;
    }
    private function setnascimento($nascimento)
    {
        $this->nascimento = $nascimento;
    }
    private function setidade($idade)
    {
        $this->idade = $idade;
    }
    private function setsexo($sexo)
    {
        $this->sexo = $sexo;
    }
    private function setrg($rg)
    {
        $this->rg = $rg;
    }
    private function setcpf($cpf)
    {
        $this->cpf = $cpf;
    }
    private function settatuagem($tatuagem)
    {
        $this->tatuagem = $tatuagem;
    }
    private function setemail($email)
    {
        $this->email = $email;
    }
    private function setcb($cb)
    {
        $this->cb = $cb;
    }
    private function setphone($phone)
    {
        $this->phone = $phone;
    }
    private function setcelular($celular)
    {
        $this->celular = $celular;
    }
    private function setcamisa($camisa)
    {
        $this->camisa = $camisa;
    }
    private function setcalca($calca)
    {
        $this->calca = $calca;
    }
    private function setterno($terno)
    {
        $this->terno = $terno;
    }
    private function setcalcado($calcado)
    {
        $this->calcado = $calcado;
    }
    private function setpeso($peso)
    {
        $this->peso = $peso;
    }
    private function setaltura($altura)
    {
        $this->altura = $altura;
    }
    private function setstatus($status)
    {
        $this->status = $status;
    }
    private function setfuncao($funcao)
    {
        $this->funcao = $funcao;
    }
    private function setidiomas($idiomas)
    {
        $this->idiomas = $idiomas;
    }
    private function setescolaridade($escolaridade)
    {
        $this->escolaridade = $escolaridade;
    }
    private function setdisponibilidade($disponibilidade)
    {
        $this->disponibilidade = $disponibilidade;
    }
    private function setobservacoes($observacoes)
    {
        $this->observacoes = $observacoes;
    }
    private function setcomplemento($complemento)
    {
        $this->complemento = $complemento;
    }
    private function setcreated_at($created_at)
    {
        $this->created_at = $created_at;
    }
    private function setupdate_at($update_at)
    {
        $this->update_at = $update_at;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getarquivo()
    {
        return $this->arquivo;
    }
    public function getnome_arquivo()
    {
        return $this->nome_arquivo;
    }
    public function getdiretorio()
    {
        return $this->diretorio;
    }
    public function getname()
    {
        return $this->name;
    }
    public function getnascimento()
    {
        return $this->nascimento;
    }
    public function getidade()
    {
        return $this->idade;
    }
    public function getsexo()
    {
        return $this->sexo;
    }
    public function getrg()
    {
        return $this->rg;
    }
    public function getcpf()
    {
        return $this->cpf;
    }
    public function gettatuagem()
    {
        return $this->tatuagem;
    }
    public function getemail()
    {
        return $this->email;
    }
    public function getcb()
    {
        return $this->cb;
    }
    public function getphone()
    {
        return $this->phone;
    }
    public function getcelular()
    {
        return $this->celular;
    }
    public function getcamisa()
    {
        return $this->camisa;
    }
    public function getcalca()
    {
        return $this->calca;
    }
    public function getterno()
    {
        return $this->terno;
    }
    public function getcalcado()
    {
        return $this->calcado;
    }
    public function getpeso()
    {
        return $this->peso;
    }
    public function getaltura()
    {
        return $this->altura;
    }
    public function getstatus()
    {
        return $this->status;
    }
    public function getfuncao()
    {
        return $this->funcao;
    }
    public function getidiomas()
    {
        return $this->idiomas;
    }
    public function getescolaridade()
    {
        return $this->escolaridade;
    }
    public function getdisponibilidade()
    {
        return $this->disponibilidade;
    }
    public function getobservacoes()
    {
        return $this->observacoes;
    }
    public function getcomplemento()
    {
        return $this->complemento;
    }
    public function getcreated_at()
    {
        return $this->created_at;
    }
    public function getupdate_at()
    {
        return $this->update_at;
    }
}
