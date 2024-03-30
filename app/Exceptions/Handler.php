<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Traits\ResponderTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ResponderTrait;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param $request
     * @param Throwable $e
     * @return Response|JsonResponse|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $e): Response|JsonResponse|RedirectResponse|\Symfony\Component\HttpFoundation\Response
    {
        if ($request->expectsJson()) {
            if ($e instanceof ValidationException) {
                $messages = "";
                foreach ($e->errors() as $key => $values) {
                    foreach ($values as $value) {
                        $messages .= Str::ucfirst($value) . PHP_EOL;
                        break;
                    }
                    break;
                }
                return $this->error($messages, 422);
            }
            if ($e instanceof QueryException) {
                return $this->error('Query Error: '.$e->getMessage(), 404);
            }
            if ($e instanceof ModelNotFoundException) {
                return $this->error('Model Error: '.$e->getMessage(), 404);
            }

            return $this->error($e->getMessage() ?? 'Bir şeyler ters gitti');
        } else {
            if ($e instanceof QueryException) {
                alert()->error('Error', $e->getMessage());
                return back()->withInput();
            }
            if ($e instanceof ModelNotFoundException) {
                alert()->error('Error', $e->getMessage());
            }
            if ($e instanceof ValidationException) {
                $messages = "";
                foreach ($e->errors() as $key => $values) {
                    foreach ($values as $value) {
                        $messages .= Str::ucfirst($value) . PHP_EOL;
                        break;
                    }
                    break;
                }
                alert()->error('Error',$messages);
            }
        }
        return parent::render($request, $e);
    }
}
