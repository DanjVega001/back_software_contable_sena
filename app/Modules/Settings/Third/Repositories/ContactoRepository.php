<?php

namespace App\Modules\Settings\Third\Repositories;

use App\Modules\Settings\Third\Models\Contacto;

class ContactoRepository
{

    public function saveContact(array $data) : void
    {
        $contact = new Contacto($data);
        $contact->save();
    }

    public function find($id) : ?Contacto
    {
        return Contacto::find($id);
    }

    public function updateContact(Contacto $contact, array $data) : void
    {
        $contact->update($data);
    }
}
