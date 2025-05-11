<x-nav>
</x-nav>
<h1>edit</h1>
<form method="POST" action="/product/{{ $product->id }}">

    @csrf
    @method('PATCH')
<div class="border-b border-gray-900/10 pb-12">
      <h2 class="text-base/7 font-semibold text-gray-900">Personal Information</h2>
     

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="name" class="block text-sm/6 font-medium text-gray-900">product name</label>
          <div class="mt-2">
            <input value="{{ $product["name"] }}" type="text" name="name" id="name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="quantity" class="block text-sm/6 font-medium text-gray-900">quantity</label>
          <div class="mt-2">
            <input value="{{ $product["quantity"] }}" type="text" name="quantity" id="quantity" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
           @error('quantity')
      <p class=" text-red-600">{{ $message }}</p>
        
      @enderror
        </div>

        <div class="sm:col-span-3">
          <label for="price" class="block text-sm/6 font-medium text-gray-900">price</label>
          <div class="mt-2">
            <input value="{{ $product["price"] }}" id="price" name="price" type="price" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
           @error('price')
      <p class=" text-red-600">{{ $message }}</p>
        
      @enderror
        </div>
        </div>
       

        


       
      </div>
    </div>
    @can('edit-product', $product)
      
    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    @endcan
</form>
