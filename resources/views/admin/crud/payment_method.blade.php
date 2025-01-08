@extends('admin.index')
@include('admin.layouts.notification')

@section('main')
{{-- Heading --}}
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            <nav class="flex mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="/" class="inline-flex items-center text-gray-700 hover:text-primaryEx-600 dark:text-gray-300 dark:hover:text-white">
                            <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 capitalize text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">{{ $title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">All {{ $title }}</h1>
        </div>
        <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
            <div class="flex items-center mb-4 sm:mb-0">
                <form class="sm:pr-3 w-full" action="payment_method" method="GET">
                    <label for="search" class="sr-only text-gray-900 dark:text-white">Search</label>
                    <div class="relative w-full mt-1 sm:w-64 xl:w-96">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" class="w-full block p-2 pl-10 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primaryEx-500 focus:border-primaryEx-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryEx-500 dark:focus:border-primaryEx-500" placeholder="Search for payment methods">
                        <button type="submit" class="absolute top-0 bottom-0 end-0 p-2.5 rounded-e-lg text-white bg-primaryEx-700 hover:bg-primaryEx-800 focus:ring-4 focus:ring-primaryEx-300 font-medium text-sm px-5 py-2.5 dark:bg-primaryEx-600 dark:hover:bg-primaryEx-700 focus:outline-none dark:focus:ring-primaryEx-800">Search</button>
                    </div>
                </form>
                <button id="createProductButton"
                    class="order-first sm:order-last text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-3 dark:from-blue-600 dark:to-purple-700 dark:hover:from-blue-700 dark:hover:to-purple-800 focus:outline-none dark:focus:ring-blue-800 flex items-center gap-2"
                    type="button" data-drawer-target="drawer-create-article" data-drawer-show="drawer-create-article"
                    aria-controls="drawer-create-article" data-drawer-placement="right">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah {{ $title }}
                </button>
                <i class="fas fa-sun text-gray-400"></i>
            </div>
        </div>

    </div>
</div>

