<?php

class Contactos
{
    protected $iid = 0;
    protected $sNombre = "";
    protected $sApep = "";
    protected $sApem = "";
    protected $sDireccion = "";
    protected $sTelefono = "";
    protected $sEmail = "";
    protected $CveUser = 0;



    function getId()
    {
        return $this->iid;
    }
    function setId($piId)
    {
        $this->iid = $piId;
    }
    function getNombre()
    {
        return $this->sNombre;
    }
    function setNombre($psNombre)
    {
        $this->sNombre = $psNombre;
    }

    function getApep()
    {
        return $this->sApep;
    }
    function setApep($psApep)
    {
        $this->sApep = $psApep;
    }

    function getApem()
    {
        return $this->sApem;
    }
    function setApem($psApem)
    {
        $this->sApem = $psApem;
    }

    function getDireccion()
    {
        return $this->sDireccion;
    }
    function setDireccion($psDireccion)
    {
        $this->sDireccion = $psDireccion;
    }

    function getTelefono()
    {
        return $this->sTelefono;
    }
    function setTelefono($psTelefono)
    {
        $this->sTelefono = $psTelefono;
    }

    function getEmail()
    {
        return $this->sEmail;
    }
    function setEmail($psEmail)
    {
        $this->sEmail = $psEmail;
    }

    function getCveUser()
    {
        return $this->CveUser;
    }
    function setCveUser($pCveUser)
    {
        $this->CveUser = $pCveUser;
    }

    function getNombreC()
    {
        return $this->sNombre . " " . $this->sApep . " " . $this->sApem;
    }

    function searchAll($pitype, $piiduser)
    {
        $oAccessData = new AccessData();
        $sQuery = "";
        $arrRS = null;
        $aLinea = null;
        $j = 0;
        $oContacts = null;
        $arrResultado = [];
        if ($oAccessData->connect()) {
            $sQuery = "SELECT Id, nombre, apellidop, apellidom, direccion, telefono, email, CveUser
        FROM contactos";
            if ($pitype == User::USER) {
                $sQuery = $sQuery . "
                WHERE CveUser = " . $piiduser;
            }
            $arrRS = $oAccessData->runQuery($sQuery);
            $oAccessData->disconnect();
            if ($arrRS) {
                foreach ($arrRS as $aLinea) {
                    $oContacts = new Contactos();
                    $oContacts->setId($aLinea[0]);
                    $oContacts->setNombre($aLinea[1]);
                    $oContacts->setApep($aLinea[2]);
                    $oContacts->setApem($aLinea[3]);
                    $oContacts->setDireccion($aLinea[4]);
                    $oContacts->setTelefono($aLinea[5]);
                    $oContacts->setEmail($aLinea[6]);
                    $oContacts->setCveUser($aLinea[7]);
                    $arrResultado[$j] = $oContacts;
                    $j++;
                }
            } else {
                $arrResultado = false;
            }
        }
        return $arrResultado;
    }

    function search()
    {
        $oAccessData = new AccessData();
        $sQuery = "";
        $arrRS = null;
        $bRet = false;
        if ($this->iid == 0) {
            throw new Exception("Contactos->buscar(): faltan datos");
        } else {
            if ($oAccessData->connect()) {
                $sQuery = "SELECT nombre, apellidop, apellidom, direccion, telefono, email, CveUser
                FROM contactos
                WHERE Id =" . $this->iid;
                $arrRS = $oAccessData->runQuery($sQuery);
                $oAccessData->disconnect();
                if ($arrRS) {
                    $this->sNombre = $arrRS[0][0];
                    $this->sApep = $arrRS[0][1];
                    $this->sApem = $arrRS[0][2];
                    $this->sDireccion = $arrRS[0][3];
                    $this->sTelefono = $arrRS[0][4];
                    $this->sEmail = $arrRS[0][5];
                    $this->CveUser = $arrRS[0][6];
                    $bRet = true;
                }
            }
        }
        return $bRet;
    }

    function insert()
    {
        $oAccessData = new AccessData();
        $sQuery = "";
        $nAfectados = -1;
        if (
            $this->sNombre == "" or $this->sApep == "" or
            $this->sDireccion == "" or $this->CveUser == 0
        ) {
            throw new Exception("Contactos->insertar(): faltan datos" . $this->sNombre . "', '" . $this->sApep . "', '" . $this->sApem . "', '" . $this->sDireccion . "', 
                        '" . $this->sTelefono . "', '" . $this->sEmail . "', " . intval($this->CveUser, 10));
        } else {
            if ($oAccessData->connect()) {
                $sQuery = "INSERT INTO contactos (nombre, apellidop, apellidom, direccion, telefono, email, CveUser)
                        VALUES('" . $this->sNombre . "', '" . $this->sApep . "', '" . $this->sApem . "', '" . $this->sDireccion . "', 
                        '" . $this->sTelefono . "', '" . $this->sEmail . "', " . intval($this->CveUser, 10) . ");";
                $nAfectados = $oAccessData->runCommand($sQuery);
                $oAccessData->disconnect();
            }
        }
        return $nAfectados;
    }

    function delete()
    {
        $oAccessData = new AccessData();
        $sQuery = "";
        $nAfectados = -1;
        if ($this->iid == 0) {
            throw new Exception("Contactos->delete(): no hay id" . $this->iid);
        } else {
            if ($oAccessData->connect()) {
                $sQuery = "DELETE FROM contactos
                WHERE Id = " . $this->iid;
                $nAfectados = $oAccessData->runCommand($sQuery);
                $oAccessData->disconnect();
            }
        }
        return $nAfectados;
    }

    function update()
    {
        $oAccessData = new AccessData();
        $sQuery = "";
        $nAfectados = -1;
        if (
            $this->sNombre == "" or $this->sApep == "" or
            $this->sDireccion == "" or $this->CveUser == 0
        ) {
            throw new Exception("Contactos -> Update(): Faltan Datos");
        } else {
            if ($oAccessData->connect()) {
                $sQuery = "UPDATE contactos
                SET nombre= '" . $this->sNombre . "' ,
                apellidop= '" . $this->sApep . "' ,
                apellidom= '" . $this->sApem . "' ,
                direccion= '" . $this->sDireccion . "' ,
                telefono= '" . $this->sTelefono . "' ,
                email= '" . $this->sEmail . "' ,
                CveUser= " . intval($this->CveUser, 10) . "
                WHERE Id = " . $this->iid;

                $nAfectados = $oAccessData ->runCommand($sQuery);
                $oAccessData->disconnect();
            }
        }
        return $nAfectados;
    }

}

?>