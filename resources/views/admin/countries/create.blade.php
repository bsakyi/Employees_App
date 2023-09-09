<x-admin-layout>
    <h1 class="text-2xl font-semibold p-4">Create Country</h1>
    <x-splade-form  :action="route('admin.countries.store')" method="POST" class="p-4 bg-white rounded-md space-y-2">
        <x-splade-input name="country_code" label="Code" />
        <x-splade-input name="name" label="Name" />
        {{-- <x-splade-select name="roles[]" :options="$roles" multiple relation choices />
        <x-splade-select name="permissions[]" :options="$permissions" multiple relation choices /> --}}
        <x-splade-submit />
    </x-splade-form>
</x-admin-layout>

