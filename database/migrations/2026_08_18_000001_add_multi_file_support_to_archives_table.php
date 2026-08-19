<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('archives', function (Blueprint $table) {
            $table->text('file_path')->change();
            $table->text('file_name')->change();
            $table->text('original_name')->change();
            $table->text('file_size')->change();
            $table->text('file_mime')->change();
        });

        DB::table('archives')->get()->each(function ($row) {
            if (!str_starts_with($row->file_path, '[')) {
                DB::table('archives')->where('id', $row->id)->update([
                    'file_path' => json_encode([$row->file_path]),
                    'file_name' => json_encode([$row->file_name]),
                    'original_name' => json_encode([$row->original_name]),
                    'file_size' => json_encode([(int) $row->file_size]),
                    'file_mime' => json_encode([$row->file_mime]),
                ]);
            }
        });
    }

    public function down(): void
    {
        Schema::table('archives', function (Blueprint $table) {
            $table->string('file_path')->change();
            $table->string('file_name')->change();
            $table->string('original_name')->change();
            $table->bigInteger('file_size')->change();
            $table->string('file_mime')->change();
        });
    }
};