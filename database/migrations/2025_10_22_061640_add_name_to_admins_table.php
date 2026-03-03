<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Vérifie si la colonne n'existe pas déjà avant de l'ajouter
        if (!Schema::hasColumn('admins', 'name')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->string('name')->nullable()->after('id');
            });
        }
    }

    public function down()
    {
        // Vérifie si la colonne existe avant de la supprimer
        if (Schema::hasColumn('admins', 'name')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->dropColumn('name');
            });
        }
    }
};