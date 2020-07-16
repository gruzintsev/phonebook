<?php

namespace App\Services;

use App\Contact;

class ContactService
{
    public function paginated($limit)
    {
        return Contact::paginate($limit)->toArray();
    }
    public function search(string $query)
    {
        return Contact::orWhereLike(['first_name', 'last_name'], $query)->get();
    }

    public function create(array $data)
    {
        return Contact::create($data);
    }

    public function update(Contact $contact, array $data)
    {
        $contact->update($data);
    }

    public function delete(Contact $contact)
    {
        $contact->delete();
    }
}
