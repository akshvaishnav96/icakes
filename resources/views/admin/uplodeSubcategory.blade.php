@extends('layout.main')

@section('main-section')
    <div class="mx-auto w-full max-w-[550px] bg-white my-5">

        <form class="py-6 px-9" action="{{ $url }}" method="post">
            @csrf
            @method($method)
            @if ($errors->has('err'))
                <x-input label="enter subcategory name" id="cake_subcategorys" type="text" name="subcategory_name"
                    placeholder="enter subcategoryname" valuetext="{{ old('subcategoryname') }}" redClass="border-red-500" />
            @else
                <x-input label="enter subcategory name" id="cake_subcategorys" type="text" name="subcategory_name"
                    placeholder="enter subcategoryname" valuetext="{{ isset($oldsubcategory) ? $oldsubcategory : '' }}"
                    redClass="border-red-100" />
            @endif
            @error('err')
                <span class=" my-2 text-red-500">{{ $message }}</span>
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
                                @isset($oldcategory){{ $oldcategory === $category['category_name'] ? 'selected' : '' }} @endisset>
                                {{ $category['category_name'] }}</option>
                        @endforeach
                    </select>
                </label>
            @endisset



            <button
                class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                {{ $buttontext }}
            </button>

        </form>
        @foreach ($subcategory as $key => $subcategory)
            <div
                class="flex flex-col p-8 bg-white shadow-md hover:shodow-lg rounded-2xl my-3 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                <div class=" flex items-center justify-between" id="showsubcategorys">
                    <div class="flex items-center">

                        <div class="flex flex-col ml-3">
                            <a class="text-xl font-semibold text-gray-800"></a>
                            <div class="font-medium underline leading-none">subcategory Name:
                                {{ $subcategory->subcategory_name }}
                            </div>
                            <div class="font-medium leading-none text-red-500 my-2">Category : {{ $subcategory->category }}
                            </div>
                            </p>
                        </div>
                    </div>
                    <a href ="/subcategory/edit/{{ $subcategory->subcategory_id }}"><button id ="uplodesubcategoryEditBtn"
                            class="flex-no-shrink bg-blue-500 px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-blue-500 text-white rounded-full">Edit</button></a>
                    <a href = "/subcategory/{{ $subcategory->subcategory_id }}"> <button id ="uplodesubcategoryDelete Btn"
                            class="flex-no-shrink bg-red-500 px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-red-500 text-white rounded-full">Delete</button></a>
                </div>


                {{-- ------------ --}}



            </div>
        @endforeach


    </div>

    <!-- component -->


    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
        style="background-image: url(https://images.unsplash.com/photo-1623600989906-6aae5aa131d4?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1582&q=80);"
        id="modal-id">
        <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div class="">
                <!--body-->
                <div class="text-center p-5 flex-auto justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-red-500 mx-auto"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <h2 class="text-xl font-bold py-4 ">Are you sure?</h3>
                        <p class="text-sm text-gray-500 px-8">Do you really want to delete your account?
                            This process cannot be undone</p>
                </div>
                <!--footer-->
                <div class="p-3  mt-2 text-center space-x-4 md:block">
                    <button
                        class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                        Cancel
                    </button>
                    <button
                        class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection