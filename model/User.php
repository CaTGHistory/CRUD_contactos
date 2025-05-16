<?php
include_once("Access_data.php");
include_once("Contactos.php");
class User
{
    private $nClave = 0;
    private $sPassword = "";
    private $sName = "";
    private $iType = 0;
    private $oAD = null;

    const ADMIN_USER = 1;
    const USER = 2;


    function getClave()
    {
        return $this->nClave;
    }
    function setClave($piClave)
    {
        $this->nClave = $piClave;
    }
    function getPassword()
    {
        return $this->sPassword;
    }
    function setPassword($psPassword)
    {
        $this->sPassword = $psPassword;
    }
    function getName()
    {
        return $this->sName;
    }
    function setName($psName)
    {
        $this->sName = $psName;
    }
    function getType(){
        return $this->iType;
    }
    function setType($piType){
        $this->iType = $piType;
    }


    public function SrhCvePwd(){
        $bRet = false;
        $sQuery = "";
        $arrRS = "";
        if($this ->nClave == 0 || $this->sPassword == ""){
            throw new Exception("Ausencia de datos");
        }else{
            $sQuery = "SELECT NameUser,TypeUser
            FROM users
            WHERE CveUser = " .$this->nClave."
            AND Password = '". $this->sPassword."'";
            $oAD = new AccessData();
            if ($oAD->connect()) {
                $arrRS = $oAD->runQuery($sQuery);
                $oAD ->disconnect();
                if ($arrRS != null) {
                    $this->setName($arrRS[0][0]);
                    $this->setType($arrRS[0][1]);
                    $bRet = true;
                }
            }
        }
        return $bRet;
    }

    
}
?>