<?php

error_reporting(E_ALL);

class AccessData
{
    private $oConection = null;

    function connect()
    {
        $bRet = false;
        try {
            $this->oConection = new PDO("mysql:host=localhost;dbname=agendausers", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
            $bRet = true;
        } catch (Exception $e) {
            throw $e;
        }
        return $bRet;
    }


    function disconnect()
    {
        $bRet = true;
        if($this->oConection != null){
            $this->oConection = null;
        }
        return $bRet;
    }

    function runQuery($psConsult){
        $arrRS = null;
        $rst = null;
        $oLinea = null;
        $sValCol = "";
        $i = 0;
        $j = 0;
        if ($psConsult == "") {
			throw new Exception("AccesoDatos->ejecutarConsulta: falta indicar la consulta");
		}
		if ($this->oConection == null) {
			throw new Exception("AccesoDatos->ejecutarConsulta: falta conectar la base");
		}
		try {
			$rst = $this->oConection->query($psConsult); //un objeto PDOStatement o falso en caso de error
		} catch (Exception $e) {
			throw $e;
		}
		if ($rst) {
			foreach ($rst as $oLinea) {
				foreach ($oLinea as $llave => $sValCol) {
					if (is_string($llave)) {
						$arrRS[$i][$j] = $sValCol;
						$j++;
					}
				}
				$j = 0;
				$i++;
			}
		}
		return $arrRS;
    }

    function runCommand($psCommand){
        $nAfectados = -1;
        if ($psCommand == "") {
            throw new Exception("AccesoDatos->ejecutarComando: falta indicar el comando");
		}
		if ($this->oConection == null) {
			throw new Exception("AccesoDatos->ejecutarComando: falta conectar la base");
		}
        try {
            $nAfectados = $this->oConection->exec($psCommand);
        } catch (Exception $e) {
            throw $e;
        }
        return $nAfectados;
    }
}

?>