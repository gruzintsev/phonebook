<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use App\Contact;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->truncate();

        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            Contact::create([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName,
                'phone_number' => $faker->phoneNumber,
                'country_code' => $faker->countryCode,
                'timezone' => $faker->timezone,
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }
    }
}
