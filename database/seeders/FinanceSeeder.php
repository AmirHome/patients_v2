<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\ExpensesIncome;
use App\Models\Patient;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FinanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=FinanceSeeder
     */
    public function run(): void
    {
        ExpensesIncome::truncate();

        if (env('APP_ENV') === 'local') {
            
            // Generate fake expenses
            $numberOfExpenses = 7;
            $patientIds = Patient::inRandomOrder()->take(10)->get('id');
            foreach($patientIds as $patientId) {
                for ($i = 0; $i < $numberOfExpenses; $i++) {
                    $catId = rand(1, 4);
    
                    ExpensesIncome::create([
                        'user_id' => 77, // Admin user
                        'category' => $catId,
                        'patient_id' => $patientId->id,
                        'department_id' => Department::inRandomOrder()->first()->id,
                        'amount' => Faker::create()->numberBetween(10, 100) * ($catId === 1 ? 10000 : 500),
                        'description' => Faker::create()->sentence(12),
                        'created_at' => Faker::create()->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
                    ]);
                }
            }

        }
        
    }
}
