<?php

namespace Itworks\src\model;

use Itworks\core\Model;

/**
 * Classe responsável por gerenciar a conexão com a tabelaconta.
 */

class CurriculoModel
{
    //Instancia da Classe Model
    private $pdo;

    /**
     * Método Contrutor
     * @return void
     */

    public function __construct()
    {
        $this->pdo = new Model();
    }

    public function insertForm(object $params)
    {
        $sql = "INSERT INTO curriculo (nome) VALUES (:nome)";

        $sqlParams = [
            ':nome' => $params->nome
        ];

        $handle = $this->pdo->executeNonQuery($sql, $sqlParams);
        if (!$handle) {
            return -1;
        } else {
            return $this->pdo->GetLastID();
        }
    }

    public function insertUpload(object $params)
    {
        $sql = "INSERT INTO arquivo (`filename`, `curriculo_id`) VALUES (:filename, :curriculo_id)";

        $sqlParams = [
            ':filename'         => $params->filename,
            ':curriculo_id'     => $params->curriculo_id
        ];

        $handle = $this->pdo->executeNonQuery($sql, $sqlParams);
        if (!$handle) {
            return -1;
        } else {
            return $this->pdo->GetLastID();
        }
    }
}
