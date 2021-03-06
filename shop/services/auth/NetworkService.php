<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.09.2021
 * Time: 21:28
 */

namespace shop\services\auth;


use shop\entities\User\User;
use shop\repositories\UserRepository;

class NetworkService
{
   private $users;

   public function __construct(UserRepository $users)
   {
       $this->users=$users;
   }
   public function auth($network,$identity)
   {
      if ($user=$this->users->findByNetworkIdentity($network,$identity)){
          return $user;
      }
      $user=User::signupByNetwork($network,$identity);
      $this->users->save($user);
      return $user;
   }
   public function attach($id,$network,$identity)
   {
       if ($this->users->findByNetworkIdentity($network,$identity)){
           throw new \DomainException('Network is already signed');
       }
       $user=$this->users->get($id);
       $user->attachNetwork($network,$identity);
       $this->users->save($user);
   }
}















