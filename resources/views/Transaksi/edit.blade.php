@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg mt-10">
    <h2 class="text-2xl font-semibold text-center mb-6">Edit Transaksi</h2>

    <form action="{{ route('transaksi.update', $transaksi->ID_Transaksi) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- ID User --}}
        <div class="mb-4">
            <label for="ID_User" class="block text-sm font-medium text-gray-700">ID User</label>
            <select class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" name="ID_User" id="ID_User" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $transaksi->ID_User == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tanggal --}}
        <div class="mb-4">
            <label for="Tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
            <input type="date" class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" name="Tanggal" value="{{ $transaksi->Tanggal }}" required>
        </div>

        {{-- Status Pembayaran --}}
        <div class="mb-4">
            <label for="Status_Pembayaran" class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
            <select class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" name="Status_Pembayaran" required>
                <option value="pending" {{ $transaksi->Status_Pembayaran == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ $transaksi->Status_Pembayaran == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="canceled" {{ $transaksi->Status_Pembayaran == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>

        {{-- Tombol Update --}}
        <div class="mt-6 flex justify-center">
            <button type="submit" class="w-full bg-indigo-500 text-black py-2 px-4 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Update Transaksi
            </button>
        </div>
    </form>
</div>
@endsection
