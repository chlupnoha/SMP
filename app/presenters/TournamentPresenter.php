<?php

namespace App\Presenters;

use Nette;


class TournamentPresenter extends BasePresenter
{

    public function actionDetail($id){
        $this->template->id = $id;
    }

}
