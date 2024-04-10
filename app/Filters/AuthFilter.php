<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    $config = config('SystemWeb');
    if(session()->get('usertbl')){

      if(isset($arguments[0]) && $arguments[0] != null ){
        if(in_array('admin', $arguments)){
          if(!in_array($decoded->user->username, $config->admin)){
            return redirect()->to('/login');
          }
        }
      }
    }
    else{
      
      return redirect()->to('/login');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
      // Do something here
  }
}