<!-- Add Payment Method Drawer -->
<div id="drawer-create-article"
    class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs text-center p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-[#09132A]"
    tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
    <h5 id="drawer-label"
        class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-[#AEB9E1]">New {{ $title }}</h5>
    <button type="button" data-drawer-dismiss="drawer-create-article" aria-controls="drawer-create-article"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
        onclick="closeDrawer()">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <form action="{{ route('admin.payment_method.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4 text-left">
            <div class="pb-4">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" name="name" id="name" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primaryEx-600 focus:border-primaryEx-600 block w-full p-2.5 dark:bg-[#0B1739] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryEx-500 dark:focus:border-primaryEx-500"
                    value="" placeholder="Payment method name..." required="">
            </div>
            <div class="pb-4">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea name="description" id="description" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primaryEx-600 focus:border-primaryEx-600 block w-full p-2.5 dark:bg-[#0B1739] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryEx-500 dark:focus:border-primaryEx-500"
                    placeholder="Payment method description..." required=""></textarea>
            </div>
            <div class="pb-4">
                <label for="account_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Account Name</label>
                <input type="text" name="account_name" id="account_name" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primaryEx-600 focus:border-primaryEx-600 block w-full p-2.5 dark:bg-[#0B1739] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryEx-500 dark:focus:border-primaryEx-500"
                    value="" placeholder="Account name..." required="">
            </div>
            <div class="pb-4">
                <label for="account_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Account Number</label>
                <input type="text" name="account_number" id="account_number" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primaryEx-600 focus:border-primaryEx-600 block w-full p-2.5 dark:bg-[#0B1739] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryEx-500 dark:focus:border-primaryEx-500"
                    value="" placeholder="Account number..." required="">
            </div>
        </div>
        <div class="left-0 flex justify-center w-full pt-10 pb-4 mt-4 space-x-4 sm:absolute sm:px-4 sm:mt-0">
            <button type="submit"
                class="text-white w-full justify-center bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Add {{ $title }}
            </button>
            <button type="button" data-drawer-dismiss="drawer-create-article" aria-controls="drawer-create-article"
                onclick="closeDrawer()"
                class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primaryEx-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-[#09132A] dark:text-gray-300 dark:border-[#CB3CFF] dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                <svg aria-hidden="true" class="w-5 h-5 -ml-1 sm:mr-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
                Cancel
            </button>
        </div>
    </form>
</div>

{{-- All Products --}}
<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow">
                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Name
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Description
                            </th>
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Account Name
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Account Number
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400 flex flex-col">
                                <span>Registed At</span>
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse ($payment_methods as $payment_method)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="h-fit p-4 capitalize text-base font-semibold text-gray-900 dark:text-white whitespace-nowrap">{{ $payment_method->name }}</td>
                            <td class="h-fit p-4 capitalize text-base font-semibold text-gray-900 dark:text-white whitespace-nowrap">{{ $payment_method->description }}</td>
                            <td class="h-fit p-4 capitalize text-base font-semibold text-gray-900 dark:text-white whitespace-nowrap">{{ $payment_method->account_name }}</td>
                            <td class="h-fit p-4 capitalize text-base font-semibold text-gray-900 dark:text-white whitespace-nowrap">{{ $payment_method->account_number }}</td>
                            <td class="h-fit p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                <div class="text-base font-semibold text-gray-900 dark:text-white">{{ date('d F Y', strtotime($payment_method->created_at)) }}</div>
                            </td>
                            <td class="p-4 space-x-2 whitespace-nowrap text-center">
                                {{-- Update button --}}
                                <button type="button" id="updateProductButton-{{ $payment_method->id }}"
                                    data-drawer-target="drawer-update-{{ $payment_method->id }}"
                                    data-drawer-show="drawer-update-{{ $payment_method->id }}"
                                    aria-controls="drawer-update-{{ $payment_method->id }}"
                                    data-drawer-placement="right"
                                    onclick="showUpdateModal('{{ $payment_method->id }}')"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                        </path>
                                        <path fill-rule="evenodd"
                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Update
                                </button>
                                {{-- Update modal --}}
                                <div id="drawer-update-{{ $payment_method->id }}"
                                    class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-[#09132A]"
                                    tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
                                    <h5 id="drawer-label"
                                        class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-[#AEB9E1]">
                                        Update Payment Method</h5>
                                    <button type="button"
                                        onclick="closeUpdateDrawer('{{ $payment_method->id }}')"
                                        data-drawer-dismiss="drawer-update-{{ $payment_method->id }}"
                                        aria-controls="drawer-update-{{ $payment_method->id }}"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close menu</span>
                                    </button>
                                    <form action="payment_method/{{ $payment_method->id }}" method="POST"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="space-y-4 text-left">
                                            <div class="pb-4">
                                                <label for="name"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                <input type="text" name="name" id="name"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primaryEx-600 focus:border-primaryEx-600 block w-full p-2.5 dark:bg-[#0B1739] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryEx-500 dark:focus:border-primaryEx-500"
                                                    value="{{ $payment_method->name }}"
                                                    placeholder="Payment method name..." required="">
                                            </div>
                                            <div class="pb-4">
                                                <label for="description"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                                <textarea name="description" id="description"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primaryEx-600 focus:border-primaryEx-600 block w-full p-2.5 dark:bg-[#0B1739] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryEx-500 dark:focus:border-primaryEx-500"
                                                    placeholder="Payment method description..." required="">{{ $payment_method->description }}</textarea>
                                            </div>
                                            <div class="pb-4">
                                                <label for="account_name"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Account Name</label>
                                                <input type="text" name="account_name" id="account_name"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primaryEx-600 focus:border-primaryEx-600 block w-full p-2.5 dark:bg-[#0B1739] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryEx-500 dark:focus:border-primaryEx-500"
                                                    value="{{ $payment_method->account_name }}"
                                                    placeholder="Account name..." required="">
                                            </div>
                                            <div class="pb-4">
                                                <label for="account_number"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Account Number</label>
                                                <input type="text" name="account_number" id="account_number"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primaryEx-600 focus:border-primaryEx-600 block w-full p-2.5 dark:bg-[#0B1739] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryEx-500 dark:focus:border-primaryEx-500"
                                                    value="{{ $payment_method->account_number }}"
                                                    placeholder="Account number..." required="">
                                            </div>
                                        </div>
                                        <div
                                            class="left-0 flex justify-center w-full pt-10 pb-4 mt-4 space-x-4 sm:absolute sm:px-4 sm:mt-0">
                                            <button type="submit"
                                                class="w-full justify-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-blue-800">
                                                Update
                                            </button>
                                            <button type="button"
                                                onclick="closeUpdateDrawer('{{ $payment_method->id }}')"
                                                data-drawer-dismiss="drawer-update-{{ $payment_method->id }}"
                                                aria-controls="drawer-update-{{ $payment_method->id }}"
                                                class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primaryEx-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-[#09132A] dark:text-gray-300 dark:border-[#CB3CFF] dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                <svg aria-hidden="true" class="w-5 h-5 -ml-1 sm:mr-1"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <button type="button" id="deleteProductButton"
                                    data-drawer-target="drawer-delete-{{ $payment_method->id }}"
                                    data-drawer-show="drawer-delete-{{ $payment_method->id }}"
                                    aria-controls="drawer-delete-{{ $payment_method->id }}"
                                    data-drawer-placement="right"
                                    onclick="showDeleteDrawer('{{ $payment_method->id }}')"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Delete
                                </button>
                                {{-- Delete modal --}}
                                <form action="payment_method/{{ $payment_method->id }}" method="post"
                                    id="delete-form-{{ $payment_method->id }}" class="hidden">
                                    @method('delete')
                                    @csrf
                                </form>
                                <div id="drawer-delete-{{ $payment_method->id }}"
                                    class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-gray-800"
                                    tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
                                    <h5 id="drawer-label"
                                        class="inline-flex items-center text-sm font-semibold text-gray-500 uppercase dark:text-[#AEB9E1]">
                                        Delete item</h5>
                                    <button type="button"
                                        onclick="closeDeleteDrawer('{{ $payment_method->id }}')"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close menu</span>
                                    </button>
                                    <svg class="w-10 h-10 mt-8 mb-4 text-red-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h3 class="text-left text-wrap mb-6 text-lg text-gray-500 dark:text-gray-400">
                                        Are you sure you want to delete this article?</h3>
                                    <button type="button"
                                        onclick="deleteUser('{{ $payment_method->id }}')"
                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2.5 text-center mr-2 dark:focus:ring-red-900">
                                        Yes, I'm sure
                                    </button>
                                    <button type="button"
                                        onclick="closeDeleteDrawer('{{ $payment_method->id }}')"
                                        class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primaryEx-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                        No, cancel
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="p-4 text-center text-gray-500 dark:text-gray-400">
                                Tidak ada data yang ditemukan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- Pagination --}}
<div class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center mb-4 sm:mb-0">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $payment_methods->count() }}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ $payment_methods->total() }}</span></span>
    </div>
    <div class="flex items-center space-x-3">
        <a href="{{ ($payment_methods->currentPage() == 1) ? $payment_methods->url(1) : $payment_methods->previousPageUrl() }}" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primaryEx-700 hover:bg-primaryEx-800 focus:ring-4 focus:ring-primaryEx-300 dark:bg-primaryEx-600 dark:hover:bg-primaryEx-700 dark:focus:ring-primaryEx-800">
            <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            Previous
        </a>
        <a href="{{ ($payment_methods->currentPage() == $payment_methods->lastPage()) ? $payment_methods->url($payment_methods->lastPage()) : $payment_methods->nextPageUrl() }}" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primaryEx-700 hover:bg-primaryEx-800 focus:ring-4 focus:ring-primaryEx-300 dark:bg-primaryEx-600 dark:hover:bg-primaryEx-700 dark:focus:ring-primaryEx-800">
            Next
            <svg class="w-5 h-5 ml-1 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
        </a>
    </div>
</div>

<script>
    document.querySelectorAll('th[data-sort]').forEach(header => {
        header.addEventListener('click', () => {
            const tableBody = document.getElementById('table-body');
            const rows = Array.from(tableBody.querySelectorAll('tr'));
            const sortField = header.getAttribute('data-sort');

            const isAscending = header.classList.contains('asc');
            rows.sort((a, b) => {
                const aText = a.querySelector(`td:nth-child(${getColumnIndex(sortField)})`).textContent.trim();
                const bText = b.querySelector(`td:nth-child(${getColumnIndex(sortField)})`).textContent.trim();

                return isAscending ? aText.localeCompare(bText) : bText.localeCompare(aText);
            });

            // Remove existing 'asc' and 'desc' classes
            header.classList.toggle('asc', !isAscending);
            header.classList.toggle('desc', isAscending);

            // Append sorted rows to the table body
            rows.forEach(row => tableBody.appendChild(row));
        });
    });

    function showDeleteDrawer(roomId) {
        document.getElementById('drawer-delete-' + roomId).classList.remove('translate-x-full');
    }

    function closeDeleteDrawer(roomId) {
        document.getElementById('drawer-delete-' + roomId).classList.add('translate-x-full');
    }

    function deleteUser(roomId) {
        if (confirm('Are you sure you want to delete this room?')) {
            document.getElementById('delete-form-' + roomId).submit();
        }
    }

    function closeDrawer() {
        document.getElementById('drawer-create-room').classList.add('translate-x-full');
    }

    document.getElementById('createProductButton').addEventListener('click', function() {
        document.getElementById('drawer-create-room').classList.toggle('translate-x-full');
    });

    function getColumnIndex(sortField) {
        switch (sortField) {
            case 'title':
                return 2; // Kolom TITLE
            case 'published_at':
                return 5; // Kolom PUBLISHED AT
            default:
                return 1;
        }
    }

    function showUpdateModal(roomId) {
        const modal = document.getElementById(`drawer-update-${roomId}`);
        if (modal) {
            modal.classList.remove('translate-x-full');
            modal.classList.add('translate-x-0');
            modal.setAttribute('aria-hidden', 'false');
        }
    }

    function closeUpdateDrawer(roomId) {
        const drawer = document.getElementById(`drawer-update-${roomId}`);
        if (drawer) {
            drawer.classList.add('translate-x-full');
            drawer.classList.remove('translate-x-0');
            drawer.setAttribute('aria-hidden', 'true');
        }
    }
</script>
@endsection
