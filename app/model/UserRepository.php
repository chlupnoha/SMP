<?php

namespace App\Model;

use Nette\Security\Passwords;

/**
 * Users management.
 */
class UserRepository extends Repository {

    public function generateUsers(){
        $a = [];
        for($i = 0; $i < 3; $i++){
             $a[] = [
                'name' => 'name' . $i,
                'check' => 'Checked in',
                'in' => 'In tournament',
            ];
        }
        return $a;
    }

}
