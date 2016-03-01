<?php
class PasswordCheck {
	var $conn;
	var $db;
	
	function PasswordCheck()
	{
                /* $this->conn = mysql_connect('localhost','root','');
                $this->db = mysql_select_db('hipaa_portal',$this->conn);*/

                $this->conn = mysql_connect('localhost','root','');
                $this->db  = mysql_select_db('tracer',$this->conn);
          
	}

        function CheckAdmin(){
            
                $this->PasswordCheck();
                $admin_fetch=mysql_query("SELECT admin_id, admin_user, admin_pass FROM administrator");
                $admin_row = mysql_fetch_assoc($admin_fetch);
                return $admin_credentials = array('userad' => $admin_row['admin_user'], 'passw' => $admin_row['admin_pass'], 'adminlg' => 1);
        }
	function CheckPassword($post_pass, $stored_pass)
	{
		if ($post_pass == $stored_pass){
                    return true;
                }else{
                    return false;
                }
			
	}
      function CheckCustomer($email, $numrows){
                                       
             $this->PasswordCheck();
            
             $fetch_cust=mysql_query('SELECT customers_email_address, customers_password, customers_id FROM customers WHERE customers_email_address = "'.$email.'"');
            if($numrows == 1){
               
                return mysql_num_rows($fetch_cust);
                
            }else if($numrows == 2){
               
               return $result = mysql_fetch_assoc($fetch_cust);
               
                
            }
            
       
        }
       
}

?>
