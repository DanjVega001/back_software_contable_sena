<?php

namespace App\Repositories;

use App\Models\RepresentanteLegal;

class RepresentanteLegalRepository 
{
    public function saveLegalRepresentative(array $data) : void
    {
        $legalRepresentative = new RepresentanteLegal($data);
        $legalRepresentative->save();
    }

    public function updateLegalRepresentative(RepresentanteLegal $legalRepresentative, array $data) : void
    {
        $legalRepresentative->update($data);
    }

    public function deleteLegalRepresentative(RepresentanteLegal $legalRepresentative) : void
    {
        $legalRepresentative->delete();
    }

}
