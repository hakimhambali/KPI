<div>
    <span class="d-sm-inline d-none text-dark {{ in_array(request()->route()->getName(),['profile', 'my-profile']) ? 'text-white' : '' }}" wire:click="logout"><i class="bi bi-door-open-fill text-lg"></i> Sign Out</span>
</div>
