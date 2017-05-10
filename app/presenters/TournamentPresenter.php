<?php

namespace App\Presenters;

use App\Model\TournamentRepository;
use App\Model\UserRepository;
use Nette;


class TournamentPresenter extends BasePresenter
{

    /** @var TournamentRepository @inject */
    public $tournament;

    /** @var UserRepository @inject */
    public $userRepo;

    public function actionDetail($id){
        $this->template->id = $id;
        $this->template->tournament = $this->tournament->readTournament($id);
        $this->template->users = $this->userRepo->generateUsers();
    }

}
