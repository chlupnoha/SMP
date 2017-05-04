<?php

namespace App\Forms;

use App\Model\Game_typeRepository;
use App\Model\RuleRepository;
use App\Model\Tournament_elimination_typeRepository;
use App\Model\TournamentRepository;
use App\Service\TournamentService;
use Nette;
use Nette\Application\UI\Form;
use Tomaj\Form\Renderer\BootstrapRenderer;

class TournamentFormFactory extends Nette\Object {

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

        $form->addSelect('game_type_id', 'Game', ['hs, cs'])
             ->setPrompt('Select a game')
             ->setRequired();

        $form->addText('name', 'Tournament name')
             ->setRequired();

        $form->addText('start', 'Start')
             ->setAttribute('class', 'datetimepicker')
             ->setAttribute('id', 'datetimepicker1')
             ->setRequired();

        $form->addText('registration_start', 'Registration start')
             ->setAttribute('class', 'datetimepicker')
             ->setAttribute('id', 'datetimepicker2')
             ->setRequired();

        $powsOfTow = [];
        $powOfTwo = 1;
        for ($i = 0; $i < 8; $i++) {
            $powOfTwo *= 2;
            $powsOfTow[$powOfTwo] = $powOfTwo;
        }
        $form->addSelect('participants_max', 'Participant max', $powsOfTow);

        $yesNo = [1 => 'No', 0 => 'Yes'];
        $form->addSelect('skip_consolation_round', '3rd place', $yesNo);

        $r = range(1,3);
        $form->addSelect('required_wins', 'Required wins', array_combine($r,$r))
             ->setPrompt('Select required wins')
             ->setRequired();

        $r = range(0,3);
        $form->addSelect('ban_count', 'Ban count', array_combine($r,$r))
             ->setPrompt('Select ban count')
             ->setRequired();

        $r = range(1,4);
        $form->addSelect('deck_count', 'Deck count', array_combine($r,$r))
             ->setPrompt('Select deck count')
             ->setRequired();

        $form->addTextArea('description', "Description")
             ->setAttribute('class', 'mceEditor');

        $form->addSubmit('submit', 'Submit');

        $form->setRenderer(new BootstrapRenderer());

        $form->onSuccess[] = [$this, 'formSucceeded'];

        return $form;
    }

    public function formSucceeded(Form $form, $values) {
        $form->getPresenter(TRUE)->flashMessage("You tournament has been created.");
        $form->getPresenter(true)->redirect('Homepage:default');
    }

}
