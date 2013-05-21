<?php
/**
 * Online user model
 */
class mdl_online_user extends Crud_Model
{
    var $idkey = 'id';
    var $table = 'clients';

    function update_and_get_ou()
    {
        $db = Db::getInstance();
        $session = Session::getInstance();
        $rem_adr = $_SERVER['REMOTE_ADDR'];
        $result = $db->run_query("SELECT * FROM clients WHERE remote_address = '$rem_adr'");
        $username = (isset($session->username))? $session->username : '';

        /*$whois = curl_init('http://www.ipgp.net/api/xml/'.$rem_adr);
        curl_setopt($whois, CURLOPT_RETURNTRANSFER, 1);
        $string = curl_exec($whois);
        curl_close($whois);
        var_dump($string); die;*/
        if(mysql_num_rows($result) == 0)
        {
            $db->run_query("INSERT INTO clients
                            (remote_address, user_data, dt)
                                VALUES
                            ('$rem_adr', '$username', NOW())
                           ");
        }
        elseif(mysql_num_rows($result) == 1)
        {
            $db->run_query("UPDATE clients
                            SET dt = NOW(), user_data='$username'
                            WHERE remote_address = '$rem_adr'
                           ");
        }
        // ou - online user
        $query = "SELECT COUNT(*) as cnt
                  FROM clients
                  WHERE dt>SUBTIME(NOW(),'0 0:05:0')
                 ";
        if(!$result_ou = $db->run_query($query))
        {
            $db->error_message($query);
        }
        $row = mysql_fetch_assoc($result_ou);
        return $row['cnt'];
    }
}