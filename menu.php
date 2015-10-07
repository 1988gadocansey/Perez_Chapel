<?php
    
 global $sql;
$query=$sql->prepare("SELECT * FROM perez_modules AS top JOIN perez_auth AS auth ON top.USER_ID='$_SESSION[ID]' ");
			 
  $stmt=$sql->Execute($query);
if($stmt->RecordCount() > 0){
  
  
    
       
    
        //creating our table heading
        
         $menu_all=array();
        while($row = $stmt->FetchRow()){
           
            
             $module=$row["MODULES"];
              
             $menu_all=explode(",",$module);
              
             
         
            }
             // print_r($menu_all);
             for($i=0;$i < count($menu_all);$i++){
                $a=   $menu_all[$i]; 
               
             $query2 = $sql->prepare("SELECT * FROM perez_menu WHERE   id='$a' AND parentid='0' ORDER BY id ASC ");
            
              
            $stmt2 = $sql->Execute( $query2 );
            while($row=$stmt2->fetchRow()){
                extract($row);
              
                                 
                              echo" 
                                  
                              <li>
						<a href=\"javascript:;\">
							<i class=\"ion ion-document-text\"></i>
							<span class=\"text\">{$name}</span>
							<i class=\"arrow ion-chevron-left\"></i>
							 
						</a>
                            ";
                        
                         $query2 = $sql->prepare("SELECT * FROM perez_menu WHERE parentid='$a' ");
                        $stmt2 = $sql->Execute( $query2 );
                       echo" <ul class=\"inner-drop list-unstyled\">";
                    while ($row2 = $stmt2->FetchRow()){
                         extract($row2);
                        echo "
                               
                                     
                                    <li><a href=\"{$link}\">{$name}</a></li>
                               ";
                          
                           
                    }
                         echo  " </ul> ";
                        
                       
                         echo  " </li> ";
                        
                        
                         
              
              
            }
         }
            
       
            
       
           
}
 
 