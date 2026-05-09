<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::create([
            'name' => 'Main Branch',
            'address' => '123 Main Street, Lagos, Nigeria',
            'phone' => '+2341234567890',
            'email' => 'main@vixprodelivery.com',
        ]);

        Branch::create([
            'name' => 'West Branch',
            'address' => '456 West Avenue, Abuja, Nigeria',
            'phone' => '+2341234567891',
            'email' => 'west@vixprodelivery.com',
        ]);

        Branch::create([
            'name' => 'East Branch',
            'address' => '789 East Road, Port Harcourt, Nigeria',
            'phone' => '+2341234567892',
            'email' => 'east@vixprodelivery.com',
        ]);
    }
}
