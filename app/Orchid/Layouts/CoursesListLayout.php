<?php

namespace App\Orchid\Layouts;

use App\Models\Course;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CoursesListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'courses';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Nombre')
                ->render(function (Course $course) {
                    return Link::make($course->name)
                        ->route('platform.products.edit', $course);
                }),
            TD::make('currency_code', 'Codigo Moneda'),
            TD::make('price', 'Precio'),
            TD::make('created_at', 'Creado'),
            TD::make('updated_at', 'Ultima Actualizacion'),

        ];
    }
}
