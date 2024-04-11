@extends('layout.main')

@push('title')
    <title>Uplode Cake</title>
@endpush

@section('main-section')

    <br>



    <div class="flex items-center justify-center p-12">

        <div class="mx-auto w-full max-w-[550px] bg-white">
            <form class="py-6 px-9" action="{{ Route('cake.post') }}" method="POST" enctype="multipart/form-data">
                @csrf


                @if ($errors->has('cakename'))
                    <x-input label="Enter cake name" id="cake_name" type="text" redClass="border-red-500" name="cakename"
                        valuetext="{{ old('cakename') }}" placeholder="enter cake name" />
                @else
                    <x-input label="Enter cake name" id="cake_name" type="text" redClass="border-red-100" name="cakename"
                        valuetext="{{ old('cakename') }}" placeholder="enter cake name" />
                @endif

                @error('cakename')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror


                @if ($errors->has('productId'))
                    <x-input label="Enter product id" id="product_id" redClass="border-red-500" type="number"
                        name="productId" valuetext="{{ old('productId') }}" placeholder="enter product id" />
                @else
                    <x-input label="Enter product id" id="product_id" redClass="border-red-100" type="number"
                        name="productId" valuetext="{{ old('productId') }}" placeholder="enter product id" />
                @endif

                @error('productId')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror








                @isset($categorys)
                    <label class="mb-5 block text-xl font-semibold text-[#07074D]">
                        Select Cake Category<span class="text-red-500">*</span>
                        <select
                            class="w-full my-3 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none "
                            name="category_name" id="">
                            @foreach ($categorys as $category)
                                <option
                                    class=" bg-gray-200 text-black-500 hover:bg-blue-500 hover:text-white cursor-pointer my-2 p-3 focus:bg-blue-700 "
                                    value="{{ $category['category_name'] }}"
                                    {{ old('category_name') == $category['category_name'] ? 'selected' : '' }}>
                                    {{ $category['category_name'] }}</option>
                            @endforeach
                        </select>
                    </label>
                @endisset
                @error('category_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror


                @isset($subcategory)
                    <label class="mb-5 block text-xl font-semibold text-[#07074D]">
                        Select Subcategory's<span class="text-red-500">*</span>
                        <select
                            class="w-full my-3 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none "
                            name="subcategory_ids[]" id="" multiple>
                            @foreach ($subcategory as $subcategory)
                                <option
                                    class="bg-gray-200 text-black-500 hover:bg-blue-500 hover:text-white cursor-pointer my-2 p-3 "
                                    value="{{ $subcategory['subcategory_id'] }}"
                                    {{ old('subcategory_id') == $subcategory['subcategory_id'] ? 'selected' : '' }}>
                                    {{ $subcategory['subcategory_name'] }}</option>
                            @endforeach
                        </select>
                    </label>
                @endisset

                @error('subcategory_ids')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror


                @isset($tags)
                    <label class="mb-5 block text-xl font-semibold text-[#07074D]">
                        Select Cake Tags<span class="text-red-500">*</span>
                        <select
                            class="w-full my-3 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none "
                            name="tag_ids[]" id="" multiple>
                            @foreach ($tags as $tag)
                                <option
                                    class="bg-gray-200 text-black-500 hover:bg-blue-500 hover:text-white cursor-pointer my-2 p-3 "
                                    value="{{ $tag['tag_id'] }}" {{ old('tag_id') == $tag['tag_id'] ? 'selected' : '' }}>
                                    {{ $tag['tag_name'] }}</option>
                            @endforeach
                        </select>
                    </label>
                @endisset

                @error('tag_ids')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror


                @isset($cakesizewithprice)
                    <label class="mb-5 block text-xl font-semibold text-[#07074D]">
                        Select size's with Price's<span class="text-red-500">*</span>
                        <select
                            class="w-full my-3 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none "
                            name="cake_size_with_prices_ids[]" id="" multiple>
                            @foreach ($cakesizewithprice as $cakesizewithprice)
                                <option
                                    class="bg-gray-200 text-black-500 hover:bg-blue-500 hover:text-white cursor-pointer my-2 p-3 "
                                    value="{{ $cakesizewithprice['cake_size_with_prices_id'] }}"
                                    {{ old('cake_size_with_prices_id') == $cakesizewithprice['cake_size_with_prices_id'] ? 'selected' : '' }}>
                                    {{ $cakesizewithprice['tier_name'] }} tier ({{ $cakesizewithprice['size_name'] }} )
                                    ({{ $cakesizewithprice['price'] }}$)
                                </option>
                            @endforeach
                        </select>
                    </label>
                @endisset

                @error('cake_size_with_prices_ids')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror



                @isset($flavorwithprice)
                    <label class="mb-5 block text-xl font-semibold text-[#07074D]">
                        Select flavor's with Price's<span class="text-red-500">*</span>
                        <select
                            class="w-full my-3 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none "
                            name="flavor_with_prices_ids[]" id="" multiple>
                            @foreach ($flavorwithprice as $flavorwithprice)
                                <option
                                    class="bg-gray-200 text-black-500 hover:bg-blue-500 hover:text-white cursor-pointer my-2 p-3 "
                                    value="{{ $flavorwithprice['flavor_with_prices_id'] }}"
                                    {{ old('flavor_with_prices_id') == $flavorwithprice['flavor_with_prices_id'] ? 'selected' : '' }}>
                                    {{ $flavorwithprice['flavor_name'] }} ({{ $flavorwithprice['flavor_price'] }}$ )

                                </option>
                            @endforeach
                        </select>
                    </label>
                @endisset

                @error('flavor_with_prices_ids')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror





                @if ($errors->has('discount'))
                    <x-input label="Enter Discount" id="cake_discount" redClass="border-red-500" type="number"
                        name="discount" valuetext="{{ old('discount') }}" placeholder="enter discount" />
                @else
                    <x-input label="Enter Discount" id="cake_discount" redClass="border-red-100" type="number"
                        name="discount" valuetext="{{ old('discount') }}" placeholder="enter discount" />
                @endif

                @error('discount')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror







                <div class="mb-6 pt-4 ">

                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Upload
                        files</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="file_input" type="file" name="images[]" multiple required>








                </div>
                <button
                    class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                    Send File
                </button>
        </div>
        </form>
    </div>
    </div>



    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.4/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>

@endsection
