<?php

namespace App\Presenters;

use App\Forms\UserFormFactory;
use Nette;


class UserPresenter extends BasePresenter
{

    /** @var UserFormFactory @inject */
    public $userForm;

    public function createComponentUserForm() {
        return $this->userForm->create();
    }

}
