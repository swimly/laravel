<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'uId' => $user->uId,
            'name' => $user->name,
            'email' => $user->email,
            'face' => $user->face,
            'sex' => $user->sex,
            'birth' => $user->birth,
            'status' => $user->status,
            'phone' => $user->phone,
            'wechat' => $user->wechat,
            'QQ' => $user->QQ,
            'github' => $user->github,
            'live' => $user->live,
            'address' => $user->address,
            'regtime' => $user->created_at
        ];
    }
}

// php artisan make:transformer UserTransformer
