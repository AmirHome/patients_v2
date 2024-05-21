<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Income;
use App\Models\IncomeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinanceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExpenseCategory::create([
            'name' => 'Treatment',
        ]);

        IncomeCategory::create(
            ['name' => 'Paid']
        );

        IncomeCategory::create(
            ['name' => 'Commission']
        );

        
    }
}
