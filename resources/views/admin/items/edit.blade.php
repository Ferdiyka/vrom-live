<x-app-layout>
  <x-slot name="title">Admin</x-slot>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      <a href="#!" onclick="window.history.go(-1); return false;">
        ←
      </a>
      Item &raquo; Edit &raquo; #{{$item->id}}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div>
        @if ($errors->any())
          <div class="mb-5" role="alert">
            <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
              Error!
            </div>
            <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
              <p>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
              </p>
            </div>
          </div>
        @endif
        <form class="w-full" action="{{ route('admin.items.update', $item->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          {{-- Input Nama --}}
          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                Nama*
              </label>
              <input value="{{ old('name') ?? $item->name }}" name="name"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 border border-gray-200 rounded appearance-none bg-white-200 focus:outline-none focus:bg-white focus:border-gray-500"
                     id="grid-last-name" type="text" placeholder="Nama" required>
              <div class="mt-2 text-sm text-gray-500">
                Contoh: Item 1. Maksimal 255 karakter. Wajib diisi
              </div>
            </div>
          </div>

          {{-- DropDown Brand --}}
          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                Brand
              </label>
              <select name="brand_id" class="block w-full px-4 py-3 leading-tight text-gray-700 border border-gray-200 rounded appearance-none cursor-pointer bg-white-200 focus:outline-none focus:bg-white focus:border-gray-500" required>
                <option value="{{$item->brand->id}}" selected>Tidak Diubah ({{$item->brand->name}}) </option>
                <option disabled>------------------</option>
                @foreach ($brands as $brand)
                <option value="{{$brand->id}}" {{old('brand_id') == $brand->id ? 'selected' : ''}}>
                    {{$brand->name}}
                </option>
                @endforeach
              </select>
              <div class="mt-2 text-sm text-gray-500">
                Contoh: Tesla. Optional
              </div>
            </div>
          </div>

          {{-- DropDown Type --}}
          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                Type
              </label>
              <select name="type_id" class="block w-full px-4 py-3 leading-tight text-gray-700 border border-gray-200 rounded appearance-none cursor-pointer bg-white-200 focus:outline-none focus:bg-white focus:border-gray-500" required>
                <option value="{{$item->type->id}}" selected>Tidak Diubah ({{$item->type->name}}) </option>
                <option disabled>------------------</option>
                @foreach ($types as $type)
                <option value="{{$type->id}}" {{old('type_id') == $type->id ? 'selected' : ''}}>
                    {{$type->name}}
                </option>
                @endforeach
              </select>
              <div class="mt-2 text-sm text-gray-500">
                Contoh: Standar Range. Optional
              </div>
            </div>
          </div>

          {{-- Input Fitur --}}
          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                Fitur
              </label>
              <input value="{{ old('features') ?? $item->features }}" name="features"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 border border-gray-200 rounded appearance-none bg-white-200 focus:outline-none focus:bg-white focus:border-gray-500"
                     id="grid-last-name" type="text" placeholder="Fitur">
              <div class="mt-2 text-sm text-gray-500">
                Contoh: Fitur 1, Fitur 2, Fitur 3. Jika fitur lebih dari 1 wajib gunakan tanda koma (,). Optional
              </div>
            </div>
          </div>

          {{-- Input Foto Item --}}
          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                Foto
              </label>
              <input name="photos[]"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 border border-gray-200 rounded appearance-none bg-white-200 focus:outline-none focus:bg-white focus:border-gray-500"
                     id="grid-last-name"
                     accept="image/jpg, image/png, image/jpeg, image/webp"
                     type="file" multiple>
              <div class="mt-2 text-sm text-gray-500">
                Bisa upload multiple foto. Optional
              </div>
            </div>
          </div>

          {{-- Input Harga, Rating, Review Item --}}
          <div class="grid grid-cols-3 gap-3 px-3 mt-4 mb-6 -mx-3">
            {{-- Input Harga --}}
            <div class="w-full">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                    Harga*
                </label>
                <input value="{{ old('price') ?? $item->price }}" name="price"
                        class="block w-full px-4 py-3 leading-tight text-gray-700 border border-gray-200 rounded appearance-none bg-white-200 focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-last-name" type="number" placeholder="Harga" required>
                <div class="mt-2 text-sm text-gray-500">
                    Contoh: 1000000. Wajib diisi
                </div>
            </div>
            {{-- Input Rating --}}
            <div class="w-full">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                    Rating
                </label>
                <input value="{{ old('star') ?? $item->star }}" name="star"
                        class="block w-full px-4 py-3 leading-tight text-gray-700 border border-gray-200 rounded appearance-none bg-white-200 focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-last-name" type="number" placeholder="Rating" required min="1" max="5" step=".01">
                <div class="mt-2 text-sm text-gray-500">
                    Contoh: 4,5. Optional
                </div>
            </div>
            {{-- Input Review --}}
            <div class="w-full">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                    Review
                </label>
                <input value="{{ old('review') ?? $item->review }}" name="review"
                        class="block w-full px-4 py-3 leading-tight text-gray-700 border border-gray-200 rounded appearance-none bg-white-200 focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-last-name" type="number" placeholder="Review">
                 <div class="mt-2 text-sm text-gray-500">
                    Contoh: 1. Optional
                 </div>
            </div>
          </div>

          <div class="flex flex-wrap mb-6 -mx-3">
            <div class="w-full px-3 text-right">
              <button type="submit"
                      class="px-4 py-2 font-bold text-white bg-blue-500 rounded shadow-lg hover:bg-blue-700">
                Simpan Item
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
