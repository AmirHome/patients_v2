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
     * php artisan db:seed --class=FinanceCategorySeeder
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

        Expense::truncate();
        Income::truncate();
        if (env('APP_ENV') === 'local') {
            $numberOfExpenses = 50;

            // Generate fake expenses
            for ($i = 0; $i < $numberOfExpenses; $i++) {
                $catId = rand(1, 2);

                Expense::create([
                    'user_id' => 77, // Admin user
                    'patient_id' => Patient::inRandomOrder()->first()->id,
                    'expense_category_id' => $catId,
                    'entry_date' => Faker::create()->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
                    'amount' => Faker::create()->numberBetween(100, 1000) * ($catId === 1 ? 1000 : 500),
                    'description' => Faker::create()->sentence(),
                ]);

                $catId = rand(1, 2);
                Income::create([
                    'user_id' => 77, // Admin user
                    'patient_id' => Patient::inRandomOrder()->first()->id,
                    'income_category_id' => $catId,
                    'entry_date' => Faker::create()->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
                    'amount' => Faker::create()->numberBetween(100, 1000) * ($catId === 1 ? 1000 : 500),
                    'description' => Faker::create()->sentence(),
                ]);
            }
        }
        
    }
}
