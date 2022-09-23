<?php

use Illuminate\Database\Seeder;
use App\Person;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $people = [
            [
                'NIK' => '3327072109990004',
                'name' => 'Syaiful kirom'
            ],
            [
                'NIK' => '3327030808940010',
                'name' => 'tofik'
            ],
            [
                'NIK' => '3327074202970024',
                'name' => 'Yuyun Farida'
            ],
            [
                'NIK' => '3327070610180001',
                'name' => 'Rafael Malik Ahmad'
            ],
            [
                'NIK' => '3327071904080001',
                'name' => 'Finza Bagas Pratama'
            ],
            [
                'NIK' => '3327011806920005',
                'name' => 'Abu Bakar Sidik'
            ],
            [
                'NIK' => '3327074305940021',
                'name' => 'Tri Maelani'
            ],
            [
                'NIK' => '3327075007160006',
                'name' => 'Shakila Zahra Assidik'
            ],
            [
                'NIK' => '3327071402820028',
                'name' => 'Tasirun'
            ],
        ];

        foreach ($people as $person) {
            Person::create($person);
        }
    }
}
