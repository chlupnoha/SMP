<?php

namespace App\Model;

class TournamentRepository extends Repository {

    public function readTournament($id){
        return [
            'name' => 'Finished tournament',
        ];
    }

    public function readManyTournaments(){
        $a = [];
        for($i = 0; $i < 3; $i++){
            $f = [
                'name' => 'FINISH TOURNAMENT' . $i,
                'start' => 'Yesterday at 6:00 PM',
            ];
            $a[] = $f;
        }
        return $a;
    }



}
