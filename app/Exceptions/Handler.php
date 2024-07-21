<?php

namespace App\Exceptions;
use Throwable;

use  Illuminate\{
    Foundation\Exceptions\Handler as ExceptionHandler,
    Validation\ValidationException,
    Auth\AuthenticationException,
    Database\QueryException,
    Database\Eloquent\ModelNotFoundException,

};

use Symfony\Component\{
    HttpKernel\Exception\NotFoundHttpException,
    Routing\Exception\RouteNotFoundException,

};
use Illuminate\Http\Exceptions\ThrottleRequestsException;

// use ErrorException;

use App\Traits\CRUD_Trait;

class Handler extends ExceptionHandler
{

    use CRUD_Trait;
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
    // public function register(): void
    // {
    //     $this->renderable(function (Throwable $e) {
    //         //
    //         echo get_class($e);
    //     });
    // }

     /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            
            if($request->is('api/*'))
            return $this->errorMessage("Object not found, like route not found..",404);
        });

        $this->renderable(function (AuthenticationException $e, $request) {
            
            if($request->is('api/*'))
            return $this->errorMessage("This user is not logged in.",401);
        });


        // $this->renderable(function (QueryException $e, $request) {
            
        //     if($request->is('api/*'))
        //     return $this->errorMessage("query error.",400);
        // });


        $this->renderable(function (ThrottleRequestsException $e, $request) {
            
            if($request->is('api/*'))
            return $this->errorMessage(" You cannot send more than one request within 3 minutes, please wait .",429);
        });



        $this->renderable(function (ValidationException $e, $request) {
            
            if($request->is('api/*'))
            return $this->errorValidationMessage($e);
        });
           
                                   
    }


}
