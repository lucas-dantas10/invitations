<x-card>
    <x-h.2>Criar um novo grupo</x-h.2>
    <x-form class="p-4" wire:submit.prevent="save">
        <x-input.text name="groupName" label="Group Name"/>

        <x-button>Salvar</x-button>
    </x-form>
</x-card>