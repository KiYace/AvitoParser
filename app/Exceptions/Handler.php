<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    /**
    * Render an exception into an HTTP response.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Throwable  $e
    * @return \Symfony\Component\HttpFoundation\Response
    *
    * @throws \Throwable
    */
    public function render($request, Throwable $e)
    {
      if ($request->is('api/*')) {
        $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        $context = [
          'success' => 'false',
          'error' => [
            'code' => empty($e->getCode()) ? 'UNHANDLED_ERROR' : $e->getCode(),
            'message' => $e->getMessage(),
          ],
        ];
        if ($e instanceof PublicationsParserException) {
          $code = Response::HTTP_BAD_REQUEST;
        }
        if ($e instanceof MethodNotAllowed) {
          $code = Response::HTTP_METHOD_NOT_ALLOWED;
        }

        return response()->json($context, $code);
      }

      return parent::render($request, $e);
    }
}
