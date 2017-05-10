<?php

namespace App\Presenters;

use Nette;
use App\Model\TournamentRepository;


class HomepagePresenter extends BasePresenter
{

    /** @var TournamentRepository @inject */
    public $tournament;

    public function actionDefault(){
        $this->template->tournaments = $this->tournament->readManyTournaments();
    }


}
