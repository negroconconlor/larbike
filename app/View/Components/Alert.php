<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    //propiedades
    public string $type, $message;
    public function __construct(
        string $type= 'warning', // tipo del mensaje
        string $message='' // mensaje a mostrar
        ){
        $this->type = $type;
        $this->message = $message;
    }


    //métodos
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return <<<'blade'
        <div class="alert alert-{{ $type }}">
        <p>{{$message}}</p>
        {{$slot}}
        </div>
        blade;
    }
}
