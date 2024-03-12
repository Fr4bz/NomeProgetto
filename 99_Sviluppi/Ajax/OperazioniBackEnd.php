


<?php
if (file_exists(__DIR__.'/../../../ClassiStandard/ClassiStandard.php')) {
    require_once(__DIR__.'/../../../ClassiStandard/ClassiStandard.php');
}
if (file_exists(__DIR__.'/../../../ConfigSQL.php')) {
    require_once(__DIR__.'/../../../ConfigSQL.php');
}
if (file_exists(__DIR__.'/../../../ClassiStandard/ElabOperCampi.php')) {
    require_once(__DIR__.'/../../../ClassiStandard/ElabOperCampi.php');
}
if (file_exists(__DIR__.'/ClassiStandardProgetto/ElabOperCampi.php')) {
    require_once(__DIR__.'/ClassiStandardProgetto/ElabOperCampi.php');
}

if (file_exists(__DIR__.'/../../VariabiliGenerali.php')) {
    include(__DIR__.'/../../VariabiliGenerali.php');

}
//parte inserimento dati iniziali
error_reporting(E_ALL);
ini_set('display_errors', '1');

set_error_handler(
    function ($errno, $errstr, $errfile, $errline) {
        throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
    }
);

$_ENV['APP_ENV'] = 'development';

$ColonnaDiRiferimentoPerSottocategorie="CO5L_ALF11";
if(isset($_POST["action"])){
    if (str_pos($_POST['action'],"Ottieni")===0) {
        if ($_POST['action'] == "OttieniEsempioChiamata") {
            EsempioChiamata();
        }else if($_POST['action'] == "OttieniEsempioChiamata"){
            //blablabla
        }
    }else if(str_pos($_POST['action'],"Registra")===0){

    }else{

    }
    
}else{
    //Azione di default nel caso in cui si voglia usare un programma automatico
}



    
   

    function EsempioChiamata($ParamDitta = -1, $ParamModalita = -1, $ParamCodAttributo = "")
    {
        global $conn;
        // global $conn_Gamma;
        global $Ditta;

        $Errore = "";
        $Dati = array();
        if ($ParamModalita == -1) {
            $Modalita = $_POST['Modalita'] ?? 0;
            $CodiceAttributo = $_POST['CodiceAttributo'] ?? "";
        } else {
            $Modalita = $ParamModalita;
            $CodiceAttributo = $ParamCodAttributo;
        }
        $Contatore = 0;
        try {
            $ArrayParamPassati = array();
            $sql = "SELECT CO5B_IDATTRIBUTO AS ID, CO5B_CODICE as CODICE,CO5B_DESCR AS DESCRIZIONE,CO5B_CAMPOTABELLA AS NOMECOLONNA from CO5B_ANAGATTRIBUTI
                WHERE CO5B_IDTIPO_CO5A=5";
            $WhereEsiste = strpos(strtolower($sql), ' where ') === false ? false : true;


            if ($CodiceAttributo != "") {
                if ($WhereEsiste == false) {
                    $WhereEsiste = true;
                    $Clausola = "\n where ";
                } else {
                    $Clausola = " AND ";
                }
                $sql = $sql . ElaboraOperatoreFiltro($Clausola, "CO5B_CODICE.Id_Gestione", 0, ':CodiceAttributo');
                $Parametro = new Parametro(':CodiceAttributo', $CodiceAttributo, PDO::PARAM_STR);
                array_push($ArrayParamPassati, $Parametro);
            }

            $select = $conn->prepare($sql);
            foreach ($ArrayParamPassati as $key => $Param) {
                $select->bindParam($Param->Nome, $Param->Valore, $Param->Tipo);
            }


            $select->execute();

            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) > 0) {
                foreach ($result as $Key => $row) {
                    $Dati[$Key] = $row;
                }
            } else {

            }
        } catch (PDOException $e) {
            $Errore .= "Errore SQL: " . $e->getMessage() . " <br>riga:" . $e->getLine();
        } catch (Exception $e) {
            $Errore .= "Errore php: " . $e->getMessage() . " <br>riga:" . $e->getLine();
        }

        $Valore_Ritorno = array("Errore" => $Errore, "Dati" => $Dati);
        if ($Modalita == 0) {
            return $Valore_Ritorno;
        } else {

            echo json_encode($Valore_Ritorno);
        }
    }











?>