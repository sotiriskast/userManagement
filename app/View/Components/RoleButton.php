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
     * Determine if the component should be rendered.
     */
    public function shouldRender(): bool
    {
        if (auth()->check() && auth()->user()->hasRole('super_admin')) {
            return true;
        }

        // Other roles are checked against the specific role
        return auth()->check() && auth()->user()->hasRole($this->role);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.role-button');
    }
}
