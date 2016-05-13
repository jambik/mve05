<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Mail;
use ReCaptcha\ReCaptcha;
use Snowfire\Beautymail\Beautymail;
use Validator;

class CommonController extends FrontendController
{
    /**
     * Show the feedback page.
     *
     * @return \Illuminate\Http\Response
     */
    public function feedback()
    {
        return view('feedback');
    }

    /**
     * Send feedback form.
     *
     * @param Request $request
     * @return Response
     */
    public function feedbackSend(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required_if:phone,""',
            'phone' => 'required_if:email,""',
            'message' => 'required',
        ];

        $messages = [
            'name.required' => 'Введите Ваше имя. Мы же должны как-то к Вам обращаться :)',
            'email.required_if' => 'А где же ваш email для обратной связи?',
            'phone.required_if' => 'Укажите пожалуйста Ваш телефончик для обратной связи',
            'message.required' => 'А где собственно сообщение?',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function($validator) use ($request)
        {
            $recaptcha = new ReCaptcha(env('GOOGLE_RECAPTCHA_SECRET'));
            $resp = $recaptcha->verify($request->get('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);

            if ( ! $resp->isSuccess())
            {
                $validator->errors()->add('google_recaptcha_error', 'Ошибка reCAPTCHA: '.implode(', ', $resp->getErrorCodes()));
            }
        });

        if ($validator->fails())
        {
            $this->throwValidationException($request, $validator);
        }

        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('emails.feedback', ['input' => $request->all()], function($message)
        {
            $message->from(env('MAIL_ADDRESS'), env('MAIL_NAME'));
            $message->to($this->settings['email'] ?: env('MAIL_ADDRESS'));
            $message->subject('Обратная связь');
        });

        if ($request->ajax()){
            return response()->json([
                'status' => 'ok',
                'message' => 'Сообщение отправлено',
            ]);
        }

        return redirect(route('feedback'))->with('status', 'Сообщение отправлено');
    }

    /**
     * Send callback form.
     *
     * @param Request $request
     * @return Response
     */
    public function callback(Request $request)
    {
        $rules = [
            'phone' => 'required',
        ];

        $messages = [
            'phone.required' => 'Укажите пожалуйста Ваш телефончик для обратной связи',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            $this->throwValidationException($request, $validator);
        }

        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('emails.callback', ['input' => $request->all()], function($message)
        {
            $message->from(env('MAIL_ADDRESS'), env('MAIL_NAME'));
            $message->to($this->settings['email'] ?: env('MAIL_ADDRESS'));
            $message->subject('Обратный звонок');
        });

        if ($request->ajax()){
            return response()->json([
                'status' => 'ok',
                'message' => 'Заявка на обратный звонок отправлена',
            ]);
        }

        return redirect(route('index'))->with('status', 'Заявка на обратный звонок отправлена');
    }
}
