<?php

namespace App\AdminModule\Presenters;

use App\Forms\CommentFormFactory;
use App\Forms\TournamentFormFactory;
use App\Forms\WatchFormFactory;
use App\Model\Match_result_imageRepository;
use App\Model\MatchRepository;
use App\Model\Slideshow_game_typeRepository;
use App\Model\TeamRepository;
use App\Service\MatchService;
use Nette;
use App\Forms\SignFormFactory;
use App\Forms\RegistrationFormFactory;
use App\Forms\RecoveryFormFactory;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter {

    /** @var TournamentFormFactory @inject */
    public $tournamentForm;

    /** @var WatchFormFactory @inject */
    public $watchForm;

    public function createComponentTournament() {
        return $this->tournamentForm->create();
    }

    public function createComponentWatch() {
        return $this->watchForm->create();
    }

}
