<?php

namespace App\Exceptions;

use App\User;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Mail;
use App\Mail\ExceptionOccured;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;


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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        // Sending developers emails when something goes wrong.
        if($this->shouldReport($exception)){
            $this->sendEmail($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * Sends an email to the developer about the exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function sendEmail(Exception $exception)
    {
        try {
            $e = FlattenException::create($exception);
    
            $handler = new SymfonyExceptionHandler();
    
            $html = $handler->getHtml($e);
    
            $users = User::where('active', true)
            ->where('developer', true)->get();

            foreach($users as $user)
            {
                Mail::to($user->email)->send(new ExceptionOccured($html));
            }
            
        } catch (Exception $ex) {
            dd("Something went wrong");
        }
    }
}
