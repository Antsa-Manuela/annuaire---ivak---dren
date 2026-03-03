<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            // Ajouter la colonne 'role' si elle n'existe pas
            if (!Schema::hasColumn('admins', 'role')) {
                $table->string('role')
                    ->default('admin')
                    ->check("role in ('super_admin', 'admin')")
                    ->after('name');
            }

            // Ajouter la colonne 'last_login_at' si elle n'existe pas
            if (!Schema::hasColumn('admins', 'last_login_at')) {
                $table->timestamp('last_login_at')->nullable()->after('role');
            }

            // Ajouter la colonne 'is_active' si elle n'existe pas
            if (!Schema::hasColumn('admins', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('last_login_at');
            }
        });
    }

    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            // Supprimer les colonnes seulement si elles existent
            if (Schema::hasColumn('admins', 'role')) {
                $table->dropColumn('role');
            }
            if (Schema::hasColumn('admins', 'last_login_at')) {
                $table->dropColumn('last_login_at');
            }
            if (Schema::hasColumn('admins', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
};