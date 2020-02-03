<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactCreateRequest;
use App\Http\Requests\ContactUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\Paginator;

class ContactController extends Controller
{
    /**
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function index($page = 1, $limit = 10)
    {
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        return Contact::paginate($limit)->toArray();
    }

    /**
     * @param Contact $contact
     * @return Contact
     */
    public function show(Contact $contact)
    {
        return $contact;
    }

    /**
     * @param string $query
     * @return mixed
     */
    public function search(string $query)
    {
        $contact = Contact::orWhereLike(['first_name', 'last_name'], $query)->get();

        return $contact;
    }

    /**
     * @param ContactCreateRequest $request
     * @return JsonResponse
     */
    public function store(ContactCreateRequest $request)
    {
        $contact = Contact::create($request->all());

        return response()->json($contact);
    }

    /**
     * @param ContactUpdateRequest $request
     * @param Contact $contact
     * @return JsonResponse
     */
    public function update(ContactUpdateRequest $request, Contact $contact)
    {
        $contact->update($request->all());

        return response()->json($contact);
    }

    /**
     * @param Contact $contact
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(Contact $contact)
    {
        $contact->delete();

        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
