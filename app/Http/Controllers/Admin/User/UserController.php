<?php

namespace App\Http\Controllers\Admin\User;

use App\Enum\User\UserRoleEnum;
use App\Filters\Admin\User\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Company;
use App\Models\User;
use App\Traits\ResponderTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ResponderTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::query()
            ->where('role', UserRoleEnum::USER)
            ->with('company')
            ->filter($request->all(), UserFilter::class)
            ->paginate(20);

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var Company $companies */
        $companies = Company::query()
            ->get();

        return view('admin.user.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $attributes = collect($request->validated());

        $attributes->put('password', bcrypt($attributes->get('password')));

        throw_unless(User::query()->create($attributes->toArray()), QueryException::class, 'Kullanıcı Ekleme Sırasında bir hata ile karşılaşıldı.');

        alert()->success('Başarılı', 'Kullanıcı başarılı bir şekilde oluşturuldu');

        return to_route('admin.user.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        /** @var Company $companies */
        $companies = Company::query()
            ->get();

        $user = User::query()
            ->findByHashidOrFail($id);

        return view('admin.user.edit', compact('companies', 'user'));
    }

    /**
     * Update the specified resource in storage.
     * @throws \Throwable
     */
    public function update(UserUpdateRequest $request, string $id): RedirectResponse
    {
        $attributes = collect($request->validated());

        if ($attributes->get('password')) {
            $attributes->put('password', bcrypt($attributes->get('password')));
        } else {
            $attributes->forget('password');
        }

        /** @var User $user */
        $user = User::query()
            ->findByHashidOrFail($id);

        throw_unless($user->update($attributes->toArray()), QueryException::class, 'Kullanıcı Güncelleme Sırasında bir hata ile karşılaşıldı.');

        alert()->success('Başarılı', 'Kullanıcı başarılı bir şekilde güncellendi.');

        return to_route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     * @throws \Throwable
     */
    public function destroy(string $id)
    {
        $user = User::query()
            ->findByHashidOrFail($id);

        throw_unless($user->delete(), QueryException::class, 'Silme işlemi sırasında bir hata ile karşılaşıldı.');

        return $this->success(['message' => 'Silme işlemi başarılı bir şekilde gerçekleştirildi.']);
    }
}
