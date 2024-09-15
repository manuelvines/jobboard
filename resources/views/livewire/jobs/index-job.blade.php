<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\Job;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

new 
#[Layout('layouts.app')]
#[Title('Empleos')]
class extends Component {
    
    public $search = '';


    public function with() 
    {
  
       $query = Job::query();

       if($this->search){
        $query->where('title', 'like', '%' . $this->search . '%');
       } 


       return [
        'jobs' => $query->paginate()
       ];
           
    }

    public function destroy(Job $job)
    {
        $job->delete();
      
    }


}; ?>

<div>
    <x-button class="mb-4" info  icon="plus" label="Agregar vacante" wire:navigate href="{{route('jobs.create')}}" />

    <x-input
    class="w-1/3 mb-4"
    icon="search"
    wire:model.live="search"
    label="Buscar vacante"
    placeholder="Buscar por título de la vacante"
    />
    
    <div class="relative mt-4 overflow-x-auto">
        <table class="w-full mb-4 text-sm text-left ">
            <thead class="text-xs ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                    Título
                    </th>
                    <th scope="col" class="px-6 py-3">
                    Rango
                    </th>
                    <th scope="col" class="px-6 py-3">
                    Úbicación
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                    Categoría 
                    </th> 
                    <th scope="col" class="px-6 py-3 text-center">
                    Postulantes
                    </th> 
                    <th scope="col" class="px-6 py-3 text-center">
                    Editar 
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                    Eliminar 
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job )
                    <tr wire:key="{{ $job->id }}" class="bg-white border-b ">
                    
                        <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap ">
                            {{ $job->title  }}
                        </th>
                        <td class="text-center" >
                            {{ $job->min_salary ?  $job->min_salary : ''  }} - {{ $job->max_salary ? $job->max_salary : ''  }}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap ">
                            {{ $job->country->name  }},  {{ $job->state->name  }}
                        </th>
                       
                     
                        
                      
                        <td class="text-center" >
                            {{ $job->category->name  }}
                        </td>

                        <td class="text-center" >
                            @if ($job->candidates->count() )
                                <x-button 
                                href="{{ route('candidates.show' , $job) }}" 
                                icon="eye"
                                info
                                label="Total: {{ $job->candidates->count()  }}" />    
                            @endif
                        </td>

                        <td class="text-center" >
                            <x-button.circle warning  icon="pencil" href="{{ route('jobs.edit', $job ) }}"   /> 
                        </td>

                        <td class="text-center" >
                            @if($job->candidates->count())
                             Esta vacante tiene postulantes
                            @else
                              <x-button.circle negative  icon="x"  wire:click="destroy('{{$job->id}}')"/> 
                            @endif
                        </td>

                    </tr>
                @endforeach
            
            </tbody>
        </table>
    </div>

   
</div>
