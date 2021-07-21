<section class="mt-4">

    <h1 class="font-bold text-3xl text-gray-800 mb-2">Valoración</h1>

    @can('enrolled', $course)
        <article class="mb-2">
            @can('valued', $course)
            
                <textarea wire:model="comment" class="form-input w-full" rows="3" placeholder="Ingrese una reseña del curso"></textarea>
                
                <div class="flex items-center">
                    <button class="btn btn-primary mr-2" wire:click="store">Guardar</button>
                    <ul class="flex">
                        <li class="mr-1 cursor-pointer" wire:click="$set('rating', 1)">
                            <i class="fas fa-star text-{{ $rating >=1 ? 'yellow':'gray' }}-300"></i>
                        </li>
                        <li class="mr-1 cursor-pointer" wire:click="$set('rating', 2)">
                            <i class="fas fa-star text-{{ $rating >=2 ? 'yellow':'gray' }}-300"></i>
                        </li>
                        <li class="mr-1 cursor-pointer" wire:click="$set('rating', 3)">
                            <i class="fas fa-star text-{{ $rating >=3 ? 'yellow':'gray' }}-300"></i>
                        </li>
                        <li class="mr-1 cursor-pointer" wire:click="$set('rating', 4)">
                            <i class="fas fa-star text-{{ $rating >=4 ? 'yellow':'gray' }}-300"></i>
                        </li>
                        <li class="mr-1 cursor-pointer" wire:click="$set('rating', 5)">
                            <i class="fas fa-star text-{{ $rating ==5 ? 'yellow':'gray' }}-300"></i>
                        </li>
                    </ul>
                </div>
            @else
                <div class=" flex items-center px-4 py-3 leading-normal text-blue-700 bg-blue-100 rounded-lg" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    <p>Usted ya ha valorado este curso</p>
                </div>
            @endcan
        </article>
    @endcan

    <div class="card">
        <div class="card-body">
            <p class="text-gray-800 text-xl">{{ $course->reviews->count() }} valoraciones</p>

            @forelse ($course->reviews as $review)
                <article class="flex mt-4 text-gray-800">
                    <figure>
                        <img src="{{ $review->user->profile_photo_url }}" alt="" class="h-12 w-12 object-cover rounded-full shadow-lg">
                    </figure>

                    <div class="card flex-1 ml-4">
                        <div class="card-body bg-gray-100">
                            <p><b>{{ $review->user->name }}</b> <i class="fas fa-star text-yellow-300 "></i> {{ $review->rating }}</p>
                            {{ $review->comment }}
                        </div>
                    </div>
                </article>
            @empty
                
            @endforelse
        </div>
    </div>
</section>
