<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RoleButton extends Component
{
    public string $role;
    /**
     * Create a new component instance.
     */
    public function __construct(string $role)
    {
        $this->role = $role;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.role-button');
    }
    public function shouldRender()
    {
        return auth()->user() && auth()->user()->hasRole($this->role);
    }
}
