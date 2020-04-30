<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->integer('ali_data_type_amount')->default(0);
            $table->integer('ali_register_type_amount')->default(0);
            $table->string('ali_justify')->nullable();
            $table->integer('aie_data_type_amount')->default(0);
            $table->integer('aie_register_type_amount')->default(0);
            $table->string('aie_justify')->nullable();
            $table->integer('ee_data_type_amount')->default(0);
            $table->integer('ee_referenced_files_amount')->default(0);
            $table->string('ee_justify')->nullable();
            $table->integer('se_data_type_amount')->default(0);
            $table->integer('se_referenced_files_amount')->default(0);
            $table->string('se_justify')->nullable();
            $table->integer('ce_data_type_amount')->default(0);
            $table->integer('ce_referenced_files_amount')->default(0);
            $table->string('ce_justify')->nullable();
            $table->integer('fp_total_amount')->nullable();
            $table->bigInteger('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requirements');
    }
}
