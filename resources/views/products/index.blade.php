@extends('layouts.master')

@section('title', 'My Products')

@section('main')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">My Products</h1>
        <a href="{{ route('products.create') }}" class="!bg-primary-600 text-white px-4 py-2 rounded-lg hover:!bg-primary-700 transition-colors">
            Add New Product
        </a>
    </div>

    @if($products->isEmpty())
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-gray-600">You haven't added any products yet.</p>
            <a href="{{ route('products.create') }}" class="inline-block mt-4 text-primary-600 hover:text-primary-700">
                Add your first product
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h2>
                        <p class="text-gray-600 text-sm mt-1">{{ $product->category->name }}</p>
                        <p class="text-primary-600 font-semibold mt-2">Rp {{ number_format($product->price) }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($product->status === 'active') bg-green-100 text-green-800
                                @elseif($product->status === 'inactive') bg-gray-100 text-gray-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($product->status) }}
                            </span>
                            <div class="flex space-x-2">
                                <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-800">
                                    Edit
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-danger text-red-600 hover:text-red-800" onclick="return confirm('Are you sure you want to delete this product?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection 