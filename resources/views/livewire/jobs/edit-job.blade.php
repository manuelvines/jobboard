<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use App\Models\Country;
use App\Models\State;
use App\Models\Job;
use App\Models\Category;
use App\Models\Type;
use App\Models\Workday;
use App\Models\Education;
use App\Models\Modality;

new 

#[Layout('layouts.app')]
#[Title('Editar oferta de empleo')]
class extends Component {
    //

    public $job;

    #[Validate('required',message:'El campo título es requerido')] 
    public $title;

    #[Validate('required',message:'El campo descripción es requerido')] 
    public $description ;


   #[Validate('nullable')]
    #[Validate('required_with_all:max_salary',  message:'Campo salario mínimo es requerido si salario máximo es ingresado')]
    #[Validate('required_if:show_salary,true',  message:'Campo salario mínimo es requerido si checkbox de mostrar salario es seleccionado')]
    #[Validate('numeric', message:'El campo salario mínimo debe ser numérico, sin comas')]
    #[Validate('lte:max_salary', message:'Salario mínimo debe ser menor o igual a salario máximo, ingresa de nuevo')]
    #[Validate('gte:0', message:'Salario mínimo debe ser mayor a 0')]
    public $min_salary;

    #[Validate('nullable')]
    #[Validate('required_with_all:min_salary', message:'Campo salario máximo es requerido si salario mínimo es ingresado  o checkbox de mostrar salario es seleccionado')]
    #[Validate('required_if:show_salary,true',  message:'Campo salario máximo es requerido si checkbox de mostrar salario es seleccionado')]
    #[Validate('numeric', message:'El campo salario máximo debe ser numérico, sin comas')]
    #[Validate('gte:min_salary' , message:'Salario máximo debe ser mayor o igual a salario mínimo')]
    public $max_salary;

    public $show_salary = 0;

    public $types = [];

    #[Validate('required', message: 'Selecciona un valor para tipo')] 
    public $typeId;

    public $workdays = [];

    #[Validate('required', message: 'Selecciona un valor para jornada')] 
    public $workdayId;

    public $educations;

    #[Validate('required', message: 'Selecciona un valor para educación')] 
    public $educationId;

    public $modalities = [];

    #[Validate('required', message: 'Selecciona un valor para modalidad')] 
    public $modalityId;


    public $categories = [];

    #[Validate('required', message: 'Selecciona un valor para departamento')] 
    public $categorieId;

    public $countries = [];

    #[Validate('required',message:'El campo país es requerido')] 
    public $countryId;

    public $states = [];
        
    #[Validate('required',message:'El campo estado es requerido')] 
    public $stateId;

    public  $labelState;



    public function mount(Job $job) 
    {

       $this->job = $job; 

       $this->title       = $job->title;
       $this->description = $job->description;
       $this->countryId   = $job->country_id;
       $this->stateId     = $job->state_id;
       $this->labelState  = $job->country->state_name;

       $this->typeId      = $job->type_id;
       $this->workdayId   = $job->workday_id;
       $this->modalityId  = $job->modality_id;
       $this->categorieId =  $job->category_id;

       $this->educationId = $job->education_id;
       $this->min_salary  = $job->min_salary;
       $this->max_salary  = $job->max_salary;
       $this->show_salary = (bool) $job->show_salary;


       
       $this->countries = Country::all();
       $this->states = State::where('country_id', $job->country_id )->get();
       $this->categories = Category::all();
       $this->types = Type::all();
       $this->workdays = Workday::all();
       $this->educations = Education::all();
       $this->modalities = Modality::all();
       
    }

   

    public function updatedCountryId(){

        $this->stateId = null; 
        
        $state_name = Country::select('state_name')->where('id', $this->countryId)->first();
        $this->labelState = $state_name->state_name;

        $this->states = State::where('country_id', $this->countryId)->get();
        
    }
 

