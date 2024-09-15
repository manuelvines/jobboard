<?php

use Livewire\Volt\Component;
use App\Models\Job;

new class extends Component {
    //

    public Job $job;

    
    public function mount(Job $job){
        $this->job = $job;
    }

}; ?>

<div class="mt-5">

<x-button label="Aplicar a vacante" x-on:click="$openModal('simpleModal')" info />
 
<x-modal name="simpleModal">
    <x-card title="Aplicar vacante: {{ $job->title }}">
        
       
        <livewire:components.candidate.form :job=$job>

 
        <x-slot name="footer" class="flex justify-end gap-x-4">
            <x-button flat label="Cancel" x-on:click="close" />
 
        </x-slot>
    </x-card>
</x-modal>
</div>
