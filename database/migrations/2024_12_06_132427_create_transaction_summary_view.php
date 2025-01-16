<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW transaction_summary_view AS
            SELECT
                funds.id AS fund_id,
                funds.title AS fund_title,
                funds.description AS fund_description,
                funds.type AS fund_type,
                SUM(transactions.amount) AS total_amount
            FROM
                funds
            LEFT JOIN
                transactions ON funds.id = transactions.fund_id
            GROUP BY
                funds.id, funds.title
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS transaction_summary_view");
    }
};
