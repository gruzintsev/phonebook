<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactCreateRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Services\ContactService;
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

        return app(ContactService::class)->paginated($limit);
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
        return app(ContactService::class)->search($query);
    }

    /**
     * @param ContactCreateRequest $request
     * @return JsonResponse
     */
    public function store(ContactCreateRequest $request)
    {
        $contact = app(ContactService::class)->create($request->all());

        return response()->json($contact);
    }

    /**
     * @param ContactUpdateRequest $request
     * @param Contact $contact
     * @return JsonResponse
     */
    public function update(ContactUpdateRequest $request, Contact $contact)
    {
        app(ContactService::class)->update($contact, $request->all());

        return response()->json($contact);
    }

    /**
     * @param Contact $contact
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(Contact $contact)
    {
        app(ContactService::class)->delete($contact);

        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
