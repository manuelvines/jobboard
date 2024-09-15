<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\Attributes\{Layout, Title};
use App\Models\Country;
use App\Models\State;
use App\Models\Job;


new 
#[Layout('layouts.public')]
#[Title('Bolsa de empleo DKT')]
class extends Component {

 
    public Job $job;
    
    public $countryId;

    public $stateId;

    public $states = [];


    public function updatedCountryId(){
        
        $this->stateId = null;
        $this->states = State::where('country_id', $this->countryId)->get();
        
    }


    public function getJobs(){
        
          $this->render();
    }

    public function with()
    {

        $query = Job::query();

        if ($this->countryId) {
            $query->where('country_id', $this->countryId);
        }
        
        if ($this->countryId && $this->stateId) {
           $query->where('country_id', $this->countryId)
                  ->where('state_id', $this->stateId);
        }

        return ( [
            'countries' => Country::all(),
            'jobs' => $query->paginate(),
            'states' => $this->states,
        ]);
    }


   
  
}; ?>

<div>


  

    <div class="flex flex-col items-center justify-center px-5 py-5 bg-opacity-50 bg-center bg-no-repeat bg-cover h-96"
     style="background-image: url('{{ asset('assets/img/banner.png'); }}');  
     background-size:cover; ">
       
          
            <h1 class="text-6xl font-bold text-white">Bolsa de empleo DKT </h1>
            <p class="text-white">Encuentra el empleo que buscas</p>

            <form wire:submit="getJobs" class="flex gap-5 p-2 mt-4 bg-white rounded-md " action="" method="POST">

              <x-native-select label=""   wire:model.live="countryId">}
                  <option value="">Selecciona una opción</option>
                  @foreach ( $countries as $country )
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                  @endforeach
              </x-native-select>

              <x-native-select label=""   wire:model.blur="stateId">
                  <option value="">Selecciona una opción</option>
                  @foreach ( $states as $state )
                  <option value="{{ $state->id }}">{{ $state->name }}</option>
                  @endforeach
              </x-native-select>

              <x-button  type="submit"  icon="search" info label="Buscar" />

              
            </form>
          
         
    </div>


    <div class="w-3/4 mx-auto my-5 ">

        
          @forelse ($jobs as $job )
          <div class="p-6 mb-8 bg-white border border-gray-200 rounded-lg shadow ">
          
            <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $job->title  }}</h5>    
            <p class="font-normal text-gray-500 dark:text-gray-400">
              {{ $job->country->name }}, {{ $job->state->name }}
            </p>
            <p class="mt-2">
              
              {!! $job->excerpt() !!}

            </p>

            @if($job->show_salary == 1)
              <p class="text-sm font-normal text-gray-400 dark:text-gray-400">
                Rango: {{ $job->salaryRange() }}
              </p>
            @endif

            <div class="mt-3">
              <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $job->modality->name }}</span>
              <span class="bg-indigo-100 text-indigo-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300">{{ $job->category->name }}</span>
            </div>

            <a href="{{ route('job.show', $job ) }}" class="inline-flex items-center mt-3 font-medium text-blue-600 hover:underline">
              Aplicar a vacante
              <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778"/>
              </svg>
            </a>

          </div>
          @empty
                <h3>No encontramos resultados para tu búsqueda</h3>
                <p>Puedes dejar tus datos para cuando tengamos una vacante para ti.</p>  
          @endforelse
 
    </div>


</div>
