<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Lesson;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class LessonResources extends Component
{
    use WithFileUploads;

    public $lesson, $file;

    public function mount(Lesson $lesson){
        $this->lesson = $lesson;
    }

    public function render()
    {
        return view('livewire.instructor.lesson-resources');
    }

    public function save(){
        $this->validate([
            'file' => 'required',
        ]);

        // Movemos el archivo a la carpeta resources y guardamos la url
        $url = $this->file->store('resources');

        // Deacuerdo con la relacion de nuestra leccion creamos un recurso y guardamos solo la url del archivo
        $this->lesson->resource()->create([
            'url' => $url,
        ]);

        $this->lesson = Lesson::find($this->lesson->id);
    }

    public function destroy(){
        Storage::delete($this->lesson->resource->url);
        $this->lesson->resource->delete();

        $this->lesson = Lesson::find($this->lesson->id);
    }

    public function download(){
        return response()->download(storage_path('app/public/' . $this->lesson->resource->url ));
    }

}
