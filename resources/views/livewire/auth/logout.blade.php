<div>
    <i class="bi bi-door-open-fill me-sm-1 text-dark {{ in_array(request()->route()->getName(),['profile', 'my-profile']) ? 'text-white' : '' }}" wire:click="logout"></i>
    <span class="d-sm-inline d-none text-dark {{ in_array(request()->route()->getName(),['profile', 'my-profile']) ? 'text-white' : '' }}" wire:click="logout">Sign Out</span>
</div>


