<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Models\Job;
use App\Models\Candidate;

new class extends Component {
    //

    use WithFileUploads;

    
    public Job $job;

    #[Validate('required')] 
    public $name;

    #[Validate('required', 'email')]
    public $email;

    #[Validate('required')] 
    public $phone;

    #[Validate('nullable')]
    #[Validate('date')]
    public $birthday;
 
    #[Validate('required')] 
    #[Validate('mimes:pdf',message:'El archivo debe ser pdf')] // PDF Only
    #[Validate('max:1024',message:'El archivo debe ser pdf con peso máx de 1MB')] // 1MB Max
    public $resume;

    #[Validate('required')] 
    public $linkedin;

    
    public function mount(Job $job){
        $this->job = $job;
    }


    

    public function save(){

        $this->validate();
    
        $filename = strtoupper(str_replace(' ', '-', $this->name)).'-CV.pdf';

        $this->resume->storeAs(path: 'public', name: $filename);

        Candidate::create([
            'name'       => $this->name,
            'email'      => $this->email,
            'phone'      => $this->phone,
            'birthday'   => $this->birthday,
            'resume'     =>  $filename, 
            'linkedin'   => $this->linkedin,
            'job_id'     => $this->job->id
        ]);

        $this->reset(['name', 'email', 'phone', 'birthday', 'resume', 'linkedin']);

      
    }

}; ?>

<div

x-data="{ uploading: false, progress: 0 }"
x-on:livewire-upload-start="uploading = true"
x-on:livewire-upload-finish="uploading = false"
x-on:livewire-upload-cancel="uploading = false"
x-on:livewire-upload-error="uploading = false"
x-on:livewire-upload-progress="progress = $event.detail.progress"
>
    <form wire:submit.prevent="save" method="POST">   

     
        <div class="mb-4">
            <x-input  
            label="Nombre*" 
            wire:model="name"
            placeholder="Victor Caudillo"
            />
        </div> 
        
        <div class="mb-4">
            <x-input  
            label="Email*" 
            wire:model="email"
            placeholder="email@example.com"
            />
        </div> 

        <div class="mb-4">
            <x-input  
            label="Teléfono*" 
            wire:model="phone"
            placeholder="5555555555"
            />
        </div> 


        <div class="mb-4">
          

           <label for="birthday" 
           
           @class([
            'block mb-1 text-sm' => true,
            'text-red-600' => $errors->has('birthday')
           ])
        
          >Fecha de nacimiento (Opcional)</label>
           <input type="date" wire:model="birthday" placeholder="2024-05-01" class="w-full border-gray-300 rounded-sm">
           
           @error('birthday') 
           <p  @class([
               'text-sm' => true,
               'text-red-600' => $errors->has('birthday')
           ])>
           {{ $message }}
           </p> 
           @enderror

        </div> 

        <div class="mb-4">

            <label for="resume"
          
            @class([
                'block mb-1 text-sm' => true,
                'text-red-600' => $errors->has('description')
            ])
            
            >Cargar CV (PDF, pero máx: 5mb)*</label>

           
            <input type="file" wire:model="resume">

            <div x-show="uploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>

            @error('resume') 
                <p  @class([
                    'text-sm' => true,
                    'text-red-600' => $errors->has('resume')
                ])>
                {{ $message }}
                </p> 
            @enderror

        </div> 

        <div class="mb-4">
            <x-input  
            label="Linkdln*" 
            wire:model="linkedin"
            placeholder="https://www.linkedin.com/company/dktmexico/"
            />
        </div> 

        <x-button type="submit" info icon="save" label="Guardar" />


    </form>
</div>

