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
                <form class="sm:pr-3 w-full" action="payments" method="GET">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative w-full mt-1 sm:w-64 xl:w-96">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" class="w-full block p-2 pl-10 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primaryEx-500 focus:border-primaryEx-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryEx-500 dark:focus:border-primaryEx-500" placeholder="Search for payments">
                        <button type="submit" class="absolute top-0 bottom-0 end-0 p-2.5 rounded-e-lg text-white bg-primaryEx-700 hover:bg-primaryEx-800 focus:ring-4 focus:ring-primaryEx-300 font-medium text-sm px-5 py-2.5 dark:bg-primaryEx-600 dark:hover:bg-primaryEx-700 focus:outline-none dark:focus:ring-primaryEx-800">Search</button>
                    </div>
                </form>
                <button id="createProductButton"
                    class="order-first sm:order-last text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-3 dark:from-blue-600 dark:to-purple-700 dark:hover:from-blue-700 dark:hover:to-purple-800 focus:outline-none dark:focus:ring-blue-800 flex items-center gap-2"
                    type="button" data-drawer-target="drawer-create-payment" data-drawer-show="drawer-create-payment"
                    aria-controls="drawer-create-payment" data-drawer-placement="right">
                    Add Payment
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add Payment Drawer -->
<div id="drawer-create-payment"
    class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-[#09132A]"
    tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
    <h5 id="drawer-label"
        class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-[#AEB9E1]">New Payment</h5>
    <button type="button" data-drawer-dismiss="drawer-create-payment" aria-controls="drawer-create-payment"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
        onclick="closeDrawer()">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <form action="{{ route('admin.payments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4 text-left">
            <div class="pb-4">
                <label for="reservation_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reservation</label>
                <select name="reservation_id" id="reservation_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primaryEx-600 focus:border-primaryEx-600 block w-full p-2.5 dark:bg-[#0B1739] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryEx-500 dark:focus:border-primaryEx-500">
                    <option value="">Select Reservation</option>
                    @foreach($reservations as $reservation)
                    <option value="{{ $reservation->id }}">{{ $reservation->user->name }} - Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="pb-4">
                <label for="payment_method_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Method</label>
                <select name="payment_method_id" id="payment_method_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primaryEx-600 focus:border-primaryEx-600 block w-full p-2.5 dark:bg-[#0B1739] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryEx-500 dark:focus:border-primaryEx-500">
                    <option value="">Select Payment Method</option>
                    @foreach($paymentMethods as $method)
                    <option value="{{ $method->id }}">{{ $method->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="pb-4">
                <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                <input type="number" name="amount" id="amount" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primaryEx-600 focus:border-primaryEx-600 block w-full p-2.5 dark:bg-[#0B1739] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryEx-500 dark:focus:border-primaryEx-500" placeholder="Example: 500000">
            </div>
            <div class="pb-4">
                <label for="payment_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Date</label>
                <input type="date" name="payment_date" id="payment_date" required 
                       value="{{ date('Y-m-d') }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primaryEx-600 focus:border-primaryEx-600 block w-full p-2.5 dark:bg-[#0B1739] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryEx-500 dark:focus:border-primaryEx-500">
            </div>
            <div class="pb-4">
                <label for="payment_proof" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Proof</label>
                <input type="file" name="payment_proof" id="payment_proof" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primaryEx-600 focus:border-primaryEx-600 block w-full p-2.5 dark:bg-[#0B1739] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryEx-500 dark:focus:border-primaryEx-500">
            </div>
            <div class="pb-4">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select name="status" id="status" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primaryEx-600 focus:border-primaryEx-600 block w-full p-2.5 dark:bg-[#0B1739] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryEx-500 dark:focus:border-primaryEx-500">
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
        </div>
        <div class="left-0 flex justify-center w-full pt-10 pb-4 mt-4 space-x-4 sm:absolute sm:px-4 sm:mt-0">
            <button type="submit"
                class="text-white w-full justify-center bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Add {{ $title }}
            </button>
            <button type="button" data-drawer-dismiss="drawer-create-payment"
                onclick="closeDrawer()"
                class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primaryEx-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-[#09132A] dark:text-gray-300 dark:border-[#CB3CFF] dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                Cancel
            </button>
        </div>
    </form>
</div>

{{-- All Payments --}}
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
                                Total Price
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Payment Method
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Payment Date
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Amount
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Payment Proof
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Status
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Created At
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse ($payments as $payment)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="h-fit p-4 capitalize text-base font-semibold text-gray-900 dark:text-white whitespace-nowrap">{{ $payment->reservation->user->name }}</td>
                            <td class="h-fit p-4 capitalize text-base font-semibold text-gray-900 dark:text-white whitespace-nowrap">Rp {{ number_format($payment->reservation->total_price, 0, ',', '.') }}</td>
                            <td class="h-fit p-4 capitalize text-base font-semibold text-gray-900 dark:text-white whitespace-nowrap">{{ $payment->paymentMethod->name }}</td>
                            <td class="h-fit p-4 capitalize text-base font-semibold text-gray-900 dark:text-white whitespace-nowrap">{{ date('d F Y', strtotime($payment->payment_date)) }}</td>
                            <td class="h-fit p-4 capitalize text-base font-semibold text-gray-900 dark:text-white whitespace-nowrap">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                            <td class="h-fit p-4 capitalize text-base font-semibold text-gray-900 dark:text-white whitespace-nowrap">
                                @if($payment->payment_proof)
                                <button onclick="openImageModal('{{ asset($payment->payment_proof) }}')" class="inline-flex items-center text-primaryEx-600 hover:underline">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    View Proof
                                </button>

                                <!-- Modal -->
                                <div id="imageModal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-75 backdrop-blur-sm flex items-center justify-center">
                                    <div class="relative bg-white dark:bg-gray-800 p-4 rounded-lg max-w-4xl w-full mx-4 shadow-2xl transform transition-all">
                                        <div class="flex justify-between items-center mb-4">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Payment Proof</h3>
                                            <div class="flex space-x-2">
                                                <button onclick="downloadImage()" class="text-white bg-primaryEx-600 hover:bg-primaryEx-700 focus:ring-4 focus:ring-primaryEx-300 font-medium rounded-lg text-sm px-4 py-2 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                    Download
                                                </button>
                                                <button onclick="closeImageModal()" class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="relative">
                                            <img id="modalImage" src="" alt="Payment Proof" class="w-full h-auto rounded-lg shadow-lg">
                                        </div>
                                    </div>
                                </div>
                                @else
                                No proof uploaded
                                @endif
                            </td>
                            <td class="h-fit p-4 capitalize text-base font-semibold whitespace-nowrap">
                                <span class="px-2 py-1 rounded-full text-sm font-medium
                                    @if($payment->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($payment->status == 'confirmed') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $payment->status }}
                                </span>
                            </td>
                            <td class="h-fit p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                <div class="text-base font-semibold text-gray-900 dark:text-white">{{ date('d F Y', strtotime($payment->created_at)) }}</div>
                            </td>
                            <td class="p-4 space-x-2 whitespace-nowrap text-center">
                                {{-- Update button --}}
                                <button type="button" id="updateProductButton-{{ $payment->id }}"
                                    data-drawer-target="drawer-update-{{ $payment->id }}"
                                    data-drawer-show="drawer-update-{{ $payment->id }}"
                                    aria-controls="drawer-update-{{ $payment->id }}"
                                    data-drawer-placement="right"
                                    onclick="showUpdateModal('{{ $payment->id }}')"
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
                                <div id="drawer-update-{{ $payment->id }}"
                                    class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-[#09132A]"
                                    tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
                                    <h5 id="drawer-label"
                                        class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-[#AEB9E1]">
                                        Update Payment Status</h5>
                                    <button type="button"
                                        onclick="closeUpdateDrawer('{{ $payment->id }}')"
                                        data-drawer-dismiss="drawer-update-{{ $payment->id }}"
                                        aria-controls="drawer-update-{{ $payment->id }}"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close menu</span>
                                    </button>
                                    <form action="payments/{{ $payment->id }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="space-y-4 text-left">
                                            <div class="pb-4">
                                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primaryEx-600 focus:border-primaryEx-600 block w-full p-2.5 dark:bg-[#0B1739] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryEx-500 dark:focus:border-primaryEx-500">
                                                    <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="confirmed" {{ $payment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                    <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="left-0 flex justify-center w-full pt-10 pb-4 mt-4 space-x-4 sm:absolute sm:px-4 sm:mt-0">
                                            <button type="submit"
                                                class="w-full justify-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-blue-800">
                                                Update
                                            </button>
                                            <button type="button"
                                                onclick="closeUpdateDrawer('{{ $payment->id }}')"
                                                class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primaryEx-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-[#09132A] dark:text-gray-300 dark:border-[#CB3CFF] dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <button type="button"
                                    onclick="showStrukModal('{{ $payment->id }}')"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                    </svg>
                                    Cetak Struk
                                </button>

                                <!-- Modal Struk -->
                                <div id="strukModal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 backdrop-blur-sm">
                                    <div class="flex items-center justify-center min-h-screen p-4">
                                        <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-3xl w-full">
                                            <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Struk Pembayaran
                                                </h3>
                                                <button type="button" onclick="closeStrukModal()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div id="strukContent" class="p-6">
                                                <!-- Content will be loaded here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="p-4 text-center text-gray-500 dark:text-gray-400">
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
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $payments->count() }}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ $payments->total() }}</span></span>
    </div>
    <div class="flex items-center space-x-3">
        <a href="{{ ($payments->currentPage() == 1) ? $payments->url(1) : $payments->previousPageUrl() }}" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primaryEx-700 hover:bg-primaryEx-800 focus:ring-4 focus:ring-primaryEx-300 dark:bg-primaryEx-600 dark:hover:bg-primaryEx-700 dark:focus:ring-primaryEx-800">
            <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            Previous
        </a>
        <a href="{{ ($payments->currentPage() == $payments->lastPage()) ? $payments->url($payments->lastPage()) : $payments->nextPageUrl() }}" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primaryEx-700 hover:bg-primaryEx-800 focus:ring-4 focus:ring-primaryEx-300 dark:bg-primaryEx-600 dark:hover:bg-primaryEx-700 dark:focus:ring-primaryEx-800">
            Next
            <svg class="w-5 h-5 ml-1 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
        </a>
    </div>
</div>

<script>
    function showUpdateModal(paymentId) {
        const modal = document.getElementById(`drawer-update-${paymentId}`);
        if (modal) {
            modal.classList.remove('translate-x-full');
            modal.classList.add('translate-x-0');
            modal.setAttribute('aria-hidden', 'false');
        }
    }

    function closeUpdateDrawer(paymentId) {
        const drawer = document.getElementById(`drawer-update-${paymentId}`);
        if (drawer) {
            drawer.classList.add('translate-x-full');
            drawer.classList.remove('translate-x-0');
            drawer.setAttribute('aria-hidden', 'true');
        }
    }

    function closeDrawer() {
        document.getElementById('drawer-create-payment').classList.add('translate-x-full');
    }

    let currentImageUrl = '';

    function openImageModal(imageSrc) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        currentImageUrl = imageSrc;
        modalImage.src = imageSrc;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    async function downloadImage() {
        try {
            const response = await fetch(currentImageUrl);
            const blob = await response.blob();
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'payment-proof.jpg';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            document.body.removeChild(a);
        } catch (error) {
            console.error('Error downloading image:', error);
        }
    }

    // Close modal when clicking outside
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageModal();
        }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImageModal();
        }
    });

    async function showStrukModal(paymentId) {
        try {
            const response = await fetch(`/payments/${paymentId}/struk`);
            const data = await response.json();

            const modal = document.getElementById('strukModal');
            const content = document.getElementById('strukContent');

            content.innerHTML = data.html;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        } catch (error) {
            console.error('Error loading struk:', error);
        }
    }

    function closeStrukModal() {
        const modal = document.getElementById('strukModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('strukModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeStrukModal();
        }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeStrukModal();
        }
    });
</script>
@endsection