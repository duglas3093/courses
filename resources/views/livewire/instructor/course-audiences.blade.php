<section>

    <h1 class="font-bold text-2xl">AUDIENCIA DEL CURSO</h1>
    <hr class="mt-2 mb-6">

    @foreach ($course->audiences as $item)
        
        <article class="card mb-4">
            <div class="card-body">

                @if ($audience->id == $item->id)
                    <form wire:submit.prevent="update">
                        <input wire:model="audience.name" class="form-input w-full">
                        @error('audience.name')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </form>
                @else
                    
                    <header class="flex justify-between">
                        <h1>{{ $item->name }}</h1>
                        <div>
                            <i wire:click="edit({{ $item }})" class="fas fa-edit text-blue-500 cursor-pointer"></i>
                            <i wire:click="destroy({{ $item }})" class="fas fa-trash text-red-500 cursor-pointer"></i>
                        </div>
                    </header>
                    
                @endif
            </div>
        </article>

    @endforeach

    <article class="card">
        <div class="card-body">
            <form wire:submit.prevent="store">
                <input wire:model="name" class="form-input w-full" placeholder="Agrega la audiencia del curso">
                @error('name')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror

                <div class="flex justify-end mt-2">
                    <button type="submit" class="btn btn-primary">
                        Agregar una audiencia
                    </button>
                </div>
            </form>
        </div>
    </article>

</section>
