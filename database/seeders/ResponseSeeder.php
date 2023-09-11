<?php

namespace Database\Seeders;

use App\Models\Response;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Response::factory([
            'first_id' => 2,
            'second_id' => 1,
            'confirm_first' => 1])->create();
        Response::factory([
            'first_id' => 3,
            'second_id' => 1,
            'confirm_first' => 1])->create();
        Response::factory([
            'first_id' => 4,
            'second_id' => 1,
            'confirm_first' => 1])->create();
        Response::factory([
            'first_id' => 5,
            'second_id' => 1,
            'confirm_first' => 1])->create();
        Response::factory([
            'first_id' => 6,
            'second_id' => 1,
            'confirm_first' => 1])->create();

    }
}
