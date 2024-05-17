<x-app-layout>

    <x-slot name="main">
        <!-- add customer form -->
        <div class="container mx-auto">
            <h2 class="text-2xl font-semibold mb-4">Add Customer</h2>

            <!-- Customer creation form -->
            <form method="POST" action="{{ route('customers.store') }}" class="max-w-md mx-auto">
                @csrf

                @if($errors->any())
                <div class="mb-4">
                    <div class="text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <div class="mb-4">
                    <label for="contact_person_name" class="block text-sm font-medium text-gray-700">Contact Person
                        Name</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="contact_person_name" name="contact_person_name" placeholder="Enter contact person name">
                </div>

                <div class="mb-4">
                    <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="company_name" name="company_name" placeholder="Enter Company Name">
                </div>

                <div class="mb-4">
                    <label for="contact_person_email" class="block text-sm font-medium text-gray-700">Contact Person
                        Email</label>
                    <input type="email"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="contact_person_email" name="contact_person_email" placeholder="Enter Contact Person email">
                </div>
                <div class="mb-4">
                    <label for="company_email" class="block text-sm font-medium text-gray-700">Company Email</label>
                    <input type="email"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="company_email" name="company_email" placeholder="Enter Company email">
                </div>
                <div class="mb-4">
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Contact Person Date of
                        Birth</label>
                    <input type="date"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="date_of_birth" name="date_of_birth" placeholder="Enter date of birth">
                </div>
                <div class="mb-4">
                    <label for="contact_person_address" class="block text-sm font-medium text-gray-700">Contact Person
                        Address</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="contact_person_address" name="contact_person_address"
                        placeholder="Enter Contact Person Address">
                </div>

                <div class="mb-4">
                    <label for="company_address" class="block text-sm font-medium text-gray-700">Company Address</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="company_address" name="company_address" placeholder="Enter Company Address">
                </div>
                {{-- <div class="mb-4">
                    <label for="contact_person_address" class="block text-sm font-medium text-gray-700">Contact Person
                        Address</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="contact_person_address" name="contact_person_address"
                        placeholder="Enter Contact Person Address">
                </div> --}}
                <div class="mb-4">
                    <label for="contact_person_phone" class="block text-sm font-medium text-gray-700">Contact Person
                        Phone Number</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="contact_person_phone" name="contact_person_phone"
                        placeholder="Enter Contact Person Phone Number">
                </div>
                <div class="mb-4">
                    <label for="company_phone" class="block text-sm font-medium text-gray-700">Company Phone
                        Number</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="company_phone" name="company_phone" placeholder="Enter Company Phone Number">
                </div>
                <div class="mb-4">
                    <label for="contact_person_website" class="block text-sm font-medium text-gray-700">Contact Person
                        Website</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="contact_person_website" name="contact_person_website"
                        placeholder="Enter Contact Person Website URL">
                </div>
                <div class="mb-4">
                    <label for="company_website" class="block text-sm font-medium text-gray-700">Company Website</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="company_website" name="company_website" placeholder="Enter Company Website URL">
                </div>
                <!-- Add more form fields for other customer attributes -->
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
            </form>
        </div>
    </x-slot>
</x-app-layout>