<x-admin-layout>
    <div class="flex justify-between">
        <h1 class="text-2xl font-semibold p-4">Employees Index</h1>
        <div class="p-4">
            <Link href ="{{ route('admin.employees.create') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded text-white">New Employee</Link>
        </div>
    </div>
   
    <x-splade-table :for="$employees">
        @cell('action', $employee)
            <div class="space-x-2">
                <Link href="{{ route('admin.employees.edit', $employee) }}" class="text-white px-3 py-2 bg-green-400 hover:bg-blue-700 rounded-md">Edit</Link>
                <Link href="{{ route('admin.employees.destroy', $employee) }}" method="DELETE" confirm="Delete the State"
                confirm-text="Are you sure?" confirm-buttton="Yes" cancel-button="No"
                class="text-red-100 px-3 py-2 bg-red-400 hover:bg-red-700 rounded-md">Delete</Link>
            </div>
        @endcell
    </x-splade-table>
</x-admin-layout>