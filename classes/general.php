<?php
error_reporting(0);
$whitelist = array(
    '127.0.0.1',
    '::1'
);

if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
    define('HOST', $_SERVER['REQUEST_SCHEME'].'http://');
    $flag = true;
}else{
     define('HOST', $_SERVER['REQUEST_SCHEME'].'://');
     $flag = false;
}

$request_type = (getenv('HTTPS') == 'on') ? 'SSL' : 'NONSSL';

 if ($request_type == 'NONSSL'){
    define('DOMAINURL', 'http://localhost/tracer');
    define('DOMAIN_IMAGE_URL', 'src="localhost/tracer');
    //define('GLO_EMAIL', 'seetharaman@pabrai.com,Bhuvaneswari@pabrai.com');
    //define('GLO_EMAIL', 'seetharaman@pabrai.com');

 }else{
    define('DOMAINURL', 'http://localhost/tracer');
    define('DOMAIN_IMAGE_URL', 'src="http://localhost/tracer');
    //define('GLO_EMAIL', 'seetharaman@pabrai.com,Bhuvaneswari@pabrai.com');  
   //define('GLO_EMAIL', 'seetharaman@pabrai.com');

 }
  
define('BASE_NAME', substr( HOST.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'] ,0,-11) ); //http://localhost/tracer/
define('BASE_URL', HOST.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']); //http://localhost/tracer/welcome.php
define('BASE_URI', HOST.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); //http://localhost/tracer/welcome.php?Page=Ra_Dcf_form

define('BASE_PATH', substr( $_SERVER['SCRIPT_FILENAME'] ,0,-11) ); // C:/xampp/htdocs/tracer/
define("ENCRYPTION_KEY", "sampletext");
define( 'ABSPATH', dirname(__FILE__) . '/' );

define('UPLOAD_URL', substr( HOST.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'] ,0,-11).'uploads/' );
define('UPLOAD_PATH', substr( $_SERVER['SCRIPT_FILENAME'] ,0,-11) ).'uploads/'; // C:/xampp/htdocs/tracer/


class Tracer {
	var $conn;
	var $db;
        
	function __construct()
	{
                session_start();
                ob_start();
                
                global $table_prefix;

                $table_prefix = 'tr_';

                 //DEMO SERVER CREDENTIALS
                $this->conn = mysql_connect('localhost','root','');
                $this->db  = mysql_select_db('tracer',$this->conn);
                
                //LIVE SERVER CREDENTIALS
                //$this->conn = mysql_connect('localhost','tracerec_tracer','xFVfUKZvpUik');
                //$this->db  = mysql_select_db('tracerec_tracer',$this->conn);
                
                //LOCAL SERVER CREDENTIALS
                //$this->conn = mysql_connect('localhost','root','');
                //$this->db  = mysql_select_db('tracer',$this->conn);
                
                // This two function is used for db creation
                
                $this->error_fn( 'testing' );
          
	}
        
        function error_fn( $val ){
            switch ( $val )
                {
                        case 'development':
                                error_reporting(E_ALL);
                        break;

                        case 'testing':
                        case 'production':
                                error_reporting(0);
                        break;

                        default:
                                exit('The application environment is not set correctly.');
                }
        }
        function checkPage(){
           
            
             if($_SESSION['ses_user_role']  == 1 || $_SESSION['ses_user_role'] == 2)
               {
                   return 1;
                   
               } else if($_SESSION['ses_user_role']  == 3 || $_SESSION['ses_user_role'] == 4){
                   return 2;
               }
                return false;
        }

        function get_logoRA_Dcaf(){
                       
        $select_form_fields = mysql_query('SELECT options FROM tr_media WHERE module = "FROM_CLIENT" AND form_field = "logo" AND user= '.$_SESSION["ses_user_id"].'');
        $count = mysql_num_rows($select_form_fields);
        
               
        if (!$select_form_fields) {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $select_form_fields;
            die($message);
        }
        
        if($count != ''){
            $rowcommon = mysql_fetch_assoc($select_form_fields);
        }

        return $rowcommon;
     }
      function getlogoRA_Dcaf(){
                       
        $select_form_fields_thumbs = mysql_query('SELECT options FROM tr_media WHERE module = "FROM_CLIENT" AND form_field = "logo" AND user= '.$_SESSION["ses_user_id"].'');
        $count = mysql_num_rows($select_form_fields_thumbs);
        $select_form_fields_thumb = mysql_query('SELECT options FROM tr_media WHERE module = "RA_DCF" AND form_field = "logo" AND user= '.$_SESSION["ses_user_id"].'');
        
        
               
        if (!$select_form_fields_thumbs) {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $select_form_fields_thumbs;
            die($message);
        }
        
        if($count != ''){
            $rowcommon = mysql_fetch_assoc($select_form_fields_thumbs);
            $pagelogos = unserialize(urldecode($rowcommon['options']));
            $res = $pagelogos['thumb_s'];
            
        }else{
            $rowcommon = mysql_fetch_assoc($select_form_fields_thumb);
             $pagelogos = unserialize(urldecode($rowcommon['options']));
             $res = $pagelogos['thumb'];
        }

        return $res;
    }
        function getlogoDrp_Dcf(){
                       
           
         $select_form_fields = mysql_query('SELECT options FROM tr_media WHERE module = "FROM_CLIENT" AND form_field = "logo" AND user= '.$_SESSION["ses_user_id"].'');
        $count = mysql_num_rows($select_form_fields);
        
               
        if (!$select_form_fields) {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $select_form_fields;
            die($message);
        }
        
        if($count != ''){
            $rowcommon = mysql_fetch_assoc($select_form_fields);
        }

        return $rowcommon;
       
    }
         function checkVaPage($path){
            if($_SESSION['ses_user_role'] == 1 || $_SESSION['ses_user_role'] == 2){
                
                  return true;

                    
            }else if(isset($_SESSION['ses_user_role'])  == 4 ){
                 $va_array = array(
                     'platdcf' => 'Va_Dcf_Platinum',
                     'golddcf' => 'Va_Dcf_Gold',
                     'silvdcf' => 'Va_Dcf_Silver',
                     'brondcf' => 'Va_Dcf_Bronze',
                     'webapppenet' => 'Web_App_Penet',
                     'extnetworkapppenet' => 'Ext_Net_Work'
                 );
                 
              $tab_check = explode(',',$_SESSION["ses_menu_tab"]);
                foreach($tab_check as $key => $n) {
                $tab_check[$n] = $n;
                }
             
               $key = array_search($path, $va_array);
              
                $locked_status = explode(',',$_SESSION["ses_locked_status"]);
                foreach($locked_status as $keys => $l){
                    $locked_status[$l] = $l;
                }
                   
               $locked_arrays = array(
                     'platdcf' => 'Va_Dcf_Platinum',
                     'golddcf' => 'Va_Dcf_Gold',
                     'silvdcf' => 'Va_Dcf_Silver',
                     'brondcf' => 'Va_Dcf_Bronze',
                     'webapppenet' => 'Web_App_Penet',
                     'extnetworkapppenet' => 'Ext_Net_Work'
                    
                                         
                 );
               
               $keys = array_search($path, $locked_arrays);
                                   
                  $pos = strpos($keys, 'report');
              
                if($tab_check[$key] == $key && $locked_status[$keys] != $keys){

                return 1;
                }else if($locked_status[$keys] == $keys || $pos == 'true'){
                return 2;
               }        
               /*if($tab_check[$key] == $key){return true;}*/
                   
               } 
               return false;
        }
        function checkRA_BIA_DRP_reportPage($path){
             if($_SESSION['ses_user_role'] == 1 || $_SESSION['ses_user_role'] == 2 || $_SESSION['ses_user_role'] == 3){
                
                  return true;

                    
            }else if(isset($_SESSION['ses_user_role'])  == 4 ){
                 $array = array(
                     'drp' => 'Drp_Dcf_report',
                     'radcf' => 'Ra_Dcf_report',
                     'radcaf' => 'Ra_Dcaf_report',
                     'biadcf' => 'BIA_DCF_form_report',
                     'biaitdcaf' => 'BIA_IT_form_report',
                     'evaldcf' => 'eval_dcf_report'
                     
                 );
                
                $tab_check = explode(',',$_SESSION["ses_menu_tab"]);
                foreach($tab_check as $key => $n){
                    $tab_check[$n] = $n;
                }
                                
                $locked_status = explode(',',$_SESSION["ses_locked_status"]);
                foreach($locked_status as $keys => $l){
                    $locked_status[$l] = $l;
                }
                
                            
                $key = array_search($path, $array);
                
                 $locked_arrays = array(
                    'drp' => 'Drp_Dcf_report',
                     'radcf' => 'Ra_Dcf_report',
                     'radcaf' => 'Ra_Dcaf_report',
                     'biadcf' => 'BIA_DCF_form_report',
                     'biaitdcaf' => 'BIA_IT_form_report',
                     'evaldcf' => 'eval_dcf_report'
                    
                                         
                 );
                $keys = array_search($path, $locked_arrays);
                                   
                  $pos = strpos($keys, 'report');
                        
                if($tab_check[$key] == $key && $locked_status[$keys] != $keys){
                  
                    return 1;
                }else if($locked_status[$keys] == $keys || $pos == 'true'){
                    return 2;
                }
              
             
               
               
               return false;
         }
        }
          function checkRA_BIA_DRPPage($path){
              
            if($_SESSION['ses_user_role'] == 1 || $_SESSION['ses_user_role'] == 2 || $_SESSION['ses_user_role'] == 3){
                
                  return true;

            }else if(isset($_SESSION['ses_user_role'])  == 4 ){
                 $array = array(
                     'drp' => 'Drp_form',
                     'radcf' => 'Ra_Dcf_form',
                     'radcaf' => 'Ra_Dcaf_form',
                     //'radcaf' => 'Ra_Dcaf_form_load',
                     'biadcf' => 'BIA_form',
                     'biaitdcaf' => 'BIA_IT_form',
                     'evaldcf' => 'eval_dcf_form'
                     
                 );
                
              $tab_check = explode(',',$_SESSION["ses_menu_tab"]);
                foreach($tab_check as $key => $n){
                $tab_check[$n] = $n;
                }
             
                
                 
                $locked_status = explode(',',$_SESSION["ses_locked_status"]);
                foreach($locked_status as $keys => $l){
                    $locked_status[$l] = $l;
                }
                
                
              $key = array_search($path, $array);
              
                 $locked_arrays = array(
                     'drp' => 'Drp_form',
                     'radcf' => 'Ra_Dcf_form',
                     'radcaf' => 'Ra_Dcaf_form',
                     //'radcaf' => 'Ra_Dcaf_form_load',
                     'biadcf' => 'BIA_form',
                     'biaitdcaf' => 'BIA_IT_form',
                     'evaldcf' => 'eval_dcf_form',
                   
                 );
                $keys = array_search($path, $locked_arrays);
                                   
                  $pos = strpos($keys, 'report');
                        
                if($tab_check[$key] == $key && $locked_status[$keys] != $keys || $_GET['Page'] == 'Ra_Dcaf_form_load'){
                    return 1;
                }else if($locked_status[$keys] == $keys || $pos == 'true'){
                    return 2;
               }    
              
               return false;
        }
        }
        function checkVaPageReport($path){
            
            if($_SESSION['ses_user_role'] == 1 || $_SESSION['ses_user_role'] == 2){
                
                  return true;

                    
            }else if(isset($_SESSION['ses_user_role'])  == 4 ){
                
                    $va_array = array(
                        'platdcf' => 'Va_Dcf_Platinum_report',
                        'golddcf' => 'Va_Dcf_Gold_report',
                        'silvdcf' => 'Va_Dcf_Silver_report',
                        'brondcf' => 'Va_Dcf_Bronze_report'
                    );

                $tab_check = explode(',',$_SESSION["ses_menu_tab"]);
                foreach($tab_check as $key => $n) {
                $tab_check[$n] = $n;
                }
             
              $key = array_search($path, $va_array);
              
                   
               $locked_status = explode(',',$_SESSION["ses_locked_status"]);
                foreach($locked_status as $keys => $l){
                    $locked_status[$l] = $l;
                }
               
               $locked_arrays = array(
                     'platdcf' => 'Va_Dcf_Platinum_report',
                        'golddcf' => 'Va_Dcf_Gold_report',
                        'silvdcf' => 'Va_Dcf_Silver_report',
                        'brondcf' => 'Va_Dcf_Bronze_report'

                                         
                 );
               
               $keys = array_search($path, $locked_arrays);
                                   
                  $pos = strpos($keys, 'report');
              
               //if($tab_check[$key] == $key){return true;}
                 if($tab_check[$key] == $key && $locked_status[$keys] != $keys){

                return 1;
                }else if($locked_status[$keys] == $keys || $pos == 'true'){
                return 2;
             } 
               

             } 
               return false;
        }
       
        function CheckSession() {
            
            if(!isset($_SESSION['ses_user_role']) || $_SESSION['ses_user_role'] == '' || $_SESSION['ses_user_id'] == '')
                {
                    echo "<script language='javascript'>";
                    echo "window.location='index.php'";
                    echo "</script> ";
                    exit;
                    }
           
            }
            function CheckAdminSession(){
                
                 if($_SESSION['ses_user_role'] != '1' && $_SESSION['ses_user_role'] != '2')
                     
                { echo "<script language='javascript'>";
                    echo "window.location='index.php'";
                    echo "</script> ";
                    exit;
                    
                }    
            
                
            }
          function getAdminReport_Filename($id, $name){
          
            $dates = date('m-d-y');
           
             $select_form_fields = mysql_query('SELECT * FROM tr_users WHERE user_id= '.$id);
             $row = mysql_fetch_object( $select_form_fields );
    
            if($row->user_name){ 

              $filename = $row->user_name.'_'.$name.'_'.$dates.'.doc';
            $success_message = 'Information Successfully Saved';
            }
          
            $pack = array('filename' => $filename, 'success_message' => $success_message);
            return $pack;
        }         
        function getReportFilename( $name ){
           
            $dates = date('m-d-y');
            $filename = $_SESSION['ses_user_name'].'_'.$name.'_'.$dates.'.doc';
            $success_message = 'Information Successfully Saved';
            

            $pack = array('filename' => $filename, 'success_message' => $success_message);
            return $pack;
        }
        function getReportRACFEXPRESS_Filename($id, $name){
            
                                   
             $dates = date('m-d-y');
           
             $select_form_fields = mysql_query('SELECT * FROM tr_users WHERE user_id= '.$id);
             $row = mysql_fetch_object( $select_form_fields );
    
            if($row->user_name){ 

              $filename = $row->user_name.'_'.$name.'_'.$dates.'.doc';
            $success_message = 'Information Successfully Saved';
            }
          
            $pack = array('filename' => $filename, 'success_message' => $success_message);
            return $pack;
        }
       
        function getAlertMess(){
             echo "<script type='text/javascript'>

                window.onload = function()
                {    
                    myFunction();
                }
                </script>"; 
        }

        function checkSessionTimeout(){
                      
                  $expireAfter = 30; // 30 minutes
             
                
                if(isset($_SESSION['last_action'])){

                    //Figure out how many seconds have passed
                    //since the user was last active.
                    $secondsInactive = time() - $_SESSION['last_action'];

                    //Convert our minutes into seconds.
                    $expireAfterSeconds = $expireAfter * 60;
                
                    //Check to see if they have been inactive for too long.
                    if($secondsInactive >= $expireAfterSeconds){
                        //User has been inactive for too long.
                        //Kill their session.
                        session_unset();
                        session_destroy();
                    }

                }
         
         
        }
        
        function getAllUserDetails($page){
            $per_page = 5; 

            $startpoint = ($page * $per_page) - $per_page;
            
            $condition = ' WHERE 1 ';
            $role = $_SESSION["ses_user_role"];
            if($role == 1){
                $condition .= "";
            }
            
            if($role == 2){
                $condition .= "AND  u.user_id = '".$_SESSION["ses_user_id"]."' OR u.user_role = 4 OR u.user_role = 3 ";
            }
        
            if($role == 3){
                $condition .= " AND u.user_id = '".$_SESSION["ses_user_id"]."'";
            }
             if($role == 4){
                $condition .= " AND u.user_id = '".$_SESSION["ses_user_id"]."' ";
            }
            /*echo "SELECT u.*, um.*, ur.* FROM tr_users as u INNER JOIN tr_user_meta as um ON u.user_id=um.user_id INNER JOIN tr_user_role as ur ON ur.role_id=u.user_role $condition  ORDER BY u.user_id LIMIT {$startpoint} , {$per_page}";*/
                $select_form_fields = mysql_query("SELECT u.*, um.*, ur.* FROM tr_users as u INNER JOIN tr_user_meta as um ON u.user_id=um.user_id INNER JOIN tr_user_role as ur ON ur.role_id=u.user_role $condition  ORDER BY um.user_cname LIMIT {$startpoint} , {$per_page}");
                  $count = mysql_num_rows($select_form_fields);

                    if($count != ''){

                        //$row = mysql_fetch_assoc($select_form_fields);
                        while ($row = mysql_fetch_assoc($select_form_fields)) {
                        $rowcommon[] = $row;
                        }
                    }

           
            return  $rowcommon;
        }
        function getSearchByCompany($search, $page){
            
            $per_page = 5;
            
            $condition = ' WHERE 1 ';
            $role = $_SESSION["ses_user_role"];
            if($role == 1){
                $condition .= "";
            }

            if($role == 2){
                $condition .= "AND (u.user_role =4 OR u.user_role =3 OR u.user_id = '".$_SESSION["ses_user_id"]."')";
            }

            if($role == 3){
                $condition .= " AND u.user_id = '".$_SESSION["ses_user_id"]."' OR u.user_role = 4 ";
            }
             if($role == 4){
                $condition .= " AND u.user_id = '".$_SESSION["ses_user_id"]."' ";
            }
            
            $startpoint = ($page * $per_page) - $per_page;
                      
           $like = "(um.user_cname LIKE '%". mysql_real_escape_string($search)."%' OR u.user_name LIKE '%". mysql_real_escape_string($search)."%' OR u.user_email LIKE '%". mysql_real_escape_string($search)."%')";
            
                        
           $sql = "SELECT u.*, um.* FROM tr_users as u INNER JOIN tr_user_meta as um ON u.user_id=um.user_id $condition AND $like ORDER BY u.user_id LIMIT {$startpoint} , {$per_page}";
                       
            $select_form_fields = mysql_query($sql);
            $count = mysql_num_rows($select_form_fields);

            if($count != ''){
                
                while ($row = mysql_fetch_assoc($select_form_fields)) {
                    $rowcommon[] = $row;
                }
               
                  
            }
            return  $rowcommon;
            
        }
            function getSearchByRole($search, $page){
                
            $per_page = 5; 
            
            $condition = ' WHERE 1 ';
            $role = $_SESSION["ses_user_role"];
            if($role == 1){ // SUPERADMIN
                $condition .= "";
            }

            if($role == 2){ // COMPANY ADMIN
                if($search == 2){
                     $condition .= "AND  u.user_id = '".$_SESSION["ses_user_id"]."'";
                }else{
                     $condition .= "";
                }
            }

            if($role == 3){ // COMPANY USER
                $condition .= " AND u.user_id = '".$_SESSION["ses_user_id"]."' OR u.user_role = 4 ";
            }
             if($role == 4){ // Client
                $condition .= " AND u.user_id = '".$_SESSION["ses_user_id"]."' ";
            }
            
            
            $startpoint = ($page * $per_page) - $per_page;
            
            $sql = "SELECT u.*, um.*, ur.* FROM tr_users as u INNER JOIN tr_user_meta as um ON u.user_id=um.user_id INNER JOIN tr_user_role as ur ON ur.role_id=u.user_role $condition AND u.user_role=".$search." ORDER BY u.user_id LIMIT {$startpoint} , {$per_page}";
            
            $select_form_fields = mysql_query($sql);
            $count = mysql_num_rows($select_form_fields);

            if($count != ''){
                
                while ($row = mysql_fetch_assoc($select_form_fields)) {
                    $rowcommon[] = $row;
                }
               
                  
            }
            return  $rowcommon;
            
        }
        function pagination($search,$per_page=5,$page=1,$url='?',$case){
            
            if($per_page == ''){
            $per_page = 5; 
            }

            //echo "CASE: ".$case;
            //echo "SEARCH: ".$search;
            $startpoint = ($page * $per_page) - $per_page;
                        
            if($case == 3){
                $query = "SELECT u.* , um . * , ur . * FROM tr_users AS u INNER JOIN tr_user_meta AS um ON u.user_id = um.user_id INNER JOIN tr_user_role AS ur ON ur.role_id = u.user_role WHERE 1 AND u.user_id = '31' OR u.user_role = 4 OR u.user_role = 3 ORDER BY u.user_id ASC";
            }else if($case == 1){
                if($_SESSION["ses_user_role"] == '2'){
                    $condition .= "WHERE um.user_cname LIKE '".$search."%' AND (u.user_role =4 OR u.user_role =3)";
                }else{
                    $condition .= "WHERE um.user_cname LIKE '".$search."%'";
                }
               
                $query = "SELECT u.*, um.*, ur.* FROM tr_users as u INNER JOIN tr_user_meta as um ON u.user_id=um.user_id INNER JOIN tr_user_role as ur ON ur.role_id=u.user_role ".$condition." ORDER BY u.user_id ASC";
            }else if($case == 2){
                            
                if($search == '2' && $_SESSION["ses_user_role"] == '2'){
                    $condition = "WHERE u.user_role=".$_SESSION["ses_user_id"]." AND u.user_role=".$search."";
                   
                }else{
                   $condition ="WHERE u.user_role=".$search."";  
                }
                
                $query = "SELECT u.*, um.*, ur.* FROM tr_users as u INNER JOIN tr_user_meta as um ON u.user_id=um.user_id INNER JOIN tr_user_role as ur ON ur.role_id=u.user_role ".$condition." ORDER BY u.user_id ASC";
            }
            //$query = "SELECT COUNT(*) as `num` FROM {$query}";
            $select_form_fields = mysql_query($query);
            $count = mysql_num_rows($select_form_fields);
            
            //$row = mysql_fetch_array(mysql_query($query));
            $total = $count;
            $adjacents = "2";

            $prevlabel = "&lsaquo; Prev";
            $nextlabel = "Next &rsaquo;";
            $lastlabel = "Last &rsaquo;&rsaquo;";

            $page = ($page == 0 ? 1 : $page); 
            $start = ($page - 1) * $per_page;                              

            $prev = $page - 1;                         
            $next = $page + 1;

            $lastpage = ceil($total/$per_page);

            $lpm1 = $lastpage - 1; // //last page minus 1

            $pagination = "";
            if($lastpage > 1){  
            $pagination .= "<ul class='pagination'>";
            $pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";

                if ($page > 1) $pagination.= "<li><a href='{$url}Page=List_user&page={$prev}'>{$prevlabel}</a></li>";

            if ($lastpage < 7 + ($adjacents * 2)){  
                for ($counter = 1; $counter <= $lastpage; $counter++){
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}Page=List_user&page={$counter}'>{$counter}</a></li>";                   
                }

            } elseif($lastpage > 5 + ($adjacents * 2)){

                if($page < 1 + ($adjacents * 2)) {

                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                        if ($counter == $page)
                            $pagination.= "<li><a class='current'>{$counter}</a></li>";
                        else
                            $pagination.= "<li><a href='{$url}Page=List_user&page={$counter}'>{$counter}</a></li>";                   
                    }
                    $pagination.= "<li class='dot'></li>";
                    $pagination.= "<li><a href='{$url}Page=List_user&page={$lpm1}'>{$lpm1}</a></li>";
                    $pagination.= "<li><a href='{$url}Page=List_user&page={$lastpage}'>{$lastpage}</a></li>"; 

                } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                    $pagination.= "<li><a href='{$url}Page=List_user&page=1'>1</a></li>";
                    $pagination.= "<li><a href='{$url}Page=List_user&page=2'>2</a></li>";
                    $pagination.= "<li class='dot'></li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<li><a class='current'>{$counter}</a></li>";
                        else
                            $pagination.= "<li><a href='{$url}Page=List_user&page={$counter}'>{$counter}</a></li>";                   
                    }
                    $pagination.= "<li class='dot'></li>";
                    $pagination.= "<li><a href='{$url}Page=List_user&page={$lpm1}'>{$lpm1}</a></li>";
                    $pagination.= "<li><a href='{$url}Page=List_user&page={$lastpage}'>{$lastpage}</a></li>";     

                } else {

                    $pagination.= "<li><a href='{$url}Page=List_user&page=1'>1</a></li>";
                    $pagination.= "<li><a href='{$url}Page=List_user&page=2'>2</a></li>";
                    $pagination.= "<li class='dot'></li>";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<li><a class='current'>{$counter}</a></li>";
                        else
                            $pagination.= "<li><a href='{$url}Page=List_user&page={$counter}'>{$counter}</a></li>";                   
                    }
                }
            }

                if ($page < $counter - 1) {
                    $pagination.= "<li><a href='{$url}Page=List_user&page={$next}'>{$nextlabel}</a></li>";
                    $pagination.= "<li><a href='{$url}Page=List_user&page=$lastpage'>{$lastlabel}</a></li>";
                }

            $pagination.= "</ul>";       
            }

            return $pagination;
            }
        function encrypt_decrypt($pass_String, $action = '') {
           
            $key = 'pabrai india';
            $string = $pass_String;
            
            if($action == 'encrypt'){
                $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
                return $encrypted;
            }else if($action == 'decrypt'){
               
                $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
                return $decrypted;
            }
            
            //echo "<br><br>".$decrypted;
            //echo "<br><br>".$encrypted;
           

        }
        
        function randStrGen($len , $sp = true){ 
            $result = "";
            $spcial = '';
            if($sp){
                $spcial = '$#@&!%*?!-';
            }
            $chars = "abcdefghijklmnopqrstuvwxyz".$spcial."0123456789"; 
            $charArray = str_split($chars); 
            for($i = 0; $i < $len; $i++){ 
            $randItem = array_rand($charArray); 
            $result .= "".$charArray[$randItem];
            }
            return $result; 
        } 
        
        function get_user_role(){
                    
            $select_form_fields = mysql_query('SELECT va_type FROM tr_users WHERE user_id= "'.$_SESSION["ses_user_id"].'" AND status = "'.$_SESSION["ses_status"].'"');
            $row = mysql_fetch_object( $select_form_fields );
            $url_page = '';
            switch($row->va_type){
                case '1':
                    $url_page = 'Va_Dcf_Platinum'; break; 
                case '2':
                    $url_page = 'Va_Dcf_Gold'; break; 
                case '3':
                    $url_page = 'Va_Dcf_Silver'; break; 
                case '4':
                    $url_page = 'Va_Dcf_Bronze'; break;
            }
        
            return $url_page;
        }

        function smart_resize_image($file,
                              $string             = null,
                              $width              = 0, 
                              $height             = 0, 
                              $proportional       = true, 
                              $output             = 'file', 
                              $delete_original    = true, 
                              $use_linux_commands = false,
                                $quality = 100
  		 ) {
      
            if ( $height <= 0 && $width <= 0 ) return false;
            if ( $file === null && $string === null ) return false;
            # Setting defaults and meta
            $info                         = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
            $image                        = '';
            $final_width                  = 0;
            $final_height                 = 0;
            list($width_old, $height_old) = $info;
                $cropHeight = $cropWidth = 0;
            # Calculating proportionality
            if ($proportional) {
              if      ($width  == 0)  $factor = $height/$height_old;
              elseif  ($height == 0)  $factor = $width/$width_old;
              else                    $factor = min( $width / $width_old, $height / $height_old );
              $final_width  = round( $width_old * $factor );
              $final_height = round( $height_old * $factor );
}
            else {
              $final_width = ( $width <= 0 ) ? $width_old : $width;
              $final_height = ( $height <= 0 ) ? $height_old : $height;
                  $widthX = $width_old / $width;
                  $heightX = $height_old / $height;

                  $x = min($widthX, $heightX);
                  $cropWidth = ($width_old - $width * $x) / 2;
                  $cropHeight = ($height_old - $height * $x) / 2;
            }
            # Loading image to memory according to type
            switch ( $info[2] ) {
              case IMAGETYPE_JPEG:  $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);  break;
              case IMAGETYPE_GIF:   $file !== null ? $image = imagecreatefromgif($file)  : $image = imagecreatefromstring($string);  break;
              case IMAGETYPE_PNG:   $file !== null ? $image = imagecreatefrompng($file)  : $image = imagecreatefromstring($string);  break;
              default: return false;
            }

            # This is the resizing/resampling/transparency-preserving magic
            $image_resized = imagecreatetruecolor( $final_width, $final_height );
            if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
              $transparency = imagecolortransparent($image);
              $palletsize = imagecolorstotal($image);
              if ($transparency >= 0 && $transparency < $palletsize) {
                $transparent_color  = imagecolorsforindex($image, $transparency);
                $transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                imagefill($image_resized, 0, 0, $transparency);
                imagecolortransparent($image_resized, $transparency);
              }
              elseif ($info[2] == IMAGETYPE_PNG) {
                imagealphablending($image_resized, false);
                $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
                imagefill($image_resized, 0, 0, $color);
                imagesavealpha($image_resized, true);
              }
            }
            imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);


            # Taking care of original, if needed
            if ( $delete_original ) {
              if ( $use_linux_commands ) exec('rm '.$file);
              else @unlink($file);
            }
            # Preparing a method of providing result
            //echo $output;
            switch ( strtolower($output) ) {
              case 'browser':
                $mime = image_type_to_mime_type($info[2]);
                header("Content-type: $mime");
                $output = NULL;
              break;
              case 'file':
                $output = $file;
              break;
              case 'return':
                return $image_resized;
              break;
              default:
              break;
            }
            # Writing image according to type to the output destination and image quality
            switch ( $info[2] ) {
              case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
              case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
              case IMAGETYPE_PNG:
                $quality = 9 - (int)((0.9*$quality)/10.0);
                imagepng($image_resized, $output, $quality);
                break;
              default: return false;
            }

            return true;
          }
        
          /**
           * 
           * Inset Media records
           * 
           */
        function inputMedia($user_id,$module,$page = '',$field ='',$send ='',$receive ='',$title ='',$exte='',$filename,$alt='',$caption='',$description = '',$height = '',$weight ='',$size ='',$type ='',$location,$path='',$option ='',$created ='',$modefi = '',$extra = ''){
            $inssql = "insert into tr_media set "
                        . "user = '".$user_id."'"
                        . ",". " module = '".$module."'"
                        . ",". " page = '".$page."'"
                        . ",". " form_field = '".$field."'"
                        . ",". " send = '".$send."'"
                        . ",". " received = '".$receive."'"
                        . ",". " title = '".mysql_real_escape_string($title)."'"
                        . ",". " exte = '".$exte."'"
                        . ",". " filename = '".$filename."'"
                        . ",". " alt = '".$alt."'"
                        . ",". " caption = '".$caption."'"
                        . ",". " description = '".$description."'"
                        . ",". " height = '".$height."'"
                        . ",". " width = '".$weight."'"
                        . ",". " size = '".$size."'"
                        . ",". " mine = '".$type."'"
                        . ",". " location = '".$location."'"
                        . ",". " path = '".$path."'"
                        . ",". " options = '".  $option."'"
                        . ",". " staus = 1"
                        . ",". " extra = '".  $extra."'"
                        . ",". " created = '".date('Y-m-d H:i:s')."'"
                        . ",". " modified = '".$modefi."'";
                //echo $inssql;
                    $qrysql = mysql_query($inssql) or die("Error: (" . mysql_errno() . ") " . mysql_error());
                    $lastid = mysql_insert_id();
                    return $lastid;
        }
        function getExtension($fileName){
            $current_timestamp  = '';
            $info               = pathinfo($fileName);
            $ext                = $info['extension'];
            $current_timestamp  = strtotime("now").mt_rand(); 
            $myfilename         = $current_timestamp.'.'.$ext;
            return array( 'ext' => $ext ,'current_name' => $current_timestamp, 'current_name_ext' => $myfilename );
        }
        
        function deleteUploadFile($filePath , $id){
        
                $sql = "DELETE FROM tr_media WHERE media_id = '".$id."'";
                $res = mysql_query($sql);

            if($res){
                echo "File Deleted";
            }
                
            if (file_exists($filePath)) 
            {
                unlink($filePath);
            }else{
                echo "File Not Deleted / Invalid file path";
            }
        }
        
        
        
        function deleteMediaData($id = '' , $module = '', $form_field = '' , $user ='' ,$page = ''){
            $condition = ' WHERE 1 ';
            if($id != ''){
                $condition .= " AND `media_id` = '".$id."'";
            }
            if($user == ''){
                $user = $_SESSION["ses_user_id"];
                $condition .= " AND `user` = '".$user."'";
            }
            if($module != ''){
                $condition .= " AND `module` = '".$module."'";
            }
            if($form_field != ''){
                $condition .= " AND `form_field` = '".$form_field."'";
            } 
            if($page != ''){
                $condition .= " AND `page` = '".$page."'";
            } 
            
            
            $sql = "DELETE FROM `tr_media`".$condition;
            $res = mysql_query($sql);
            if($res){
                return  true;
            }else{
                return false;
            }
        }

        function deleteAllFile( $path ){
            $files = glob($path); // get all file names
           
            foreach($files as $file){ // iterate files
              if(is_file($file))
                unlink($file); // delete file
            }
        }
        
        function getMailAssignData($user_id){
            $sql = mysql_query("SELECT * FROM tr_mail_assign WHERE client_id = '".$user_id."'");
            $res = mysql_fetch_object($sql);
            return $res;
        }
        
        




    function get_all_client($field = '' , $where = ''){
        
        $field = ($field != '')? $field : '*';
        
        $sql = "SELECT ".$field." FROM tr_users as u INNER JOIN tr_user_meta as um ON u.user_id=um.user_id WHERE user_role='4' ORDER BY u.user_name ASC";
        //echo $sql;
        $qrysql = mysql_query($sql) or die("Error: (" . mysql_errno() . ") " . mysql_error());
        
        return $qrysql;
    }
 function get_all_clientfetch($field = '' , $where = ''){
        
        $field = ($field != '')? $field : '*';
        
        $sql = "SELECT ".$field." FROM tr_users as u INNER JOIN tr_user_meta as um ON u.user_id=um.user_id WHERE user_role='4' ORDER BY u.user_fname ASC";
        //echo $sql;
        $qrysql = mysql_query($sql) or die("Error: (" . mysql_errno() . ") " . mysql_error());
        
        return $qrysql;
    }
    function get_all_admin_user($field = ''){

        $field = ($field != '')? $field : '*';

        $sql = "SELECT ".$field." FROM tr_users as u INNER JOIN tr_user_meta as um ON u.user_id=um.user_id WHERE user_role = '2' OR user_role = '3'  ORDER BY u.user_role DESC";

        $qrysql = mysql_query($sql) or die("Error: (" . mysql_errno() . ") " . mysql_error());
        
        return $qrysql;
    }
    function get_all_client_report($field = '' , $where = ''){
        
        $field = ($field != '')? $field : '*';
        
        $sql = "SELECT ".$field." FROM tr_users INNER JOIN tr_user_meta ON tr_user_meta.user_id = tr_users.user_id WHERE user_role='4' ORDER BY tr_users.user_fname ASC";
        $qrysql = mysql_query($sql) or die("Error: (" . mysql_errno() . ") " . mysql_error());
        
        return $qrysql;
    }
    function get_all_user_and_admin($field = '' , $where = ''){
        $field = ($field != '')? $field : '*';
        
        $sql = "SELECT ".$field." FROM tr_users WHERE user_role='3' OR user_role='2'";
        $qrysql = mysql_query($sql) or die("Error: (" . mysql_errno() . ") " . mysql_error());
        
        return $qrysql;
    }
        
    function getUserName($field = '' , $user_id = ''){

        if($user_id == ''){
        
        }
        $sql = "SELECT ".$field." FROM tr_users WHERE user_id='".$user_id."'";
        $qrysql = mysql_query($sql) or die("Error: (" . mysql_errno() . ") " . mysql_error());
        return $qrysql;
   }

   function create_folder_out($user_id){
        $dirPath = "uploads/" . $user_id;
        $dir_logo = $dirPath . '/logo';
        $dir_file = $dirPath . '/file';
        $dir_received = $dirPath . '/received';

        if (!is_dir($dirPath)) {
            mkdir($dirPath, 0755);
        }
        if (!is_dir($dir_logo)) {
                mkdir($dir_logo, 0755);
        }
        if (!is_dir($dir_file)) {
            mkdir($dir_file, 0755);
        }
        if (!is_dir($dir_received)) {
            mkdir($dir_received, 0755);
        }
   }
        

   function get_user_mail_id($id){
       $sql = "SELECT user_email FROM tr_users WHERE user_id='".$id."'";
       $qrysql = mysql_query($sql) or die("Error: (" . mysql_errno() . ") " . mysql_error());
       return $qrysql;
   }
        
   function update_media_table($media_id , $received_by){

       foreach ($media_id as $value) {
             $inssql = "UPDATE tr_media SET received = '".$received_by."'"
                        . ",". " modified = '".date('Y-m-d H:i:s')."'"
                        . "WHERE media_id='".$value."'";
                //echo $inssql;
                    $qrysql = mysql_query($inssql) or die("Error: (" . mysql_errno() . ") " . mysql_error());
       }
     
   }
   
   function getUserNameReceived($received_id){
        $sql = "SELECT um.user_cname FROM tr_users as u JOIN tr_user_meta as um ON u.user_id = um.user_id WHERE u.user_id IN(".$received_id.")";
        $qrysql = mysql_query($sql) or die("Error: (" . mysql_errno() . ") " . mysql_error());
        return $qrysql;
   }
        

