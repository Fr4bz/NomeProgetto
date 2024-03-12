<?php

if(isset($_POST['action'])){
    if(trim($_POST['action'])==""){
        throw new Exception("Parametro action non valido");
    }
    else if(strpos(trim($_POST['action']),'Estrai')==0){
        if(trim($_POST['action'])=="EstraiFile"){
            EstraiFile();
        }
        else if(trim($_POST['action'])=="EstraiRigheFile"){
            EstraiRigheFile();
        }
    }
    else if(strpos(trim($_POST['action']),'Save')==0){
        if(trim($_POST['action'])=="SaveFile"){
            SaveFile();
        }
        
    }
    else if(strpos(trim($_POST['action']),'Codifica')==0){
        if(trim($_POST['action'])=="CodificaValore"){
            CodificaValore();
        }
        
    }
}

function SaveFile($ParamModalita=-1,$ParamFile=array(),$ParamNomeFile="",$ParamPath=""){



    if ($ParamModalita == -1) {
        $Modalita = isset($_POST['Modalita']) ?$_POST['Modalita']: 0;
    } else {
        $Modalita = $ParamModalita;
    }
    if (count($ParamFile)==0) {
        $File= !empty($_FILES) ? $_FILES: array();
    } else {
        $File = $ParamFile;
    }
    if ($ParamNomeFile == "") {
        $NomeFile = isset($_POST['NomeFile']) ? json_decode($_POST['NomeFile']):array();
    } else {
        $NomeFile = $ParamNomeFile;
    }
    if ($ParamPath == "") {
        $Path = isset($_POST['Path']) ? json_decode($_POST['Path']):"../FileTest/";
    } else {
        $Path = $ParamPath;
    }


    $Errore = "";
    $inputFileName='';
    $Indice=0;
    
    
    
    try{
        
        if (!is_dir($Path)) {
            // La cartella non esiste, quindi la creiamo
            if (mkdir($Path)) {
                
            } else {
                throw new Exception("Impossibile creare la cartella.". $Path);
            }
        }
        
        
            foreach ($File as $file) {
                
                if(is_uploaded_file($file['tmp_name'])){
                    $inputFileName = $file['tmp_name'];
                    // echo $NomeFile[$indice]." ".strval($indice);
                    // echo "Indice: " . $Indice . "<br>";
                    move_uploaded_file($inputFileName, $Path. $NomeFile[$Indice]);
                    chmod($Path. $NomeFile[$Indice], 0777);
                }else{
                    switch($file['error'])
                    {
                        case 0: //Possibile attacco di file
                            $ErrImport = "Possibile attacco file";
                            break;
                        case 1: //File troppo grande php.ini
                            $ErrImport = "File troppo grande";
                            break;
                        case 2: //File troppo grande MAX_FILE_SIZE
                            $ErrImport = "File troppo grande: MAX_FILE_SIZE";
                            break;
                        case 3: //File caricato parzialmente
                            $ErrImport = "File caricato parzialmente";
                            break;
                        case 4: //File non caricato
                            $ErrImport = "File non caricato";
                            break;
                        default: //Errore di default
                            $ErrImport = "Errore generico";
                            break;
                    }
        
                    throw new Exception($ErrImport);
                }
                $Indice++;
            }
        
    }catch(Exception $e){
        $Errore.= $e->getMessage();
    }

    $Valore_Ritorno = array("Errore" => $Errore);
    if ($Modalita == 0) {
        return $Valore_Ritorno;
    } else {
        echo json_encode($Valore_Ritorno);
    }
}
function EstraiFile($ParamTracciato="",$ParamDitta=-1,$ParamOperazione=0,$ParamFolder="",$ParamEstensione="",$ParamModalita=-1){

        global $conn;
        if($ParamModalita==-1){
            $Modalita=isset($_POST['Modalita'])?$_POST['Modalita']:-1;
            if(isset($_POST['Ditta'])){
                $Ditta=$_POST['Ditta'];
            }else{
                global $Ditta;
            }
            $Operazione=isset($_POST['Operazione'])?$_POST['Operazione']:-1;
            $Folder=isset($_POST['Folder'])?$_POST['Folder']:"";
            $Tracciato=isset($_POST['Tracciato'])?$_POST['Tracciato']:"";
        }else{
            $Modalita=$ParamModalita;
            $Ditta=$ParamDitta;
            $Operazione=$ParamOperazione;
            $Folder=$ParamFolder;
            $Estensione=$ParamEstensione;
            $Tracciato=$ParamTracciato;
        }
        

        $Errore = '';
        $ElencoFile = [];
        $Path = '';
        $Estensione = '';
        $filedaLeggere = '';
        if($Tracciato=="" && $Folder==""){
        }else{
            if(empty($Path) || $Path==NULL || trim($Path)==""){
                throw new Exception('Path fornito non valido, path:'.$Path);
            }
            $Path=$Folder;
        }

        $filedaLeggere = scandir($Path);
        if($filedaLeggere!==false){
            foreach ($filedaLeggere as $chiaveFile=>$file) {
                if(is_dir($file)){
                    continue;
                }
                if(!empty($Estensione) && $Estensione!=NULL && $Estensione!=""){
                    if(!preg_match('/\.' . $Estensione . '$/i',$file)){
                        continue;
                    }
                }
                $file_handle = fopen($Path .$file, "r");
                array_push($ElencoFile,$Path . basename($file));
                fclose($file_handle);
            }
        }else{
            throw new Exception('Nessun file trovato');
        }
 
    
    if($Modalita!=1){
        return $ElencoFile;
    }else{
        echo json_encode($ElencoFile);
    }
}
function EstraiRigheFile($NomeFile=""){
    mb_internal_encoding('UTF-8');
    $x = 0;
    $RigheFile = [];
    
    $myfile = fopen($NomeFile, "r");
    if (!$myfile) {
        throw new Exception("Unable to open file!");
    }
    while(!feof($myfile)) {
        $RigheFile[$x] = mb_convert_encoding(fgets($myfile), 'UTF-8', 'ISO8859-15');
        $x += 1;
    }
    fclose($myfile);

    return $RigheFile;
}

