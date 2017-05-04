<?php

namespace App\Forms;

use App\Model\UserRepository;
use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;
use Tomaj\Form\Renderer\BootstrapRenderer;


class RegistrationFormFactory extends Nette\Object {

    /** @var FormFactory */
    private $factory;

    function __construct(FormFactory $factory) {
        $this->factory = $factory;
    }

    /**
     * @return Form
     */
    public function create() {
        $form = $this->factory->create();

        $form->setRenderer(new BootstrapRenderer);

        $form->addText('email', 'Email')
             ->setAttribute('class', 'form-control')
             ->setAttribute('placeholder', 'Your email')
             ->addRule(Form::EMAIL, 'Set valid email')
             ->setRequired();

        $form->addText('nick', 'Nickname')
             ->setAttribute('class', 'form-control')
             ->setAttribute('placeholder', 'Your nickname')
             ->addRule(Form::MAX_LENGTH, 'Max lenght is $d.', 30)
             ->setRequired();

        $form->addPassword('password', 'Password')
             ->setAttribute('class', 'form-control')
             ->setAttribute('placeholder', 'Your password')
             ->addRule(Form::MIN_LENGTH, 'Password must have atleast %d chars.', 6)
             ->setRequired();

        $form->addPassword('passwordVerify', 'Password')
             ->setAttribute('class', 'form-control')
             ->setAttribute('placeholder', 'Your password again')
             ->addRule(Form::EQUAL, 'Passwords are not the same', $form['password'])
             ->setRequired();

        $form->addSubmit('submit', 'Sign up')
             ->setAttribute('class', 'btn btn-primary btn-reverse ajax');

        $form->onSuccess[] = [$this, 'formSucceeded'];

        return $form;
    }


    public function formSucceeded(Form $form, $values) {
        $form->getPresenter(TRUE)->flashMessage("You have successfully registered. Please check your email to verify you account.");
        $form->getPresenter(true)->redirect('Homepage:default');
    }

}
