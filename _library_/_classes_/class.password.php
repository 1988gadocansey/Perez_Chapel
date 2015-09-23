<?php
/**
 * Created by Riccardo Scotti.
 * User: Riccardo Scotti
 * Date: 18/08/15
 */

namespace _classes_;


class Generator {
    public $PrMix='Ricky'; //var sh Pre
    public $PoMix='Scotti'; //var sh Post
    public $Key=null; //var path htdocs

    public $Plain=null;
    public $DB_Encode=null;

    function __construct(){
        $this->Key=$_SERVER['DOCUMENT_ROOT'];
    }

    public function NewPassword($length=8) {
        $this->Plain = substr(\md5(), 0, $length);
        $this->DB_Encode=hash_hmac('sha512',$this->PrMix.$this->Plain.$this->PoMix,$this->Key);
    }

    public function generateEncode($password) {
        return hash_hmac('sha512',$this->PrMix.$password.$this->PoMix,$this->Key);
    }
}