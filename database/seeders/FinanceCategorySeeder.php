<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\Patient;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FinanceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'name' => 'Treatment',
            ],
            [
                'id'    => 2,
                'name' => 'Commission',
            ],
        ];
        ExpenseCategory::insertOrIgnore($data);

        $data = [
            [
                'id'    => 1,
                'name' => 'Paid',
            ],
            [
                'id'    => 2,
                'name' => 'Commission',
            ],
        ];
        IncomeCategory::insertOrIgnore($data);

        if (env('APP_ENV') === 'local') {
            $numberOfExpenses = 500;

            // dd( Faker::create()->dateTime('now')->format('Y-m-d') );
            // Generate fake expenses
            for ($i = 0; $i < $numberOfExpenses; $i++) {
                Expense::create([
                    'user_id' => 77, // Admin user
                    'patient_id' => Patient::inRandomOrder()->first()->id,
                    'expense_category_id' => ExpenseCategory::inRandomOrder()->first()->id,
                    'entry_date' => Faker::create()->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
                    'amount' => Faker::create()->numberBetween(1000, 1000000),
                    'description' => Faker::create()->sentence(),
                ]);


                Income::create([
                    'user_id' => 77, // Admin user
                    'patient_id' => Patient::inRandomOrder()->first()->id,
                    'income_category_id' => IncomeCategory::inRandomOrder()->first()->id,
                    'entry_date' => Faker::create()->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
                    'amount' => Faker::create()->numberBetween(1000, 1000000),
                    'description' => Faker::create()->sentence(),
                ]);
            }
        }
        
    }
}
