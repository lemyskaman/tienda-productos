<?php

namespace App\Orchid\Screens;

use App\Models\Course;
use http\Env\Request;
use Illuminate\Validation\Rule;
use Orchid\Platform\Components\Notification;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ProductEditScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Course $course): iterable
    {
        $this->course = $course;

        return [
            'course' => $course,
        ];
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
        return [
            Button::make('Guardar')
                ->icon('save')
                ->method('save'),
        ];
    }

    public function save(Course $course, \Illuminate\Http\Request $request)
    {

        $validated = $request->validate([
            'curso.name' => 'required|string|max:255',
            'curso.description' => 'string|max:255',
            'curso.price' => 'required|numeric',
            'curso.currency_code' => [
                'required',
                Rule::in(collect(Course::$currencies)

                    ->map(function ($currency) {
                        return $currency['code'];
                    })->toArray()),
            ],
        ]);


        $course->fill($request->get('curso'));
        if ($course->save()) {
            Alert::success('Curso guardado correctamente');
            return redirect()->route('platform.products.list');
        }

        Alert::error('Error al guardar el curso');
        return redirect()->back();
    }


    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public
    function layout(): iterable
    {


        return [
            Layout::rows([

                Input::make('curso.name')->title('Nombre')->required(),
                Quill::make('curso.description')->title('Descripción'),
                Input::make('curso.price')->title('Precio')->required()->type('numeric')
                /*->mask([
                'mask' => '999 999 999.99',
                'numericInput' => true
            ])*/,
                Select::make('curso.currency_code')->required()
                    ->options(collect(Course::$currencies)
                        ->mapWithKeys(function ($currency) {
                            return array($currency['code'] => $currency['code'] . ' ' . $currency['name']);
                        })->toArray())
                    ->title('Seleccione Codigo de Moneda')
            ])
        ];
    }
}
