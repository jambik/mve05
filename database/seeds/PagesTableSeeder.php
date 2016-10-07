<?php

use App\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    protected $items = [
        ['Главная', 'main', '<h1>Laravel CMS</h1><p>Текст на главной странице</p>'],
        ['О компании', 'about', '<h1>О компании</h1><p>Страничка о компании.</p>'],
        ['Список АЗС', 'gas_stations', '<h1>Список АЗС, принимающих талоны МВИ</h1><p>Текст.</p>'],
        ['Контакты', 'contacts', '<h1>Контакты</h1><p>Телефоны:</p><p>Email:</p><p>Факс:</p><p>Адрес: г. Москва, ул. Ленина 1</p>'],
        ['Новости', 'news', '<p>Новости</p>'],
        ['Обратная связь', 'feedback', '<p>Обратная связь</p>'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0, $iMax=count($this->items); $i<$iMax; $i++)
        {
            $row = array_combine(['name', 'slug', 'text'], $this->items[$i]);

            Page::create($row);
        }
    }
}
