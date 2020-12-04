<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Название компании');
            $table->integer('user_id')->comment('Айди пользователя');
            $table->integer('rating')->comment('Рейтинг')->nullable();
            $table->integer('address')->comment('Адрес')->nullable();
            $table->integer('Type_of_ownership')->comment('Форма собственности.ЧП,ОсОО,АО,Гос')->nullable();
            $table->integer('Duration_of_activity')->comment('Продолжительность деятельности')->nullable();
            $table->integer('License')->comment('Лицензия, ур. ответсвенности')->nullable();

            $table->integer('Number_of_employees')->comment('Кол-во работников')->nullable();
            $table->integer('Specialist_certificates')->comment('Сертификаты специалистов')->nullable();
            $table->integer('Candidates_of_Science')->comment('Кандидаты наук')->nullable();
            $table->integer('Doctors_of_Science')->comment('Доктора наук')->nullable();
            $table->integer('International')->comment('Международ')->nullable();
            $table->integer('State_accreditation')->comment('Государственное акредитации')->nullable();
            $table->integer('Membership_of_societies_professors_associations')->comment('Членство обществ. професс.ассоциации')->nullable();

            $table->integer('Base_area_fund')->comment('Площадь основ. фонд.')->nullable();
            $table->integer('Technical_and_technological_support')->comment('Технико-технологическое обеспечение.')->nullable();
            $table->integer('Innovative_technologies')->comment('Инновационные технологии')->nullable();

            $table->integer('Financial_stability')->comment('Финансовая устойчивост')->nullable();
            $table->integer('Regional_network')->comment('Региональная сеть')->nullable();
            $table->integer('Quantitative_indicators')->comment('Количественные показатели')->nullable();
            $table->integer('Qualitative_indicators')->comment('Качественные поназатели')->nullable();

            $table->integer('price')->comment('Цены')->nullable();
            $table->integer('Reviews_of_competitors')->comment('Отзывы конкурентов')->nullable();
            $table->integer('Customer_Reviews')->comment('Отзывы клиентов')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
