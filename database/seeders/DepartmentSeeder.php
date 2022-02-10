<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Department::create(['name' => 'General Manager Department']);
        Department::create(['name' => 'Ict Department']);
        Department::create(['name' => 'Construction Supervision Department']);
        Department::create(['name' => 'Geotechnical Engineering Department']);
        Department::create(['name' => 'Design Projects Department']);
        Department::create(['name' => 'Contract Formulation Department']);
        Department::create(['name' => 'Human Resource Department']);
        Department::create(['name' => 'Property Administration Department']);
        Department::create(['name' => 'Finance Department']);
    }
}
