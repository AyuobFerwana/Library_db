<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PublisherSeeder extends Seeder
{
    protected static ?string $password;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Publisher::create([
            'name' => 'Super Publisher',
            'email' => 'publisher@library.com',
            'password' => static::$password ??= Hash::make('password'),
        ]);
    }
}