    public function save(Job $job)
    {

        $this->validate();
      


        $this->job->update([
            'title' => $this->title,
            'description' => $this->description,
            'max_salary' => $this->max_salary,
            'min_salary' => $this->min_salary,
            'show_salary' => $this->show_salary,
            'workday_id' => $this->workdayId,
            'type_id' => $this->typeId,
            'education_id' => $this->educationId,
            'modality_id' => $this->modalityId,
            'country_id' => $this->countryId,
            'category_id' => $this->categorieId,
            'state_id' => $this->stateId,
        ]);

        $this->redirect(route('jobs.index'));
    
    }

}; ?>


  
<div class="w-10/12 mx-auto">


    <form wire:submit.prevent="save" method="POST">   

    
        <div class="mb-4">

                <x-input  
                label="Título de la vacante" 
                wire:model="title"
                placeholder="Título de la vacante"
                />
        </div>        


        <div class="mb-4">
            <label for="description"
          
            @class([
                'text-sm' => true,
                'text-red-600' => $errors->has('description')
            ])
            
            >Descripción de  la vacante</label>

          
            <div wire:ignore>
                     <x-forms.tinymce-editor/>
            </div>

            @error('description')
            <div class="text-sm font-light text-red-500">{{ $message }}</div>
            @enderror
           
        </div>




        <div class="flex gap-2 mb-4">

            <x-input  
            label="Salario máximo, solo números (Opcional)" 
            wire:model="max_salary"
            placeholder="10000"
            />

            <x-input  
            label="Salario mínimo solo números (Opcional)" 
            wire:model="min_salary"
            placeholder="5000"
            />


          
           
        </div>
        <div class="mb-4" >
            <x-checkbox wire:model.blur="show_salary" label="Mostrar rango salarial (Opcional)" value="show_salary" />
        </div>sjp
        
        <div class="flex gap-2 mb-4">
            <x-native-select label="País"   wire:model.live="countryId">
                @foreach ( $countries as $country )
                   <option
                   {{ $country->id == $countryId ?  'selected' : '' }}
                   value="{{ $country->id }}"
                   >{{ $country->name }}</option>
                @endforeach
            </x-native-select>

            <x-native-select label="{{ $labelState }}"   wire:model.live="stateId">
                <option value="">Selecciona una opción</option>
                @foreach ( $states as $state )
                <option
                   {{ $state->id == $stateId ? 'selected':'' }}
                   value="{{ $state->id }}">
                   {{ $state->name }}
                </option>
                @endforeach
            </x-native-select>
         </div>


        <div class="flex gap-4 mb-4">

           <x-native-select label="Tipo de empleo"   wire:model.defer="typeId">
                @foreach ( $types as $type )
                   <option
                   {{ $type->id == $typeId ?  'selected' : '' }}
                   value="{{ $type->id }}"
                   >{{ $type->name }}</option>
                @endforeach
           </x-native-select> 
           
           <x-native-select label="Jornada laboral"   wire:model.defer="workdayId">
            @foreach ($workdays as $workday)
               <option
               {{ $workday->id == $workdayId ?  'selected' : '' }}
               value="{{ $workday->id }}"
               >{{ $workday->name }}</option>
            @endforeach
           </x-native-select> 

           <x-native-select label="Modalidad"   wire:model.defer="modalityId">
                @foreach ($modalities as $modality)
                    <option
                        {{ $modality->id == $modalityId ?  'selected' : '' }}
                        value="{{ $modality->id }}"
                        >{{ $modality->name }}
                    </option>
                @endforeach
           </x-native-select> 
          
        </div> 
     
   
        <div class="mb-4">
            <x-native-select label="Departamento"   wire:model.defer="categorieId">
                @foreach ($categories as $category)
                    <option
                        {{ $category->id == $categorieId ?  'selected' : '' }}
                        value="{{ $category->id }}"
                        >{{ $category->name }}
                    </option>
                @endforeach
           </x-native-select> 
        </div>

         <div class="mb-4">
            <x-native-select label="Educación"   wire:model.defer="educationId">
                @foreach ($educations as $education)
                    <option
                        {{ $education->id == $educationId ?  'selected' : '' }}
                        value="{{ $education->id }}"
                        >{{ $education->name }}
                    </option>
                @endforeach
           </x-native-select> 

         </div>        
        <x-button type="submit" warning icon="save" label="Actualizar" />
     </form>
      
 </div>

</div>



@script
<script>
      tinymce.init({
            selector: '#description',
            forced_root_block: true,
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
                
                editor.on('change', function (e) {
                    var content = tinymce.activeEditor.getContent();
                    $wire.description = tinymce.activeEditor.getContent();
                });
               
            }
        });
</script>
@endscript

