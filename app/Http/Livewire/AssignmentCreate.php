<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Assignment;
use App\Computer;
use App\Employee;

class AssignmentCreate extends Component
{

    public Assignment $assign;
    public  $computer;
    public  $employee;
    public $filterEmployee, $filterComputer;

    protected $rules = [
        'assign.computer_id' => 'Integer',
        'assign.employee_id' => 'Integer',
    ];

    public function updated(){
        // dd($this->assign);
        $this->employee = $this->assign->employee;
        $this->computer = $this->assign->computer;
    }

    public function mount(){
        $this->assign = new Assignment;
        $this->computer = new Computer;
        $this->employee = new Employee;
        $this->filterEmployee = '';
        $this->filterComputer = '';
    }

    public function getCanSaveProperty(){
        return $this->assign->computer_id != 0 && $this->assign->employee_id != 0;
    }

    public function getFilteredEmployeesProperty(){
        return Employee::where( 'last_name', 'like', $this->filterEmployee.'%')->orWhere('first_name', 'like', $this->filterEmployee . '%');
    }

    public function getFilteredComputersProperty(){
        $filtered = Computer::where( 'pc_name', 'like', $this->filterComputer.'%' )->orWhere('asset_tag', 'like', $this->filterComputer . '%')->get();
        return $filtered->where('status', 'Available');
    }

    public function save(){
     
        $this->assign->save();
        $this->computer->status = "Assigned";
        $this->computer->save();
        $this->employee->status = "Assigned";
        $this->employee->save();

        return redirect()->to('/assignments');
    }


    public function render()
    {
        return view('livewire.assignment-create');
    }

}