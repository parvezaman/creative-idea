<x-app-layout>
    <x-slot name="header">
        <div class="add-customer-container">
            <a href="{{ route('customers.create') }}" class="button-base edit-button add-button">+ Add Customer</a>
        </div>
    </x-slot>

    <x-slot name="main">
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Contact Person</th>
                        <th>Email</th>
                        {{-- <th>Date of Birth</th> --}}
                        <th>Contact Person Address</th>
                        <th>Company Name</th>
                        <th>Company Address</th>
                        <th>Contact Person Phone</th>
                        <th>Company Phone</th>
                        <th>Website</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->contact_person_name }}</td>
                        <td>{{ $customer->contact_person_email }}</td>
                        {{-- <td>{{ $customer->date_of_birth }}</td> --}}
                        <td>{{ $customer->contact_person_address }}</td>
                        <td>{{ $customer->company_name }}</td>
                        <td>{{ $customer->company_address }}</td>
                        <td>{{ $customer->contact_person_phone }}</td>
                        <td>{{ $customer->company_phone }}</td>
                        <td>{{ $customer->company_website }}</td>
                        <td>
                            <div class="button-container">
                                {{-- <a href="{{ route('customers.edit', $customer) }}" class="edit-button">Edit</a>
                                --}}
                                <form action="{{ route('customers.edit', $customer) }}" method="GET">
                                    <button type="submit" class="edit-button">Edit</button>
                                </form>

                                <form id="delete-form" action="{{ route('customers.destroy', $customer) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this customer?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-slot>
</x-app-layout>

<script>
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this customer?')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>