<?php

namespace App\Presenters;

use App\Forms\CommentFormFactory;
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

    /** @var RegistrationFormFactory @inject */
    public $registrationForm;

    /** @var SignFormFactory @inject */
    public $loginForm;

    public function createComponentRegistration() {
        return $this->registrationForm->create();
    }

    public function createComponentLogin() {
        return $this->loginForm->create();
    }

}
