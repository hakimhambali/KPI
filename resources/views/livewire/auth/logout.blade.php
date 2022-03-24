<div>
    <i class="fa fa-user me-sm-1 text-dark {{ in_array(request()->route()->getName(),['profile', 'my-profile']) ? 'text-white' : '' }}"></i>
    <span class="d-sm-inline d-none text-dark {{ in_array(request()->route()->getName(),['profile', 'my-profile']) ? 'text-white' : '' }}" wire:click="logout">Sign Out</span>
</div>
