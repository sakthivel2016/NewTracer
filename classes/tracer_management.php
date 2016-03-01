<?php
class tracer_management {
    
    function __construct(){
        //define('MESSAGE1', 'click OK to continue where you left off or click CANCEL to revert to the First page of the form' ); 
        define('MESSAGE1', 'We noticed you had previously begun updating the DCF.\nWould you like to continue where you left off?\nClick OK to be taken to the section last updated, or click Cancel to be taken to the beginning.' ); 
        define('MESSAGE_IF', 'We noticed you had previously begun updating the IF.\nWould you like to continue where you left off?\nClick OK to be taken to the section last updated, or click Cancel to be taken to the beginning.' ); 
    }
    
        
    /**
     * @highlight words
     *
     * @param string $text
     *
     * @param string $words
     *
     * @param string $colors
     *
     * @return string
     *
     */
	 
    function highlightWords($text, $words, $colors = 'yellow') {
        if ($words != '') {
            $find = preg_quote(strtolower($words));
            $rep = "<span style='background-color: " . $colors . ";'>" . $find . "</span>";
            $text = strtr($text, array($find => $rep));
        }
        /*         * * return the text ** */
        return $text;
    }//end
    
    function getMailAssignData($user_id){
            $sql = mysql_query("SELECT * FROM tr_mail_assign WHERE client_id = '".$user_id."'");
            $res = mysql_fetch_object($sql);
            return $res;
    }
   function getUserName($field = '' , $user_id = ''){

        if($user_id == ''){
        
        }
        $sql = "SELECT ".$field." FROM tr_users WHERE user_id='".$user_id."'";
        $qrysql = mysql_query($sql) or die("Error: (" . mysql_errno() . ") " . mysql_error());
        return $qrysql;
   }
    function percentage($page_start ,$total_page,$data , $flag = true) {
            $k = $page_start;
            $j = 0;
            
            //print_t($data);
            foreach ($data as $keys => $values) {
                foreach ($values as $key => $value) {
                    $sk = 'page' . $k;

                    if ($key == $sk) {

                        $page = unserialize(urldecode($value));

                        foreach ($page as $pkey => $pvalue) {
                            if (trim($pvalue) != '') {
                                $j++;
                                break;
                            }
                        }

                        $k++;
                    }
                }
            }
            
            if($flag){
                $percent = intval($j / $total_page * 100);
            }else{
                $percent = $j;
            }
            
            return $percent;
    }//single_table
    
    function page_index($name){
        $sql        = "SELECT option_value as inx FROM tr_options WHERE user_id='".$user_id."' AND option_name ='".$name."'";
//echo $sql;
        $res_sql    = mysql_query($sql) or die("Error: (" . mysql_errno() . ") " . mysql_error());
        
        return $res_sql;
    }
    function page_index_RA_Template($name, $userid){
        $sql        = "SELECT option_value as inx FROM tr_options WHERE user_id='".$userid."' AND option_name ='".$name."'";
//echo $sql;
        $res_sql    = mysql_query($sql) or die("Error: (" . mysql_errno() . ") " . mysql_error());
        
        return $res_sql;
    }
	
		
		function get_client_user($field = '' , $where = ''){
        
        $field = ($field != '')? $field : '*';
        
        $sql = "SELECT ".$field." FROM tr_users INNER JOIN tr_user_meta ON tr_user_meta.user_id = tr_users.user_id WHERE tr_users.user_id IN (".$_SESSION['ses_multi_id'].") ORDER BY `tr_users`.`user_fname` ASC";
        $qrysql = mysql_query($sql) or die("Error: (" . mysql_errno() . ") " . mysql_error());
        
        return $qrysql;
    }



//End
}//End Class