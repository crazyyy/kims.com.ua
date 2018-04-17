<?php namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\Feedback\FeedbackRequest;
use Exception;
use Mail;

/**
 * Class FeedbackController
 * @package App\Http\Controllers\Frontend
 */
class FeedbackController extends FrontendController
{
    /**
     * @var string
     */
    public $module = 'feedback';

    /**
     * @param FeedbackRequest $request
     *
     * @return array
     */
    public function store(FeedbackRequest $request)
    {
        try {
            $emails = explode(',', config('app.email'));

            if (count($emails)) {
                foreach ($emails as $email) {
                    Mail::queue(
                        'emails.admin.new_feedback',
                        [
							'city'         => $request->get('city'),
							'fio'          => $request->get('fio'),
							'phone'        => $request->get('phone'),
							'email'        => $request->get('email'),
							'user_message' => $request->get('message'),
                        ],
                        function ($message) use ($email) {
                            $message->to($email, config('app.name'))->subject(
                                trans('subjects.new_feedback')
                            );
                        }
                    );
                }
            }

            return [
                'status'  => 'success',
                'message' => trans('front_messages.thanks for your feedback'),
            ];
        } catch (Exception $e) {
            return [
                'status'  => 'error',
                'message' => trans('front_messages.an error has occurred, try_later'),
            ];
        }
    }
}