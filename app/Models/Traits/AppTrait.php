<?php

namespace App\Models\Traits;

trait AppTrait
{
    /**
     * Get app's all comments
     * @return  mixed
     */
    public function getAppComments()
    {
        $comments = $this->comments()
            ->with(['reply' => function ($query) {
                $query->whereStatus(1);
            }, 'reply.user'])
            ->latest()
            ->whereStatus(1)
            ->get();

        return $comments;
    }

    /**
     * Get app by status
     * @return mixed
     */
    public function getAppByStatus($status, $page = 1)
    {
        $member = session()->get('member');
        $apps = $this->where('member_id', $member->id)
                     ->filterStatus($status);

        // query not passed reason
        if ($status === 2) {
            $apps->with(['appExamineLog' => function ($query) {
                return $query->where('status', 0)->latest();
            }]);
        }
        return $apps->orderBy('id', 'desc')
                    ->paginate();
    }
}