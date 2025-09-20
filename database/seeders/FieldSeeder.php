<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Field;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fields = [
            [
                'name' => 'Lapangan Futsal A',
                'location' => 'Jakarta Pusat',
                'type' => 'Futsal',
                'price_per_hour' => 50000,
            ],
            [
                'name' => 'Lapangan Basket B',
                'location' => 'Jakarta Selatan',
                'type' => 'Basket',
                'price_per_hour' => 75000,
            ],
            [
                'name' => 'Lapangan Badminton C',
                'location' => 'Jakarta Barat',
                'type' => 'Badminton',
                'price_per_hour' => 30000,
            ],
            [
                'name' => 'Lapangan Futsal D',
                'location' => 'Jakarta Utara',
                'type' => 'Futsal',
                'price_per_hour' => 60000,
            ],
            [
                'name' => 'Lapangan Tenis E',
                'location' => 'Jakarta Timur',
                'type' => 'Tenis',
                'price_per_hour' => 80000,
            ],
            [
                'name' => 'Lapangan Futsal F',
                'location' => 'Jakarta Pusat',
                'type' => 'Futsal',
                'price_per_hour' => 55000,
            ],
        ];

        foreach ($fields as $field) {
            Field::create($field);
        }
    }
}
