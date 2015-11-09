<?php
 /**
 * Description of Asset
 * Handle all about fixed assets
 * @author Gad Ocansey
 */
include_once ('core_database.php');
define('FINANCIAL_ACCURACY', 1.0e-6);
define('FINANCIAL_MAX_ITERATIONS', 100);

define('FINANCIAL_SECS_PER_DAY', 24 * 60 * 60);
define('FINANCIAL_HALF_SEC', 0.5 / FINANCIAL_SECS_PER_DAY);
session_start();

class Asset {
     
    public $accumulated_depreciation;
    public $cost;
    public $residual_value;
    public $useful_life;
    public $rate;
    public $method;
    public $asset_id;
    public $book_value;
    public $location;
    

    public function __construct( ) {
          ini_set('precision', '6');
    }
    
    public function DepreciableCost( ){
        return $this->cost-$this->residual_value;
    }
     

    public function YearlyRate(){
        if($this->method=='1'){
        $life=  $this->useful_life;
        return $per_year_rate= 1 / $life  * 100 . "%";
     
        }
    }
    
    //get fixed assets categories
    public function getCategories($asset){
        
        $con=  Core::getInstance();
        $STM2 = $con->dbh->query("SELECT * FROM tbl_fixed_asset_categories WHERE ID='$asset'  ");
        $result = $STM2->fetchAll();
                foreach ($result as $output)
                {
                    extract($output);
                      
                      return $FIXED_ASSET_CATEGORY;
                      
                 }
    }
        
    // GET FIXED ASSET LOCATION
    
    public function getLocation($asset){
        
        $con=  Core::getInstance();
        $STM2 = $con->dbh->query("SELECT * FROM tbl_department WHERE ID='$asset'  ");
        $result = $STM2->fetchAll();
                foreach ($result as $output)
                {
                    extract($output);
                      
                      return $DEPARTMENT_NAME;
                      
                 }
    }
    //get asset
        
    // GET FIXED ASSET LOCATION
    
    public function getAsset($asset){
        
        $con=  Core::getInstance();
        $STM2 = $con->dbh->query("SELECT * FROM tbl_fixed_assets_manager WHERE ID='$asset'  ");
        $result = $STM2->fetchAll();
                foreach ($result as $output)
                {
                    extract($output);
                      
                      return $FIXED_ASSET_NAME;
                      
                 }
    }
     public function depreciation_Type($asset){
        
        $con=  Core::getInstance();
        $STM2 = $con->dbh->query("SELECT * FROM tbl_depreciation_method WHERE ID='$asset'  ");
        $result = $STM2->fetchAll();
                foreach ($result as $output)
                {
                    extract($output);
                      
                      return $DEPRECIATION_METHOD;
                      
                 }
    }
    
    // useful life
        public function getLife($asset){
        
        $con=  Core::getInstance();
      $a=" SELECT *
FROM `tbl_fixed_assets_manager`
  WHERE 'USEFUL_LIFE' = '$asset'
LIMIT 0 , 30";
$STM2 = $con->dbh->query($a);
        $result = $STM2->fetchAll();
                foreach ($result as $output)
                {
                      extract($output);
                      
                      return $USEFUL_LIFE;
                      
                 }
    }
    
     
     
    /**
	* DDB
	* Returns the depreciation of an asset for a specified period using
	* the double-declining balance method or some other method you specify.
	* @param  float   $cost    is the initial cost of the asset.
	* @param  float   $salvage is the value at the end of the depreciation (sometimes called the salvage value of the asset).
	* @param  integer $life    is the number of periods over which the asset is being depreciated (sometimes called the useful life of the asset).
	* @param  integer $period  is the period for which you want to calculate the depreciation. Period must use the same units as life.
	* @param  float   $factor  is the rate at which the balance declines. If factor is omitted, it is assumed to be 2 (the double-declining balance method).
	* @return float   the depreciation of n periods.
	*/
       public function DDB($cost, $salvage, $life, $period, $factor = 2)
	{
		$x = 0;
		$n = 0;
		$life   = intval($life);
		$period = intval($period);
		while ($period > $n) {
			$x = $factor * $cost / $life;
			if (($cost - $x) < $salvage) $x = $cost- $salvage;
			if ($x < 0) $x = 0;
			$cost -= $x;
			$n++;
		}
		return $x;
	}
	
	/**
	* SLN
	* Returns the straight-line depreciation of an asset for one period.
	* @param  float   $cost    is the initial cost of the asset.
	* @param  float   $salvage is the value at the end of the depreciation (sometimes called the salvage value of the asset).
	* @param  integer $life    is the number of periods over which the asset is being depreciated (sometimes called the useful life of the asset).
	* @return float   the depreciation allowance for each period.
	*/
       private function SLN($cost, $salvage, $life)
	{
		$sln = ($cost - $salvage) / $life;
		return (is_finite($sln) ? $sln: null);
	}
        
