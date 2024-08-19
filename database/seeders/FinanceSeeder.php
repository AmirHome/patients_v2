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

                    // Expenses
                    $amountExpenses = Faker::create()->numberBetween(100, 1000)*10;
                    // Commission Expenses percent 10% - 20% 
                    $amountCommissionExpenses = (int) ($amountExpenses * Faker::create()->numberBetween(10, 20) / 100);

                    // Income random less or equal to Expenses
                    $amountIncome = Faker::create()->numberBetween(1000, $amountExpenses);
                    // Commission Income is percent of amountIncome 10% - 20% and less or equal to amountCommissionExpenses
                    $amountCommissionIncome = (int)((($amountIncome>$amountCommissionExpenses)?$amountIncome:$amountCommissionExpenses) * Faker::create()->numberBetween(10, 20) / 100);

                    $date = Faker::create()->dateTimeBetween('-10 year', 'now')->format('Y-m-d');

                    ExpensesIncome::create([
                        'user_id' => 77, // Admin user
                        'category' => 1,
                        'patient_id' => $patientId->id,
                        'department_id' => Department::inRandomOrder()->first()->id,
                        'amount' => $amountExpenses,
                        'description' => Faker::create()->sentence(20),
                        'created_at' => $date,
                    ]);
    
                    ExpensesIncome::create([
                        'user_id' => 77, // Admin user
                        'category' => 2,
                        'patient_id' => $patientId->id,
                        'department_id' => Department::inRandomOrder()->first()->id,
                        'amount' => $amountCommissionExpenses,
                        'description' => Faker::create()->sentence(20),
                        'created_at' => $date,
                    ]);

                    ExpensesIncome::create([
                        'user_id' => 77, // Admin user
                        'category' => 3,
                        'patient_id' => $patientId->id,
                        'department_id' => Department::inRandomOrder()->first()->id,
                        'amount' => $amountIncome,
                        'description' => Faker::create()->sentence(20),
                        'created_at' => $date,
                    ]);

                    ExpensesIncome::create([
                        'user_id' => 77, // Admin user
                        'category' => 4,
                        'patient_id' => $patientId->id,
                        'department_id' => Department::inRandomOrder()->first()->id,
                        'amount' => $amountCommissionIncome,
                        'description' => Faker::create()->sentence(20),
                        'created_at' => $date,
                    ]);
                }
            }

        }
        
    }
}
