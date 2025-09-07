<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AlertComponent extends Component
{
    /**
     * Create a new component instance.
     * les parametres publics vont me permettre de les passer au niveau de la vue
     */
    public function __construct(public string $type = 'success', public string $message)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.alert-component');
    }
}
