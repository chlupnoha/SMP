<?php

namespace App\Forms;

use App\Model\ImageRepository;
use App\Model\StateRepository;
use App\Model\UserRepository;
use App\Service\ImageService;
use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;
use Tomaj\Form\Renderer\BootstrapRenderer;

class UserFormFactory extends Nette\Object{

    /** @var FormFactory */
    private $factory;

    function __construct( FormFactory $factory) {
        $this->factory = $factory;
    }

        /**
     * @return Form
     */
    public function create() {
        $form = $this->factory->create();

        $form->addText( 'hearthstone_id', 'Hearthstone #' )
                ->setAttribute( 'class', 'form-control' )
                ->setRequired();

        $form->addText( 'birthday', 'Birthday' )
                ->setAttribute( 'class', 'form-control datepicker' )
                ->setRequired();

        $form->addSelect( 'state_id', 'State', [] )
                ->setAttribute( 'class', 'selectpicker' )
                ->setPrompt( 'Select state' )
                ->setRequired();

        $form->addText( 'fullname', 'Fullname' )
                ->setAttribute( 'class', 'form-control' );

        $form->addUpload( 'image', 'Avatar' )
                ->setAttribute( 'class', 'form-control' )
                ->addCondition(Form::FILLED)
                    ->addRule(Form::IMAGE, 'Avatar have to be, PNG or GIF.')
                    ->addRule(Form::MAX_FILE_SIZE, 'Max size is 1MB.', 1024 * 1024 /* v bytech */);

        $form->addSubmit( 'send', 'Submit' )
                ->setAttribute( 'class', 'btn btn-primary btn-reverse' );

        $form->setRenderer(new BootstrapRenderer());

        $form->onSuccess = [];
        $form->onSuccess[] = $this->formSucceeded;

        return $form;
    }

    public function formSucceeded( Form $form, $values ) {
        $form->getPresenter(TRUE)->flashMessage("You have successfully edit your data.");
        $form->getPresenter(true)->redirect('Homepage:default');
    }

}
