<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class Companies extends Component
{
    use WithPagination;

    public $title;
    public $company_id;
    public $isOpen;
    public $itemsPerPage;
    public $perPageValues;

    public function mount()
    {
        $this->isOpen = 0;
        $this->perPageValues = collect([2, 5, 10 ,15]);
        $this->itemsPerPage = $this->perPageValues->first();
    }

    public function render()
    {
        return view('livewire.companies', [
            'companies' => Company::orderBy('title', 'asc')->paginate($this->itemsPerPage),
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
        // Clean errors if were visible before
        $this->resetErrorBag();
        $this->resetValidation();

    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->title = '';
        $this->company_id = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|unique:companies,title,'.$this->company_id,
        ]);
        $data = array(
            'title' => $this->title
        );
        $company = Company::updateOrCreate(['id' => $this->company_id],$data);
        session()->flash('message', $this->company_id ? 'Company updated successfully.' : 'Company created successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $this->company_id = $id;
        $this->title = $company->title;
        $this->openModal();
    }

    public function delete($id)
    {
        $this->company_id = $id;
        Company::find($id)->delete();
        session()->flash('message', 'Company deleted successfully.');
    }

    public function refreshPage()
    {
        $this->page = 1;
    }

}
