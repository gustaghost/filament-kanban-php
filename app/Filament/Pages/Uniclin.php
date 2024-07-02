<?php

namespace App\Filament\Pages;

use Mokhosh\FilamentKanban\Pages\KanbanBoard;
use Illuminate\Support\Collection;
use app\Models\User;
use App\Enums\UserStatus;

class Uniclin extends KanbanBoard
{   
    protected static string $model = User::class;
    protected static string $statusEnum = UserStatus::class;
    protected static string $recordTitleAttribute = 'name';

    protected function statuses(): Collection
    {
         return UserStatus::statuses();
    }

    protected function records(): Collection
{
    return User::ordered()->get();
}



public function onStatusChanged (int $recordId, string $status, array $fromOrderedIds, array $toOrderedIds): void 
{
    User::find($recordId)->update(['status'=>$status]);
    User::ignoreTimestamps();
    User::setNewOrder($toOrderedIds);
    User::ignoreTimestamps(false);
}

public function onSortChanged(int $recordId, string $status, array $orderedIds): void    
{
    User::ignoreTimestamps();
    User::setNewOrder($orderedIds);
    User::ignoreTimestamps(false);
}
}
