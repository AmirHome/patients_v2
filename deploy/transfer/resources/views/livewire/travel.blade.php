<div>
    <!-- Your Livewire component content goes here -->
    <div>
        This is the content of the Livewire component.
    </div>

    <form wire:submit.prevent="register">
        <input type="text" wire:model="name" placeholder="Name">
        <input type="text" wire:model="email" placeholder="Email">
        <button type="submit">Register</button>
    </form>
</div>