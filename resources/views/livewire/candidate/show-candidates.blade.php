<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\Job;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use App\Models\Candidate;
use Illuminate\Support\Facades\Storage;

new
#[Layout('layouts.app')]
#[Title('Empleos')]
class extends Component {
  use WithPagination;
  
  public Job $job;

  public $search = '';

  public function mount(Job $job){
    $this->job = $job;
  }

  public function with(){


    $query = Candidate::query()->where('job_id', $this->job->id);

    if($this->search){
      $query->where('name', 'like', '%' . $this->search . '%');
    }



    return [
      'candidates' => $query->paginate()
    ];
  
  }


    public function destroy(Candidate $candidate)
    {


        Storage::delete('storage/' . $candidate->resume);
        $candidate->delete();
    }

}; ?>

<div>
    
    
    <h1 class="mb-7 font">
    Postulaciones para la vacante:    {{ $job->title }}
    </h1>
   

    <x-input
    class="w-1/3 mb-4"
    icon="search"
    wire:model.live="search"
    label="Buscar candidato"
    placeholder="Buscar por nombre, correo"
    />
    
    <div class="relative mt-4 overflow-x-auto">
        <table class="w-full mb-4 text-sm text-left ">
            <thead class="text-xs ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                    Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                    Correo
                    </th>
                    <th scope="col" class="px-6 py-3">
                    Teléfono
                    </th>
                    <th scope="col" class="px-6 py-3">
                    Fecha de nacimento
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                    Linkdln 
                    </th> 
                    <th scope="col" class="px-6 py-3 text-center">
                    CV
                    </th> 
                   
                    <th scope="col" class="px-6 py-3 text-center">
                    Eliminar 
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidates as $candidate )
                    <tr wire:key="{{ $candidate->id }}" class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap ">
                            {{ $candidate->name  }}
                        </th>
                        <td class="text-center" >
                            {{ $candidate->email  }}
                        </td>
                        <td class="text-center" >
                            {{ $candidate->phone  }}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap ">
                            {{ $candidate->birthdate  }}
                        </th>
                        <td class="text-center" >
                            <x-button 
                            href="{{ $candidate->linkedin }}" 
                            target="_blank"
                            icon="eye"
                            info
                            label="Ver Linkdln" />  
                        </td>
                        <td class="text-center" >
                            <x-button 
                            href="{{ asset( 'storage/' . $candidate->resume ) }}" 
                            icon="eye"
                            red
                            label="Ver CV" />  
                        </td>
                        <td class="text-center" >
                            <x-button.circle negative  icon="x"  wire:click="destroy('{{$candidate->id}}')"   />
                        </td>
                    </tr>
                @endforeach
            
            </tbody>
        </table>

        <div class="mt-4">
            {{ $candidates->links() }}
        </div>    
    </div>
</div>
