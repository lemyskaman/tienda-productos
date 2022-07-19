<?php

namespace App\Orchid\Screens;

use App\Models\Course;
use App\Orchid\Layouts\CoursesListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ProductsListScreen extends Screen
{


    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'courses'   => Course::paginate(10),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Lista de Productos';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Crear Producto')
                ->icon('plus')
                ->route('platform.products.create'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [CoursesListLayout::class];
    }
}
