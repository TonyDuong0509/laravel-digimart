<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputText extends Component
{
    public ?string $type;
    public string $name;
    public ?string $label;
    public ?string $value;
    public ?string $placeholder;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $type = null,
        string $name,
        string $label = null,
        string $value = null,
        string $placeholder = null,
    )
    {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label ?? \Str::title(str_replace('_', ' ', $name));
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.input-text');
    }
}
