<?php

namespace App\Observers;

use App\Group;

class GroupObserver
{
    /**
     * Handle to the group "created" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function created(Group $group)
    {
        //
    }

    /**
     * Handle the group "updated" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function updated(Group $group)
    {
        $original = $group->getOriginal();
        //check if active changed
        if($original['active'] <> $group->active) {
            $group->descendants()->update(['active' => $group->active]);
            $group->users()->update(['logout' => ! $group->active]);
            foreach($group->descendants as $descendant) {
                $descendant->users()->update(['logout' => ! $group->active]);
            }
        }
    }

    /**
     * Handle the group "deleted" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function deleted(Group $group)
    {
        //
    }
}
