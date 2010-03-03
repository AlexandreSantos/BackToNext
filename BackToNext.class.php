<?php
 /**
  * Classe para a criação de paginação restringida a um determinado grupo
  * retornado pelo banco de dados
  *
  * @package AWU
  * @copyright Copyright (c) Alexandre Santos
  * @license http://www.opensource.org/licenses/gpl-3.0.html GNU Public License 3.0
  * @version 1.0
  * @author Alexandre Santos <alexandre@diariodecodigos.info>
  *
  */
class Paginacao {
    private $sql = "";
    private $fieldNameIndex = "";

    /**
     * Retorna a Query SQL atribuída a instância da classe
     * @return <string>
     */
    public function getSql() {
        return $this->sql;
    }

    /**
     * Atribui a instância a Query SQL utilizada para limitar a paginação
     * @param <type> $sql
     */
    public function setSql($sql) {
        $this->sql = $sql;
    }

    /**
     * Retorna o nome do campo utilizado para navegar
     * @return <string>
     */
    public function getFieldNameIndex() {
        return $this->fieldNameIndex;
    }

    /**
     * Informa a classe o nome do campo (banco de dados)
     * da qual a classe vai usar para navegar
     * @param <string> $fieldNameIndex
     */
    public function setFieldNameIndex($fieldNameIndex) {
        $this->fieldNameIndex = $fieldNameIndex;
    }



}
?>
