<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Company
 *
 * @package App
 */
class Company extends Model
{
    use \Rinvex\Categories\Traits\Categorizable;
    protected $fillable =['title', 'user_id', 'rating', 'address', 'Type_of_ownership', 'Duration_of_activity', 'License', 'Number_of_employees',
        'Specialist_certificates', 'Candidates_of_Science', 'Doctors_of_Science', 'International', 'State_accreditation',
        'Membership_of_societies_professors_associations', 'Base_area_fund', 'Technical_and_technological_support', 'Innovative_technologies', 'Financial_stability',
        'Regional_network', 'Quantitative_indicators', 'Qualitative_indicators', 'price', 'Reviews_of_competitors', 'Customer_Reviews'];

    static public function fake($count = 1){
        $fakeCompany = factory(Company::class,$count)->create();
        return $fakeCompany;
    }

    static function fields () {
        return [
//            'title' =>'Название компании',
//                'user_id' => 'Айди пользователя',
//                'rating' => 'Рейтинг',
            'address' => 'Адрес',
            'Type_of_ownership' => 'Форма собственности.ЧП,ОсОО,АО,Гос',
            'Duration_of_activity' => 'Продолжительность деятельности',
            'License' => 'Лицензия, ур. ответсвенности',

            'Number_of_employees' => 'Кол-во работников',
            'Specialist_certificates' => 'Сертификаты специалистов',
            'Candidates_of_Science' => 'Кандидаты наук',
            'Doctors_of_Science' => 'Доктора наук',
            'International' => 'Международ',
            'State_accreditation' => 'Государственное акредитации',
            'Membership_of_societies_professors_associations' => 'Членство обществ. професс.ассоциации',

            'Base_area_fund' => 'Площадь основ. фонд.',
            'Technical_and_technological_support' => 'Технико-технологическое обеспечение.',
            'Innovative_technologies' => 'Инновационные технологии',

            'Financial_stability' => 'Финансовая устойчивост',
            'Regional_network' => 'Региональная сеть',
            'Quantitative_indicators' => 'Количественные показатели',
            'Qualitative_indicators' => 'Качественные поназатели',

            'price' => 'Отзывы конкурентов Цены',
            'Reviews_of_competitors' => 'Отзывы конкурентов',
            'Customer_Reviews' => 'Отзывы клиентов',
        ];
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
