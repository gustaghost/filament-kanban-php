<?php

namespace App\Filament\Pages;

use Mokhosh\FilamentKanban\Pages\KanbanBoard;
use Illuminate\Support\Collection;
use app\Models\User;

class Uniclin extends KanbanBoard
{
    protected static string $recordTitleAttribute = 'name';
    protected static string $model = Model::class;
    protected static string $statusEnum = ModelStatus::class;


    protected function records(): Collection
{
    return User::latest('updated_at')->get();
}

protected function statuses(): Collection
{
     return collect([
        [
            'id' => 'pending',
            'title' => 'Pending',
        ],
        [
            'id' => 'active',
            'title' => 'Active',
        ],
    ]);
}

public function onStatusChanged (int $recordId, string $status, array $fromOrderedIds, array $toOrderedIds): void 
{
    User::find($recordId)->update(['status'=>$status]);
}
}
