<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Income;
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

        Income::create([
            'name' => 'Commission',
        ]);
        Income::create([
            'name' => 'Paid',
        ]);
        
    }
}
