<?php

namespace App\Models\Traits;

trait MemberTrait
{
    public function checkLoginOrRegister($telephone)
    {
        $member = $this->where('telephone', $telephone)
            ->withTrashed()
            ->first();

        if (! $member) {
            $this->name = config('custom.member_default_name_prefix') . config('custom.member_default_name_suffix');
            $this->telephone = $telephone;
            $this->avatar = config('custom.member_default_avatar');
            $this->status = config('custom.member_default_status');
            if ($this->save()) {
                return 'register_success';
            }
        } elseif ($member->deleted_at) {
            return 'deleted';
        } elseif ($member->status === 2) {
            return 'forbidden';
        } elseif ($member->status === 0) {
            return 'not_passed';
        } elseif ($member->status === 1) {
            return 'normal';
        }

        return 'exception';
    }
}