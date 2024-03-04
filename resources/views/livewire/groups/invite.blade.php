<div>
    <x-form wire:submit.prevent="save" id="invitation-form">
        <x-input.text name="email" label="Invite a little fella" placeholder="email@mail.com" />

        <x-button type="button" wire:click="save">Convidar</x-button>
        {{-- <x-button type="button" wire:click="$set('show', 0)">hummmm, no</x-button> --}}
    </x-form>
</div>
