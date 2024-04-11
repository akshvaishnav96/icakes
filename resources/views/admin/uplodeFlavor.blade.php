    {{-- 
    flavor_name 
    flavor_description	
    flavor_ingredients 
    flavor_image
     --}}



    @extends('layout.main')

    @push('title')
        <title>Cake flovors</title>
    @endpush

    @section('main-section')
        <div class="mx-auto w-full max-w-[550px] bg-white my-5">


            <form class="py-6 px-9 my-3" action="{{ $url }}" method="post" enctype="multipart/form-data">
                @csrf
                @method($method)


                {{-- @if ($errors->has('err'))
                    <x-input label="Flavor name" id="flavor" type="text" name="flavor_name" placeholder="flavor name "
                        valuetext="{{ old('flavor_name ') }}" redClass="border-red-500" />
                @else
                    <x-input label="Flavor name" id="flavor" type="text" name="flavor_name" placeholder="flavor name "
                        valuetext="{{ old('flavor_name ') }}" redClass="border-red-100" />
                @endif
                @error('err')
                    <span class=" my-2 text-red-500">{{ $message }}</span>
                @enderror


                @if ($errors->has('err'))
                    <x-input label="flavor description" id="flavor_description" type="text" name="flavor_description"
                        placeholder="flavor description " valuetext="{{ old('flavor_description ') }}"
                        redClass="border-red-500" />
                @else
                    <x-input label="flavor description" id="flavor_description" type="text" name="flavor_description"
                        placeholder=" description " valuetext="{{ old('flavor_description ') }}"
                        redClass="border-red-100" />
                @endif
                @error('err')
                    <span class=" my-2 text-red-500">{{ $message }}</span>
                @enderror --}}





                <x-input label="flavor" id="flavor" type="text" name="flavor_name" placeholder="flavor name "
                    valuetext="{{ isset($flavor_name) ? $flavor_name : old('flavor_name') }}"
                    redClass="{{ $errors->has('flavor_name') ? 'border-red-500' : 'border-red-100' }}" />
                {{-- <x-input label="flavor" id="flavor" type="text" name="flavor_name" placeholder="flavor name "
                        valuetext="{{ isset($flavor_name) ? $flavor_name : '' }}" redClass="border-red-100" /> --}}

                @error('flavor_name')
                    <span class="text-red-500"> {{ $message }}</span>
                @enderror


                <x-input label="flavor_description" id="flavor_description" type="text" name="flavor_description"
                    placeholder="flavor description "
                    valuetext="{{ isset($flavor_description) ? $flavor_description : old('flavor_description') }}"
                    redClass="{{ $errors->has('flavor_description') ? 'border-red-500' : 'border-red-100' }}" />
                @error('flavor_description')
                    <span class="text-red-500"> {{ $message }}</span>
                @enderror

                <x-input label="flavor_ingredients" id="flavor_ingredients" type="text" name="flavor_ingredients"
                    placeholder="flavor ingredients "
                    valuetext="{{ isset($flavor_ingredients) ? $flavor_ingredients : old('flavor_ingredients') }}"
                    redClass="{{ $errors->has('flavor_ingredients') ? 'border-red-500' : 'border-red-100' }}" />
                @error('flavor_ingredients')
                    <span class="text-red-500"> {{ $message }}</span>
                @enderror

                <x-input label="flavor_image" id="flavor_image" type="file" name="flavor image"
                    placeholder="flavor image " valuetext="" redClass="border-red-100" accept="image/jpg,svg,png,jpeg" />

                @error('flavor_image')
                    <span class="text-red-500"> {{ $message }}</span>
                @enderror

                <button
                    class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                    {{ $buttontext }}
                </button>

            </form>


            @foreach ($flavor as $flavor)
                <div class="max-w-sm w-full lg:max-w-full lg:flex my-5">
                    <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden"
                        style="background-image: url({{ asset('/storage') }}/{{ $flavor['flavor_image'] }})"
                        title="Woman holding a mug">
                    </div>
                    <div
                        class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                        <div class="mb-8">

                            <div class="text-gray-900 font-bold text-xl mb-2">{{ $flavor['flavor_name'] }}</div>
                            <p class="text-gray-700 text-base">{{ $flavor['flavor_description'] }}
                            </p>
                        </div>
                        <div class="flex items-center">
                            <div class="text-sm">
                                <p class="text-gray-900 text-xl"> Major Ingredients:</p>
                                <p class="text-gray-500 leading-none my-2">{{ $flavor['flavor_ingredients'] }}</p>
                                <a href ="/flavor/edit/{{ $flavor->flavor_id }}"><button id ="uplodesizeEditBtn"
                                        class="flex-no-shrink bg-blue-500 px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-blue-500 text-white rounded-full">Edit</button></a>
                                <a href = "/flavor/{{ $flavor->flavor_id }}"> <button id ="uplodesizeDelete Btn"
                                        class="flex-no-shrink bg-red-500 px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-red-500 text-white rounded-full">Delete</button></a>
                            </div>
                        </div>
                    </div>

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
