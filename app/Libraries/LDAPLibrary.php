<?php 
namespace App\Libraries;

class LDAPLibrary
{
  private $host = 'ldap://192.168.100.3';
  private $admin_user = 'it.onlb';
  private $admin_pass = '6bec082c10';
  private $ldap;

  private function connect(){
    try {
      $this->ldap = ldap_connect($this->host);
      ldap_set_option($this->ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
      return $this->ldap;
    } catch (\Exception $e) {
      return false;
    }
  }
  private function bind($dn, $password){
    try {
      $this->connect();
      return ldap_bind($this->ldap, $dn, $password) or die('bind died');
    } catch (\Exception $e) {
      return ["error" => $e->getMessage()];
    }
  }
  
  private function bindAdmin(){
    try {
      $dn = "cn=".$this->admin_user.",cn=Users,dc=onlb,dc=local";
      $bind = $this->bind($dn, $this->admin_pass);
      if($bind === true){
        return true;
      }
      else if(isset($bind["error"])){
        return ["error" => $bind["error"]];
      }
      else{
        return ["error" => 'not true not error'];
      }
    } catch (\Exception $e) {
      return ["error" => $e->getMessage()];
    }
  }

  private function searchUser(array $search){
    $bindAdmin = $this->bindAdmin();
    if($bindAdmin !== true){
      $return = [
        "error" => "error bind admin",
        "bindAdmin" => $bindAdmin,
      ];
      return $return;
    }

    $searchStr = '';
    foreach ($search as $key => $value) {
      $searchStr.= "($key=$value)";
    }
    try {
      $attribute = ['description','displayname','mail','dn','samaccountname'];
      $dn = 'OU=ONLB-User,DC=onlb,DC=local';
      $ldap_search = ldap_search($this->ldap, $dn, "(&(objectClass=person)$searchStr)", $attribute);
      $count = ldap_count_entries($this->ldap, $ldap_search);
      $entries = ldap_get_entries($this->ldap, $ldap_search);

      $users = array();
      for ($i=0; $i < $count; $i++) {
        $users[] = [
          'id' => $entries[$i]['description'][0] ?? null,
          'username' => $entries[$i]['samaccountname'][0] ? strtolower($entries[$i]['samaccountname'][0]) : null,
          'name' => $entries[$i]['displayname'][0] ?? null,
          'mail' => $entries[$i]['mail'][0] ?? null,
          'dn' => $entries[$i]['dn'] ?? null,
        ];
      }
      return [
        'count' => $count,
        'users' => $users,
      ];
    } catch (\Exception $e){
      return ["error" => $e->getMessage()];
    }
  }

  public function login($username, $password){
    try {
      $search = [
        'sAMAccountName' => $username,
      ];
      $searchUser = $this->searchUser($search);
      if(!isset($searchUser["count"]) || !isset($searchUser["users"])){
        return ["error" => 'not found count or users', "searchUser" => $searchUser];
      }
      else{
        if($searchUser['count'] == 1){
          if(isset($searchUser['users'][0]['dn'])){
            $user = $searchUser['users'][0];
          }
          else{
            return ["error" => 'not found dn'];
          }
        }
        else if($searchUser['count'] == 0){
          return ["error" => 'not found sAM'];
        }
        else{
          return ["error" => 'so many sAM ('.$searchUser['count'].')'];
        }
      }

      $bind = $this->bind($user['dn'], $password);
      if($bind === true){
        return ["user" => $user];
      }
      else{
        return ["error" => "user wrong password"];
      }
    } catch (\Exception $e) {
      return ["error" => $e->getMessage()];
    }
  }

  public function searchOR($search, $limit=0){
    $bindAdmin = $this->bindAdmin();
    if($bindAdmin !== true){
      $return = [
        "error" => "error bind admin",
        "bindAdmin" => $bindAdmin,
      ];
      return $return;
    }

    $searchStr = '';
    try {
      $attribute = ['description','displayname','mail','dn','samaccountname'];
      foreach ($attribute as $value) {
        $searchStr.= "(".$value."=*".$search."*)";
      }
      $dn = 'OU=ONLB-User,DC=onlb,DC=local';
      $ldap_search = ldap_search($this->ldap, $dn, "(&(objectClass=person)(|".$searchStr."))", $attribute);
      $count = ldap_count_entries($this->ldap, $ldap_search);
      $entries = ldap_get_entries($this->ldap, $ldap_search);

      $users = array();
      for ($i=0; $i < $count; $i++) {
        if($limit != 0 && $limit == $i){
          break;
        }
        
        $users[] = [
          'id' => $entries[$i]['description'][0] ?? null,
          'username' => $entries[$i]['samaccountname'][0] ? strtolower($entries[$i]['samaccountname'][0]) : null,
          'name' => $entries[$i]['displayname'][0] ?? null,
          'mail' => $entries[$i]['mail'][0] ?? null,
          'dn' => $entries[$i]['dn'] ?? null,
        ];
      }
      return [
        'count' => $count,
        'users' => $users,
      ];
    } catch (\Exception $e){
      return ["error" => $e->getMessage()];
    }
  }
} 