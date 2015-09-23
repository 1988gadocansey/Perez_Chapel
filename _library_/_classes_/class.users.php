<?php
/**
 * Created by Riccardo Scotti.
 * User: Riccardo Scotti
 * Date: 18/08/15
 */

namespace _classes_;


class Identify {
    /*
     * Public methods:
     * getUser($var) = get session variable value already setted
     *      @var: string
     *
     * setUser($var) = set session variable value already setted
     *      @var: string
     *
     * setLanguage($lang) = set new language variable
     *      @lang: string
     *
     * createParameter($var,$cookie) = create new session variable and store or not in cookies
     *      @var: string
     *      @cookie: int 0-1
     *
     * unSetUser() = unset all session variable
     *
     * destroyUser() = destroy session variable and cookies!
     *      IMPORTANT!! set ob_start(); before output something!
     */

    const IpLocation = true ; #locate ip, need more time to execute
    protected $internalPage = null;
    /*
     * You can edit array for personal use:
     * create new subarray for preset value for not use method createParameter in runtime.
    */
    protected  $arrayUser=array(
                '_virtual_path'=>array(
                    'Cookie'=>0,
                    'Value'=>null
                ),
                '_language'=>array(
                    'Cookie'=>1,
                    'Value'=>null
                ),
                'UserName'=>array(
                    'Cookie'=>1,
                    'Value'=>null
                ),
                'Password'=>array(
                    'Cookie'=>0,
                    'Value'=>null
                ),

            );

    function __construct() {
        if (session_id() == '') {
            // !! Important
            session_start();
        }
        ini_set('session.gc_maxlifetime',0);
        ini_set('session.cookie_lifetime',0);

        $this->getVirtualPath(); //Virtual path for cookie setting

        if(isset($this->arrayUser['_login_verify'])==false){
            //create credential
            $this->arrayUser['_login_verify']['Cookie']=0;
            $this->arrayUser['_login_verify']['Value']=false;
            if ($this->get_session('_login_verify')){
                $this->arrayUser['_login_verify']['Value']=intval($this->get_session('_login_verify'));
            }
        }

        $this->getSessionDefaultData();
        if(self::IpLocation===true){
            $this->getLocationIp();
        }
    }

    public function getUser($key) {
        if(isset($this->arrayUser[$key])){
            return $this->arrayUser[$key]['Value'];
        }
        return false;
    }

    public function createParameter($key,$writeInCookie) {
        if(isset($this->arrayUser[$key])){
            return false;
        }
        $key=trim($key);
        if (strlen($key)<1 || substr($key,0,1)=='_'){
            return false;
        }
        if (intval($writeInCookie)==1){
            $this->forceValueCookie($key);
        }
        $this->setValue($key,null);
    }

    public function page(){
        if(isset($this->internalPage) && $this->internalPage!='' ){
            return $this->internalPage;
        }

        $this->internalPage= basename($_SERVER["SCRIPT_NAME"]);
        return $this->internalPage;
    }
    public function setUser($key,$value) {
        if(isset($this->arrayUser[$key]) && substr($key,0,1)!='_'){
            $this->setValue($key,$value);
            return true;
        }
        return false;
    }

    public function setLanguage($lang) {
        $this->forceValueCookie('_language');
        $this->setValue('_language',$lang);
        return true;
    }

    public function unSetUser() {
        @session_destroy();
    }

    public function destroyUser() {
        $this->unSetUser();
        $this->destroyCookie();
    }


    public function userIdentified() {
        if(isset($this->arrayUser['_login_verify']['Value']) && isset($this->arrayUser['_login_verify']['Cookie']) && $this->arrayUser['_login_verify']['Cookie']==0 ){
            return $this->arrayUser['_login_verify']['Value'];
        }
        return false;
    }

    public function loginVerifiedUser() {
        $this->setValue('_login_verify',1);
    }


    protected function getVirtualPath(){
        $arrStr = explode("/", $_SERVER['REQUEST_URI'] );
        $path='/';
        foreach ($arrStr as $key => $value) {
            if ($value!='' && strpos($value,basename($_SERVER['PHP_SELF']))===false) {
                $path .='/'.$value;
            }
        }
        $this->setValue('_virtual_path',$path);
    }


    private function getSessionDefaultData() {
        foreach ($this->arrayUser as $key => $value ) {
            if ($this->get_session($key)==null){
                $this->readArrayUser($key);
            } else {
                $this->writeArrayUser($key,$this->get_session($key));
            }
        }
    }

    protected function getLocationIp(){

        if ($this->get_session('_ip')==null){
            $details = json_decode(file_get_contents("http://ipinfo.io/{$_SERVER['REMOTE_ADDR']}/json"));
            $this->setValue('_ip',$details->ip);
            $this->setValue('_hostname',$details->hostname);
            $this->setValue('_city',$details->city);
            $this->setValue('_country',$details->country);
            $this->setValue('_localization',$details->loc);
        } else {
            $this->writeArrayUser('_ip',$this->get_session('_ip'));
            $this->writeArrayUser('_hostname',$this->get_session('_hostname'));
            $this->writeArrayUser('_city',$this->get_session('_city'));
            $this->writeArrayUser('_country',$this->get_session('_country'));
            $this->writeArrayUser('_localization',$this->get_session('_localization'));
        }

    }

    protected function readArrayUser($key){
        if(empty($_COOKIE[$key])){
            if ($key == '_language'){

                $this->setValue('_language',$_SERVER['HTTP_ACCEPT_LANGUAGE']['language']);
            } else {

                $this->setValue($key,null);
            }
        } else {

            $this->setValue($key,$_COOKIE[$key]);
            $this->forceValueCookie($key);
        }

    }

    protected function forceValueCookie($key){
        $this->arrayUser[$key]['Cookie']=1;
    }


    protected function setValue($key,$value){
        $this->set_session($key,$value); //store in session

        if (isset($this->arrayUser[$key]['Cookie']) && $this->arrayUser[$key]['Cookie']==1 ){
            //store value to cookies
            $this->set_cookie($key,$value);
        }
        //store in array
        $this->writeArrayUser($key,$value);
    }

    protected function writeArrayUser($key,$value) {
        $this->arrayUser[$key]['Value']=$value;
        if (isset($this->arrayUser[$key]['Cookie'])==false){
            $this->arrayUser[$key]['Cookie']=0;
        }
    }

    protected  function set_cookie($cookieKey,$cookieVal){
        if (isset($this->arrayUser['_virtual_path']['Value'])== false ){
            echo 'Critical error: virtual path not found.';
            exit;
        } else {
            setcookie ($cookieKey, $cookieVal, time()+60*60*60*24*30,$this->arrayUser['_virtual_path']['Value'],$_SERVER['SERVER_NAME']);
        }

    }

    protected function destroyCookie() {

        if (isset($this->arrayUser['_virtual_path']['Value'])== false ){
            $tempPath='/';
        } else {
            $tempPath=$this->arrayUser['_virtual_path']['Value'];
        }
        foreach ($_COOKIE as $key => $value ) {
            setcookie ($key, null, time()-3600,$tempPath,$_SERVER['SERVER_NAME']);
        }
    }

    protected  function set_session($var_key,$var_value){
        $_SESSION[$var_key]=$var_value;
    }

    protected  function get_session($var_key){
        if (isset($_SESSION[$var_key])){
            return $_SESSION[$var_key];
        }
        return null;
    }
}
