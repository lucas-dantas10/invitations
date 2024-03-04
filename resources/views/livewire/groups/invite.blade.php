<div>
    {{-- <x-button wire:click="invite" class="w-full text-center rounded-none inline-grid bg-gray-200">
        Convide alguém para o seu grupo
    </x-button> --}}

    <x-form wire:submit.prevent="save" id="invitation-form">
        <x-input.text name="email" label="Invite a little fella" placeholder="email@mail.com" />

        <x-button type="button" wire:click="save">Convidar</x-button>
        <x-button type="button" wire:click="$set('show', 0)">hummmm, no</x-button>
    </x-form>

    {{-- @if ($show)
        <x-modal name="Invite">
            <x-form wire:submit.prevent="save" id="invitation-form">
                <x-input.text name="email" label="Invite a little fella" placeholder="email@mail.com"/>
            </x-form>

            <x-slot:actions>
                <x-button type="button" wire:click="save">Invite</x-button>
                <x-button type="button" wire:click="$set('show', 0)" >hummmm, no</x-button>
            </x-slot:actions>
        </x-modal>
    @endif --}}
</div>
