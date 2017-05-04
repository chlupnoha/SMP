<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use App\Model\WatchRepository;
use Tomaj\Form\Renderer\BootstrapRenderer;

class WatchFormFactory extends Nette\Object{

    /** @var FormFactory */
    private $factory;

    /** @var WatchRepository */
    private $watch;

    function __construct( FormFactory $factory) {
        $this->factory = $factory;
    }

        /**
     * @return Form
     */
    public function create() {
        $form = $this->factory->create();

        $form->addText( 'name', 'Name' )
                ->setRequired();
        
        $form->addText( 'channel', 'Channel name' )
                ->setRequired();

        $form->addSubmit( 'submit', 'Submit' );

        $form->setRenderer(new BootstrapRenderer());

        $form->onSuccess[] = array($this, 'formSucceeded');
        return $form;
    }

    public function formSucceeded( Form $form, $values ) {
        $form->getPresenter(TRUE)->flashMessage("You watch has been created.");
        $form->getPresenter(true)->redirect('Homepage:default');
    }

}