function sanitize_title_with_dashes_tr( $title, $len = '',$raw_title = '', $context = 'display' ) {
    $title = strip_tags($title);
    // Preserve escaped octets.
    $title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
    // Remove percent signs that are not part of an octet.
    $title = str_replace('%', '', $title);
    // Restore octets.
    $title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);
        

    $title = strtolower($title);
    $title = preg_replace('/&.+?;/', '', $title); // kill entities
    $title = str_replace('.', '-', $title);

    $title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
    $title = preg_replace('/\s+/', '-', $title);
    $title = preg_replace('|-+|', '-', $title);
    $title = trim($title, '-');

    return $title;
}

    public function tracer_session_is_registered($variable) {
    if (PHP_VERSION < 4.3) {
      return session_is_registered($variable);
    } else {
      return isset($_SESSION) && array_key_exists($variable, $_SESSION);
    }
  }   
  
  public function tep_update_whos_online() {
      
        //global $customer_id;

        if ($this->tracer_session_is_registered('ses_user_id')) {

          $wo_customer_id = $_SESSION['ses_user_id'];

          $customer_query = mysql_query("select user_fname, user_lname from tr_users where user_id = '" . (int)$wo_customer_id . "'");
          $customer = mysql_fetch_array($customer_query);

          $wo_full_name = $customer['user_fname'] . ' ' . $customer['user_lname'];
        } 

        $wo_session_id = $this->get_session_id();
        $wo_ip_address = getenv('REMOTE_ADDR');
        $wo_last_page_url = getenv('REQUEST_URI');

        $current_time = time();
        $xx_mins_ago = ($current_time - 86400); //86400 = 1440 min X 60 sec (1 day before)

        mysql_query("delete from tr_audit_log where time_last_click < '" . $xx_mins_ago . "'");

        $stored_customer_query = mysql_query("select count(*) as count from tr_audit_log where session_id = '" . $wo_session_id . "'");
        $stored_customer = mysql_fetch_array($stored_customer_query);
          
        if ($stored_customer['count'] > 0) {

          mysql_query("update tr_audit_log set userid = '" . (int)$wo_customer_id . "', full_name = '" . mysql_real_escape_string($wo_full_name) . "', ip_address = '" . mysql_real_escape_string($wo_ip_address) . "', time_last_click = '" . mysql_real_escape_string($current_time) . "', last_page_url = '" . mysql_real_escape_string($wo_last_page_url) . "' where session_id = '" . mysql_real_escape_string($wo_session_id) . "'");
        }else{

          mysql_query("insert into tr_audit_log (userid, full_name, session_id, ip_address, time_entry, time_last_click, last_page_url) values ('" . (int)$wo_customer_id . "', '" . mysql_real_escape_string($wo_full_name) . "', '" . mysql_real_escape_string($wo_session_id) . "', '" . mysql_real_escape_string($wo_ip_address) . "', '" . mysql_real_escape_string($current_time) . "', '" . mysql_real_escape_string($current_time) . "', '" . mysql_real_escape_string($wo_last_page_url) . "')");
        }
  }
  
  public function get_session_id($sessid = '') {
    if (!empty($sessid)) {
      return session_id($sessid);
    } else {
      return session_id();
    }
  }
  
  
  public function tep_session_name($name = '') {
    if (!empty($name)) {
      return session_name($name);
    } else {
      return session_name();
    }
  }
      





}//Class end

?>
