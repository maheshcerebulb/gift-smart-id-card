<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Hash;
use Carbon\Carbon;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin@123'),
            'unit_category' => 'Developer',
            'company_name' => 'Cerebulb',
            'constitution_of_business' => 'Private Limited',
            'company_registration_number' => '1234',
            'request_number' => '1234',
            'company_address' => 'Hiranandani',
            'company_city' => 'Gandhinagar',
            'company_state' => 'Gujarat',
            'company_country' => 'India',
            'company_pin_code' => '12345',
            'pan_number' => '1234567',
            'authorized_person_first_name' => 'Company',
            'authorized_person_last_name' => 'Director',
            'authorized_person_gender' => 'Female',
            'authorized_person_mobile_number' => '1234567890',
            'authorized_person_designation' => 'CTO',
            'authorized_person_mobile_number_2' => '1234567890',
            'authorized_person_support_document' => '',
            'application_number' => '',
            'is_active' => 'Y',
            'is_deleted' => 'N',
            'first_time_login' => 'N',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $role = Role::where(['name' => 'Admin'])->first();
        $user->assignRole([$role->id]);


        $user1 = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('admin@123'),
            'unit_category' => 'Developer',
            'company_name' => 'Cerebulb',
            'constitution_of_business' => 'Private Limited',
            'company_registration_number' => '1234',
            'request_number' => '1234',
            'company_address' => 'Hiranandani',
            'company_city' => 'Gandhinagar',
            'company_state' => 'Gujarat',
            'company_country' => 'India',
            'company_pin_code' => '12345',
            'pan_number' => '1234567',
            'authorized_person_first_name' => 'Company',
            'authorized_person_last_name' => 'Director',
            'authorized_person_gender' => 'Female',
            'authorized_person_mobile_number' => '1234567890',
            'authorized_person_designation' => 'CTO',
            'authorized_person_mobile_number_2' => '1234567890',
            'authorized_person_support_document' => '',
            'application_number' => '',
            'is_active' => 'Y',
            'is_deleted' => 'N',
            'first_time_login' => 'N',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $role1 = Role::where(['name' => 'Super Admin'])->first();
        $user1->assignRole([$role1->id]);

        $user = User::create([
            'name' => 'Data Entry',
            'email' => 'dataentryadmin@gmail.com',
            'password' => bcrypt('admin@123'),
            'unit_category' => 'Developer',
            'company_name' => 'Cerebulb',
            'constitution_of_business' => 'Private Limited',
            'company_registration_number' => '1234',
            'request_number' => '1234',
            'company_address' => 'Hiranandani',
            'company_city' => 'Gandhinagar',
            'company_state' => 'Gujarat',
            'company_country' => 'India',
            'company_pin_code' => '12345',
            'pan_number' => '1234567',
            'authorized_person_first_name' => 'Company',
            'authorized_person_last_name' => 'Director',
            'authorized_person_gender' => 'Female',
            'authorized_person_mobile_number' => '1234567890',
            'authorized_person_designation' => 'CTO',
            'authorized_person_mobile_number_2' => '1234567890',
            'authorized_person_support_document' => '',
            'application_number' => '',
            'is_active' => 'Y',
            'is_deleted' => 'N',
            'first_time_login' => 'N',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $role = Role::where(['name' => 'Data Entry'])->first();
        $user->assignRole([$role->id]);
    }
}
