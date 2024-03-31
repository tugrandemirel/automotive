<?php

namespace App\Http\Controllers\Admin\Company;

use App\Filters\Admin\Company\CompanyFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Company\CompanyStoreRequest;
use App\Http\Requests\Admin\Company\CompanyUpdateRequest;
use App\Models\Company;
use App\Traits\ResponderTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use ResponderTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $companies = Company::query()
            ->filter($request->all(), CompanyFilter::class)
            ->paginate(20);
        return view('admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(CompanyStoreRequest $request): RedirectResponse
    {
        $attributes = collect($request->validated());

        $authorizedPerson = $attributes->get('authorized_person');
        $attributes->forget('authorized_person');

        $authorizedPeople = [];
        foreach($authorizedPerson['name'] as $key => $name)
        {
            $authorizedPeople[$key]['name'] = $name;
            $authorizedPeople[$key]['phone'] = $authorizedPerson['phone'][$key];
            $authorizedPeople[$key]['email'] = $authorizedPerson['email'][$key];
            $authorizedPeople[$key]['gsm'] = $authorizedPerson['gsm'][$key];
        }

        throw_unless($company = Company::query()->create($attributes->toArray()), QueryException::class, 'Firma ekleme işlemi sırasında bir hata ile karşılaşıldı.');

        throw_unless($company->authorizedPeople()->createMany($authorizedPeople), QueryException::class, 'Yetkili kişi ekleme işlemi sırasında bir hata ile karşılaşıldı.');

        alert()->success('Başarılı', 'Başarılı bir şekilde ekleme işlemi gerçekleştirildi');

        return to_route('admin.company.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        /** @var Company $company */
        $company = Company::query()
            ->with('authorizedPeople')
            ->findByHashidOrFail($id);

        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     * @throws \Throwable
     */
    public function update(CompanyUpdateRequest $request, string $id)
    {
        /** @var Company $company */
        $company = Company::query()
            ->with('authorizedPeople')
            ->findByHashidOrFail($id);

        $attributes = collect($request->validated());

        $authorizedPerson = $attributes->get('authorized_person');
        $attributes->forget('authorized_person');

        $authorizedPeople = [];
        foreach($authorizedPerson['name'] as $key => $name)
        {
            $authorizedPeople[$key]['name'] = $name;
            $authorizedPeople[$key]['phone'] = $authorizedPerson['phone'][$key];
            $authorizedPeople[$key]['email'] = $authorizedPerson['email'][$key];
            $authorizedPeople[$key]['gsm'] = $authorizedPerson['gsm'][$key];
        }

        throw_unless($company->update($attributes->toArray()), QueryException::class, 'Firma güncelleme işlemi sırasında bir hata ile karşılaşıldı.');
        throw_unless($company->authorizedPeople()->delete(), QueryException::class, 'Yetkili Kişi Silme işlemi sırasında bir hata ile karşılaşıldı');
        throw_unless($company->authorizedPeople()->createMany($authorizedPeople), QueryException::class, 'Yetkili Kişi güncelleme işlemi sırasında bir hata ile karşılaşıldı');

        alert()->success('Başarılı', 'Güncelleme işlemi başarılı bir şekilde gerçekleştirildi');

        return to_route('admin.company.index');
    }

    /**
     * Remove the specified resource from storage.
     * @throws \Throwable
     */
    public function destroy(string $id): JsonResponse
    {
        $company = Company::query()
            ->findByHashidOrFail($id);

        throw_unless($company->delete(), QueryException::class, 'Silme işlemi sırasında bir hata ile karşılaşıldı.');

        return $this->success(['message' => 'Silme işlemi başarılı bir şekilde gerçekleştirildi.']);
    }
}