        public function getAccumulated($asset,$period){
            $con=  Core::getInstance();
            try{
                 
                 $STM2 = $con->dbh->query("SELECT SUM(CALCULATION) AS TOTAL FROM tbl_depreciation_calculation WHERE ASSET='$asset' AND PERIOD <='$period' ");
                    $a=$STM2->fetchAll();
                    foreach ($a as $amt){
                         
                       return $amt[TOTAL];
                    }
            }
             //to handle error
              catch(PDOException $exception){
                 
                        echo "Error: " . $exception->getMessage();
                }
        }
         
        /*
         * reducing balance method
         */
        private function RDB($cost, $rate,  $asset,$period){
             $con=  Core::getInstance();
             
            $book  = $cost - $this->getAccumulated($asset, $period);
            $depreciation=  ceil($book * $rate) / 100  ;
            $stmt=$con->dbh->query("SELECT * FROM tbl_fixed_assets_manager  WHERE ID='$asset' AND DEPRECIATED='1'");
            $stmt2=$stmt->fetchAll();
            if(empty($stmt2)){
                 $con->dbh->query("UPDATE  tbl_fixed_assets_manager SET FIXED_ASSET_COST= FIXED_ASSET_COST- '$depreciation',SET DEPRECIATED='1' WHERE ID='$asset'");
             return $depreciation;
            }else{
               return 0; 
            }
             
        }


        /**
	* SYD
	* Returns the sum-of-years' digits depreciation of an asset for
	* a specified period.
	* 
	*        (cost - salvage) * (life - per + 1) * 2
	* SYD = -----------------------------------------
	*                  life * (1 + life)
	*
	* @param  float   $cost    is the initial cost of the asset.
	* @param  float   $salvage is the value at the end of the depreciation (sometimes called the salvage value of the asset).
	* @param  integer $life    is the number of periods over which the asset is depreciated (sometimes called the useful life of the asset).
	* @param  integer $per     is the period and must use the same units as life.  
	*/
       private function SYD($cost, $salvage, $life, $per)
	{
		$life = intval($life);
		$per  = intval($per);
		$syd  = (($cost - $salvage) * ($life - $per + 1) * 2) / ($life * (1 + $life));
		return (is_finite($syd) ? $syd: null);
	}
        public function calculateDepreciation($asset,$cost, $salvage, $life, $rate,$period,$method){
            $con=  Core::getInstance();
            try{
                 
                
                   $STM2 = $con->dbh->query("SELECT CALCULATION FROM tbl_depreciation_calculation WHERE ASSET='$asset' AND PERIOD='$period' ");
                     $a=$STM2->fetchAll();
                    
                   if(empty($a)){
                        if($method=='1'){
                             $dpr_amt= $this->SLN($cost, $salvage, $life);
                           $con->dbh->query("INSERT INTO tbl_depreciation_calculation (ASSET,METHOD,CALCULATION,PERIOD) VALUES('$asset','1','$dpr_amt','$period')  ");
                           return $dpr_amt;
                        }
                        elseif ($method=='2') {
                        $dpr_amt= $this->RDB($cost, $rate, $asset, $period);
                            $con->dbh->query("INSERT INTO tbl_depreciation_calculation (ASSET,METHOD,CALCULATION,PERIOD) VALUES('$asset','2','$dpr_amt','$period')  ");
                             
                            return $dpr_amt;
                       }

                     }
                     else{
                         foreach ($a as $amt){
                             return $amt[CALCULATION];
                         }
                     }
                     
             }
                //to handle error
              catch(PDOException $exception){
                 
                        echo "Error: " . $exception->getMessage();
                }
            }
            //get yearly depreciation for all report except balance sheet since it requires accumulated depreciation
              public function getDepreciation($asset,$period){
        
        $con=  Core::getInstance();
      $a=" SELECT *
FROM `tbl_depreciation_calculation`
  WHERE ASSET = '$asset'
AND PERIOD='$period'";
$STM2 = $con->dbh->query($a);
 $result = $STM2->fetchAll();
       if(!empty($result)){
                foreach ($result as $output)
                {
                      extract($output);
                      
                      return $CALCULATION;
                      
                 }
       }
       else{
           return "Depreciation not available now";
       }
    }
    
    //get accumulated deprec for balance sheet
          public function getAccDepreciation($asset,$period){
        
        $con=  Core::getInstance();
      $a=" SELECT SUM(CALCULATION) AS TOTAL
FROM `tbl_depreciation_calculation`
  WHERE ASSET = '$asset'
AND PERIOD='$period'";
$STM2 = $con->dbh->query($a);
 $result = $STM2->fetchAll();
       if(!empty($result)){
                foreach ($result as $output)
                {
                      extract($output);
                      
                      return $TOTAL;
                      
                 }
       }
       else{
           return "Depreciation not available now";
       }
    }
    //get fixed asset code from assets
         public function getAssetAccount($account){
        
        $con=  Core::getInstance();
      $a=" SELECT * FROM `tbl_fixed_assets_manager` WHERE FIXED_ASSET_NAME = '$account'";
$STM2 = $con->dbh->query($a);
 $result = $STM2->fetchAll();
       if(!empty($result)){
                foreach ($result as $output)
                {
                      extract($output);
                      
                      return $ID;
                      
                 }
       }
       else{
           return  ;
       }
    }
        
}
  $a=new Asset();
   