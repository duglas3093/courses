<x-instructor-layout :course="$course">
    {{-- <x-slot name="course">
        {{ $course->slug }}
    </x-slot> --}}

    <div>
        @livewire('instructor.course-goals', ['course' => $course], key('courses-goals' . $user->id))
    </div>

    <div class="my-8">
        @livewire('instructor.course-requirements', ['course' => $course], key('courses-requirements' . $user->id))
    </div>
    
    <div class="my-8">
        @livewire('instructor.course-audiences', ['course' => $course], key('course-audiences'.$user->id))
    </div>
    

</x-instructor-layout>