function CodificaValore($ParamModalita,$Ditta,$Valore,$TipoTrascodifica,$Trascodifica,$Attributo=""){
    global $conn;
    // global $Ditta;
    if ($ParamModalita == -1) {
        $Modalita = isset($_POST['Modalita']) ?$_POST['Modalita']: 1;
    } else {
        $Modalita = $ParamModalita;
    }
    $ValoreModificato="";


    if(trim($TipoTrascodifica)=="1"){
        $ValoreModificato=$Trascodifica!=null?trim($Trascodifica):"";
    }elseif(trim($TipoTrascodifica)=="2"){
            $Valore=$Valore!=null?trim($Valore):"";
            if(is_numeric($Valore)){
                $LunghezzaValore=strlen(trim(strval($Valore)));
                $Valore=floatval($Valore);
                $Valore=str_pad($Valore, $LunghezzaValore, 0, STR_PAD_LEFT);
            }else{
                $Valore=trim($Valore);
            }
            $Attributo=$Attributo!=null?trim($Attributo):"";
            $ControlliEseguiti=0;
            try{
                // CheckQueryValida($Trascodifica);
                $ControlliEseguiti=1;
            }catch(Exception $e){
                $Errore="Query inserita per la codifica non valida<br>".
                "Errore fornito:<br>".
                $e->getMessage().
                "<br>Query:<br>".$Trascodifica;
                throw new Exception($Errore);
            }
            if($ControlliEseguiti==1){

            
                $ArrayParamPassati = array();
        
                    $sql = trim($Trascodifica);
                    $Parametri = array();
                    // Definisci il pattern delle sottostringhe nella forma ":Qualcosa" fino allo spazio successivo
                    $pattern = '/:([^ ]+)/';
                    
                    // Cerca tutte le occorrenze del pattern nella stringa e memorizzale in $matches
                    preg_match_all($pattern, $sql, $Parametri);
                    
                    //Conto quante occorrenze di Ditta ci sono
                    $pattern = '/:Ditta\b/i';
                    $conteggioDitta=0;
                    foreach ($Parametri[0] as $item) {
                        if (strcasecmp($item, ':DITTA') === 0) {
                            $conteggioDitta++;
                        }
                    }
                    $conteggioDitta = count(array_filter($Parametri[0], function ($item) use ($pattern) {
                        return preg_match($pattern, $item);
                    }));
                    
                    $ParametriSenzaDitta = array_filter($Parametri[0], function ($item) use ($pattern) {
                        return !preg_match($pattern, $item);
                    });
                    //Passo nell'array di argomenti della query tutti i Ditta che servono
                    for ($i=1; $i <=$conteggioDitta; $i++) {
                        array_push($ArrayParamPassati, new Parametro(':Ditta'.$i, $Ditta, PDO::PARAM_INT));
                    }
                    
                    //Cambio i vari :Ditta :ditta ecc.. (case insensitive) in :Ditta1 :Ditta2 ecc...
                    $conteggio = 1;
                    $sql = preg_replace_callback($pattern, function ($match) use (&$conteggio) {
                        return ':Ditta' . $conteggio++;
                    }, $sql);
                    
                    $conteggio = 1;
                    $pattern = '/:Valore\b/i';
                    $sql = preg_replace_callback($pattern, function ($match) use (&$conteggio) {
                        return ':Valore' . $conteggio++;
                    }, $sql);
                    $conteggioValore = count(array_filter($ParametriSenzaDitta, function ($item) use ($pattern) {
                        return preg_match($pattern, $item);
                    }));
                    
                    for ($i=1; $i <=$conteggioValore; $i++) {
                        array_push($ArrayParamPassati, new Parametro(':Valore'.$i, $Valore, PDO::PARAM_STR));
                    }
                    $conteggio = 1;
                    $pattern = '/:Attributo\b/i';
                    $sql = preg_replace_callback($pattern, function ($match) use (&$conteggio) {
                        return ':Attributo' . $conteggio++;
                    }, $sql);
                    $conteggioAttributo = count(array_filter($ParametriSenzaDitta, function ($item) use ($pattern) {
                        return preg_match($pattern, $item);
                    }));
                    
                    for ($i=1; $i <=$conteggioAttributo; $i++) {
                        array_push($ArrayParamPassati, new Parametro(':Attributo'.$i, $Attributo, PDO::PARAM_STR));
                    }
                    
                    // array_push($ArrayParamPassati, new Parametro(':Tracciato', $Tracciato, PDO::PARAM_STR));
                    // array_push($ArrayParamPassati, new Parametro(':TipoRiga', $TipoRiga, PDO::PARAM_STR));
                    
                    
                    $select = $conn->prepare($sql);
                    foreach ($ArrayParamPassati as $key => $Param) {
                        $select->bindParam($Param->Nome, $Param->Valore, $Param->Tipo);
                    }


                $select->execute();
                $result = $select->fetchAll();
                if(count($result)>1)
                throw new Exception("Sono state trovate più righe corrispondenti al filtri inserito");

                foreach ($result as $key => $row) {
                    $ValoriRiga=array_values($row);
                    $ValoreModificato=$ValoriRiga[0];
                }
            }
            
    }else{
        throw new Exception("tipo trascodifica non corretta");
    }


    if ($Modalita == 0) {
        return $ValoreModificato;
    } else {

        echo json_encode($ValoreModificato);
        
    }
}

?>