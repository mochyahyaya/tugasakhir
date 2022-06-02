<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Monitoring Penginapan Hewan
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white sm:rounded-lg">
            <div class="p-6">
                <div class="flex px-4 py-3 sm:px-6">
                 <div class="flex-1 float-left">
                     Kembali
                 </div>
                </div>

            <form wire:submit.prevent="store">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                 <div class="block ml-2">
                                     <span class="text-gray-700">Makan</span>
                                     <div class="mt-2">
                                         <div wire:model="food">
                                             @foreach ($enumfood as $item)
                                             <div>
                                                 <label class="inline-flex items-center">
                                                     <input
                                                         type="radio"
                                                         class="form-radio"
                                                         name="food"
                                                         value="{{ $item }}"
                                                     />
                                                     <span class="ml-2">{{ $item}}</span>
                                                 </label>
                                             </div>
                                             @endforeach
                                         </div>
                                     </div>
                                 </div>
                                 @error('food') <span class="error">{{ $message }}</span> @enderror
                                 <div class="block ml-2">
                                     <span class="text-gray-700">Suhu Badan</span>
                                     <div class="mt-2">
                                         <div wire:model="temperature">
                                             @foreach ($enumtemperature as $item)
                                             <div>
                                                 <label class="inline-flex items-center">
                                                     <input
                                                         type="radio"
                                                         class="form-radio"
                                                         name="temperature"
                                                         value="{{ $item }}"
                                                     />
                                                     <span class="ml-2">{{ $item}}</span>
                                                 </label>
                                             </div>
                                             @endforeach
                                         </div>
                                     </div>
                                 </div>
                                 @error('temperature') <span class="error">{{ $message }}</span> @enderror
                                 <div class="block ml-2">
                                     <span class="text-gray-700">Obat</span>
                                     <div class="mt-2">
                                         <div wire:model="medicine">
                                             @foreach ($enummedicine as $item)
                                                 <div>
                                                     <label class="inline-flex items-center">
                                                         <input
                                                             type="radio"
                                                             class="form-radio"
                                                             name="medicine"
                                                             value="{{ $item }}"
                                                         />
                                                         <span class="ml-2">{{ $item}}</span>
                                                     </label>
                                                 </div>
                                             @endforeach
                                         </div>
                                     </div>
                                 </div>
                                @error('medicine') <span class="error">{{ $message }}</span> @enderror
                                <div class="mt-4" wire:ignore>
                                    <label for="notes">Catatan</label>
                                    <textarea wire:model.debounce.800ms="notes" id="notes"></textarea>
                                    @error('notes') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="mt-4">
                                    <x-jet-label for="gallery" value="{{ __('Foto') }}" />
                                    <x-jet-input id="photo" class="block mt-1 w-full" type="file" wire:model.debounce.800ms="photo" enctype="multipart/form-data" />
                                    @error('photo.*') <span class="error">{{ $message }}</span> @enderror
                                  </div>
                                <div class="mt-4">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-black border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
                 <div class="mt-5">

                 </div>
             </div>
        </div>
    </div>
  </div>
  @section('scripts')
  <script>
    ClassicEditor
      .create(document.querySelector('#notes'))
      .then(editor => {
          editor.model.document.on('change:data', () => {
          @this.set('notes', editor.getData());
         })
      })
      .catch(error => {
         console.error(error);
      });
</script>

<script>
    window.addEventListener('swal:modal', event=>
    {
      Swal.fire({
        icon: event.detail.icon,
        iconcolor: event.detail.iconcolor,
        title: event.detail.title,
        text: event.detail.text,
        showConfirmButton: false,
        timer: 1500,
      });
    });
</script>
  @endsection
