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
class BackToNext {
    private $sql = "";
    private $fieldNameIndex = "";
    private $fileXmlConfig = "";
    private $currentIndex = "";

    private $dns = "";
    private $user = "";
    private $passwd = "";
    private $arrayResult = "";

    /**
     * Retorna a Query SQL atribuída a instância da classe
     * @return string
     */
    public function getSql() {
        return $this->sql;
    }

    /**
     * Atribui a instância a Query SQL utilizada para limitar a paginação
     * @param string $sql
     */
    public function setSql($sql) {
        $this->sql = $sql;

        try{
            $dbh = null;
            $dbh = new PDO($this->dns, $this->user, $this->passwd,  array(PDO::ATTR_PERSISTENT => true));
            //$stmt = $dbh->query($this->sql);
            $stmt = $dbh->prepare($this->sql);
            $stmt->execute();

            $this->arrayResult = null;
            $this->arrayResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "<span style='color: red'>Ops... deu erro, chame o Alexandre e mostre-o:</span> " . $e->getMessage();
        }
    }

    /**
     * Retorna o nome do campo utilizado para navegar
     * @return string
     */
    public function getFieldNameIndex() {
        return $this->fieldNameIndex;
    }

    /**
     * Informa a classe o nome do campo (banco de dados)
     * da qual a classe vai usar para navegar
     * @param string $fieldNameIndex
     */
    public function setFieldNameIndex($fieldNameIndex) {
        $this->fieldNameIndex = $fieldNameIndex;
    }

    /**
     * Retorna o nome do arquivo de configuração (xml)
     * @return string
     */
    public function getFileXmlConfig() {
        return $this->fileXmlConfig;
    }

    /**
     * Informa a classe o nome do arquivo de configuração
     * essencial para obter os dados de conexão ao DB
     * @param string $fileXmlConfig
     */
    public function setFileXmlConfig($fileXmlConfig) {
        $this->fileXmlConfig = $fileXmlConfig;

        // obtem os dados para conexão
        $xml = simplexml_load_file($this->fileXmlConfig);
        $this->dns = $xml->database[0]->dns;
        $this->user = $xml->database[0]->user;
        $this->passwd = $xml->database[0]->passwd;
    }

    public function getCurrentIndex() {
        return $this->currentIndex;
    }

    public function setCurrentIndex($currentIndex) {
        $this->currentIndex = $currentIndex;
    }

    /**
     * Retorna o link de avançar
     * @return string
     */
    public function getNextLink(){
         $qtdRecords = count($this->arrayResult);

        // Percorre todo o array
        for($i=0; $i<$qtdRecords; $i++)
        {
            if($this->arrayResult[$i][$this->fieldNameIndex] == $this->currentIndex)
            {
                $inext = $i + 1;

                if(array_key_exists($inext, $this->arrayResult))
                {
                    return $this->arrayResult[$inext][$this->fieldNameIndex];
                }
                else
                {
                    return "#";
                }
            } // FIM > if($resultStmt[$i][$this->fieldNameIndex] == $this->currentIndex)
        } // FIM > for($i=0; $i<$qtdRecords; $i++)
    } // FIM > método getNextLink()

    /**
     * Retorna o link de voltar
     * @return string
     */
    public function getBackLink()
    {
         $qtdRecords = count($this->arrayResult);

        // Percorre todo o array
        for($i=0; $i<$qtdRecords; $i++)
        {
            if($this->arrayResult[$i][$this->fieldNameIndex] == $this->currentIndex)
            {
                $iback = $i - 1;

                if(array_key_exists($iback, $this->arrayResult))
                {
                    return $this->arrayResult[$iback][$this->fieldNameIndex];
                }
                else
                {
                    return "#";
                }
            } // FIM > if($resultStmt[$i][$this->fieldNameIndex] == $this->currentIndex)    
        } // FIM > for($i=0; $i<$qtdRecords; $i++)
    } // FIM > getBackLink()

} // Fim da classe!
?>
