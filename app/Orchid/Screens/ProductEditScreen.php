<?php

namespace App\Orchid\Screens;

use App\Models\Course;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ProductEditScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Course $course  ): iterable
    {
        $this->course = $course;

        return [];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
       if ($this->course->exists) {
           return 'Editar Producto';
       }

        return 'Crear Producto';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([

                        Input::make('curso.name', 'Nombre'),
                        Quill::make('curso.description', 'Descripción'),
                        Input::make('curso.price', 'Precio'),
                        ::
                    ]),
                ]),
            ];
    }
}
