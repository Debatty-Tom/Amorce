<?php

namespace App\Livewire\Modals;

use App\Enums\EnumsDrawAssignmentsStatuses;
use App\Enums\RolesEnum;
use App\Models\Draw;
use App\Models\Fund;
use App\Models\Transaction;
use App\Traits\DeleteModalTrait;
use App\Traits\HandlesDonators;
use Brick\Money\Money;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class DrawDelete extends Component
{
    use DeleteModalTrait, HandlesDonators;

    public $id;
    public string $feedback;

    public function mount($id)
    {
        $this->id = $id;
    }

    #[computed]
    public function draw()
    {
        return Draw::with(['projects'])
            ->findOrFail($this->id);
    }

    #[Computed]
    public function rangeMax(): float
    {
        return $this->draw->amount / 100;
    }

    #[Computed]
    public function amount(): string
    {
        return Money::ofMinor($this->draw->amount, 'EUR')->formatTo('fr_BE');
    }

    public function assign($projectId, $amount)
    {
        if (!auth()->user()->hasAnyRole(RolesEnum::DRAWMANAGER->value, RolesEnum::ADMIN->value)) {
            abort(403, __('amorce.message-permission-denied-assign-money') . '.');
        }

        $current = Money::ofMinor($this->draw->amount, 'EUR');
        $subtraction = Money::of($amount, 'EUR');

        $this->draw->amount = $current->minus($subtraction)->getMinorAmount()->toInt();
        $this->draw->save();

        $this->draw->projects()->updateExistingPivot($projectId, [
            'amount' => $amount,
            'status' => EnumsDrawAssignmentsStatuses::funded->value,
            'updated_at' => now(),
        ]);

        $this->feedback = $amount . ' ' . __("amorce.message-toast-success-assigned-money");
        $this->dispatch(event: 'openalert', params: ['message' => $this->feedback]);
        $this->dispatch('refresh-delete-modal');
    }

    public function deleteDraw()
    {
        if (!auth()->user()->hasAnyRole(RolesEnum::DRAWMANAGER->value, RolesEnum::ADMIN->value)) {
            abort(403, __('amorce.message-permission-denied-delete-draw') . '.');
        }

        $this->draw->projects()
            ->wherePivot('status', EnumsDrawAssignmentsStatuses::pending->value)
            ->update([
                'amount' => 0,
                'status' => EnumsDrawAssignmentsStatuses::refused->value,
                'updated_at' => now(),
            ]);

        $this->draw->delete();

        $this->feedback = __('amorce.message-toast-success-delete-draw');

        $this->dispatch('refresh-draws');
        $this->showDeleteModal = false;
        $this->dispatch('closeCardModal');
        $this->dispatch(event: 'openalert', params: ['message' => $this->feedback]);
        $this->redirectRoute('draw.index');
    }

    #[on('refresh-delete-modal')]
    public function refreshDeleteModal()
    {
        return;
    }

    public function render()
    {
        return view('livewire.modals.draw-delete');
    }
}
