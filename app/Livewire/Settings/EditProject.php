<?php

namespace App\Livewire\Settings;

use App\Actions\DeleteProject;
use App\Models\Project;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditProject extends Component
{
	public Project $project;

	public string $name;

	public string $slug;

	public function mount()
	{
		$this->project = auth()->user()->currentProject;
		$this->name = $this->project->name;
		$this->slug = $this->project->slug;
	}

	public function save()
	{
		$this->validate([
			'name' => 'required|string|min:6|max:255',
			'slug' => [
				'required',
				'string',
				Rule::unique('projects')->ignore($this->project)
			]
		]);

		$this->project->update($this->only(['name', 'slug']));

		$this->dispatch('flash-message', message: 'Project successfully updated.');

		$this->dispatch('projects-updated');
	}

	public function delete(DeleteProject $action)
	{
		$action->handle($this->project);

		$this->dispatch('flash-message', message: 'Project successfully deleted.');

		$this->dispatch('projects-updated');

		$this->redirectRoute('dashboard', navigate: true);
	}

	public function render()
	{
		return view('livewire.settings.edit-project');
	}
}
