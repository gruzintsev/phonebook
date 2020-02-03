<?php

namespace Tests\Feature;

use App\Contact;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;
use Illuminate\Support\Arr;

class ContactTest extends TestCase
{
    protected $token;
    protected $headers;
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:install');

        $payload = [
            'email' => 'gruzintsev@gmail.com',
            'password' => '1111',
            'name' => 'Vladimir',
            'c_password' => '1111',
        ];
        $response = $this->post(route('register'), $payload, [])
            ->assertStatus(JsonResponse::HTTP_OK)
        ;

        $this->token = $response->json('success.token');
        $this->headers = ['Authorization' => 'Bearer ' . $this->token];
    }

    public function testsContactsAreCreatedCorrectly()
    {
        $data = [
            'first_name' => 'Vladimir',
            'phone_number' => '+79298450000',
            'country_code' => 'RU',
        ];

        $this->post(route('contacts.store'), $data, $this->headers)
            ->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(Arr::add($data, 'id', 1));
    }

    public function testsIncorrectDataForCreate()
    {
        $data = [
            'first_name' => 'Vladimir',
        ];

        $this->post(route('contacts.store'), $data, $this->headers)
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['phone_number' => 'Phone number is required']);

        $data = [
            'phone_number' => '+79298450000',
        ];

        $this->post(route('contacts.store'), $data, $this->headers)
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['first_name' => 'First name is required']);

        $data = [
            'first_name' => 'Oleg',
            'phone_number' => 'not number',
        ];

        $this->post(route('contacts.store'), $data, $this->headers)
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['phone_number' => 'Phone number must be valid number']);

        $data = [
            'first_name' => 'Oleg',
            'phone_number' => 'not number',
            'country_code' => 'sdf',
        ];

        $this->post(route('contacts.store'), $data, $this->headers)
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['country_code' => 'Country code is invalid']);

        $data = [
            'first_name' => 'Oleg',
            'phone_number' => 'not number',
            'country_code' => 'RU',
            'timezone' => 'as',
        ];

        $this->post(route('contacts.store'), $data, $this->headers)
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['timezone' => 'Timezone is invalid']);
    }

    public function testsContactsAreUpdatedCorrectly()
    {
        $contact = factory(Contact::class)->create([
            'first_name' => 'Vladimir',
            'phone_number' => '+79298450000',
        ]);

        $contact2 = factory(Contact::class)->create([
            'first_name' => 'Natalia',
            'phone_number' => '+79298450001',
        ]);

        $data = [
            'first_name' => 'Nat',
            'phone_number' => '+79290000002',
        ];

        $this->put(route('contacts.update', $contact2->id), $data, $this->headers)
            ->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(Arr::add($data, 'id', 2));
    }

    public function testsContactsAreDeletedCorrectly()
    {
        $contact = factory(Contact::class)->create([
            'first_name' => 'Vladimir',
            'phone_number' => '+79290000000',
        ]);

        $this->delete(route('contacts.delete', $contact->id), [], $this->headers)
            ->assertStatus(204);
    }

    public function testContacts()
    {
        $firstContact = [
            'first_name' => 'Vladimir',
            'phone_number' => '+79290000000',
        ];
        $secondContact = [
            'first_name' => 'Natalia',
            'phone_number' => '+79290000001',
        ];
        factory(Contact::class)->create($firstContact);
        factory(Contact::class)->create($secondContact);

        $this->get(route('contacts.index'), $this->headers)
            ->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(['data' => [$firstContact, $secondContact]])
            ;
    }

    public function testContactsSearch()
    {
        $firstContact = [
            'first_name' => 'Vladimir',
            'phone_number' => '+79290000000',
        ];
        $secondContact = [
            'first_name' => 'Natalia',
            'last_name' => 'Gruzintseva',
            'phone_number' => '+79290000001',
        ];
        factory(Contact::class)->create($firstContact);
        factory(Contact::class)->create($secondContact);

        $searchedText = 'vlad';
        $this->get(route('contacts.search', $searchedText), $this->headers)
            ->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson([$firstContact])
            ->assertJsonStructure([
                '*' => ['id', 'first_name', 'last_name', 'created_at', 'updated_at'],
            ]);
        ;

        $searchedText = 'gruz';
        $this->get(route('contacts.search', $searchedText), $this->headers)
            ->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson([$secondContact])
            ->assertJsonStructure([
                '*' => ['id', 'first_name', 'last_name', 'created_at', 'updated_at'],
            ]);
        ;
    }

    public function testContactsPagination()
    {
        $firstContact = [
            'first_name' => 'Vladimir',
            'phone_number' => '+79290000000',
        ];
        $secondContact = [
            'first_name' => 'Natalia',
            'phone_number' => '+79290000001',
        ];
        factory(Contact::class)->create($firstContact);
        factory(Contact::class)->create($secondContact);

        $this->get(route('contacts.index', [
            'page' => 1,
            'limit' => 1,
        ]), $this->headers)
            ->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(['data' => [$firstContact]]);

        $this->get(route('contacts.index', [
            'page' => 2,
            'limit' => 1,
        ]), $this->headers)
            ->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(['data' => [$secondContact]]);
    }

    public function testUserCantAccessContactsWithWrongToken()
    {
        $badToken = 'wfwefwef';
        $headers = ['Authorization' => 'Bearer ' . $badToken];

        $this->getJson(route('contacts.index'), $headers)->assertStatus(401);
    }

    public function testUserCantAccessContactsWithoutToken()
    {
        $this->getJson(route('contacts.index'))->assertStatus(401);
    }
}
