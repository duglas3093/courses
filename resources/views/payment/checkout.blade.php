<x-app-layout>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-12">
        <h1 class="text-gray-500 text-1xl font-bold">Detalle del pedido</h1>

        <div class="card text-gray-600">
            <div class="card-body">

                <article class="flex items-center">
                    <img class="h-12 w-12 object-cover rounded-full shadow-lg" src="{{ Storage::url($course->image->url) }}" alt="">
                    <h1 class="text-lg ml-2">{{ $course->title }}</h1>
                    <p class="text-xl font-bold ml-auto">US$ {{ $course->price->value }}</p>
                </article>

                <div class="flex justify-end mt-2">
                    <a class="btn btn-primary" href="">Comprar este curso</a>
                </div>
                <hr class="my-4">
            </div>
            <p class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, consequatur? Quaerat sequi rem ullam tempora, minus, blanditiis optio, maiores harum corporis aperiam fuga dolore? Assumenda praesentium culpa itaque asperiores? Non. <a href="" class="text-red-500 font-bold">Terminos y condiciones</a></p>
        </div>
    </div>ap
</x-app-layout>