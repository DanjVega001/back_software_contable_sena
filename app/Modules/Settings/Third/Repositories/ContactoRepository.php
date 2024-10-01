<?php

namespace App\Modules\Settings\Third\Repositories;

use App\Modules\Settings\Third\Models\Contacto;

class ContactoRepository
{

    public function saveContact(array $data) : void
    {
        $contact = new Contacto($data);
    }
}
