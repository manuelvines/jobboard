<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\Job;


new 

#[Layout('layouts.public')]
#[Title('Aplicar a oferta de empleo')]
class extends Component {
    //

    public Job $job;



    public function mount(Job $job)
    {
        $this->job = $job;
    }

}; ?>

<div class="w-10/12 pt-5 mx-auto" x-data>
    <div class="p-6 mb-8 bg-white border border-gray-200 rounded-lg shadow ">

        <a wire:navigate href="{{ url()->previous() }}" class="text-gray-400">
        Regresar
        </a>
        
       
        <h5 class="mt-3 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $job->title  }}</h5>    

        <p class="font-normal text-gray-500 dark:text-gray-400">
            {{ $job->country->name }}, {{ $job->state->name }}
        </p>

        @if ($job->show_salary)
        <p class="font-normal text-gray-500 dark:text-gray-400">
            {{ $job->salaryRange() }}
        </p>  
        @endif

          <div class="mt-3">
            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $job->modality->name }}</span>
            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $job->category->name }}</span>
          </div>


          <livewire:components.utils.modal :job=$job>


          <h5 class="mt-4 text-xl font-semibold tracking-tight text-gray-900 text-md dark:text-white">
            Detalles:  
          </h5>  
          <p><strong>Tipo: </strong>{{ $job->type->name }}</p>
          <p><strong>Nivel educativo: </strong>{{ $job->education->name }}</p>
          <p><strong>Modalidad:</strong> {{ $job->modality->name  }}</p>

          <h5 class="mt-3 text-xl font-semibold tracking-tight text-gray-900 text-md dark:text-white">
          Descripción de la vacante:  
          </h5>    

          {!! $job->description !!}

    </div>




  
</div>
