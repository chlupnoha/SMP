<?php

namespace App\Forms;

use App\Model\UserNotVerifiedException;
use App\Service\UserService;
use Nette;
use Nette\Application\LinkGenerator;
use Nette\Application\UI\Form;
use Nette\Security\User;
use Tomaj\Form\Renderer\BootstrapRenderer;

class SignFormFactory extends Nette\Object {

    /** @var FormFactory */
    private $factory;

    public function __construct(FormFactory $factory) {
        $this->factory = $factory;
    }

    /**
     * @return Form
     */
    public function create() {
        $form = $this->factory->create();

        $form->setRenderer(new BootstrapRenderer());

        $form->addText('email', 'Email:')
             ->setAttribute('class', 'form-control')
             ->setAttribute('placeholder', 'Email or username')
             ->setRequired();

        $form->addPassword('password', 'Password:')
             ->setAttribute('class', 'form-control')
             ->setAttribute('placeholder', 'Password')
             ->setRequired();

        $form->addSubmit('submit', 'Login')
             ->setAttribute('class', 'btn btn-primary btn-reverse');

        $form->onSuccess[] = [$this, 'formSucceeded'];

        return $form;
    }

    public function formSucceeded(Form $form, $values) {
        $form->getPresenter(TRUE)->flashMessage("You have successfully login.");
        $form->getPresenter(true)->redirect('Homepage:default');
    }

}
