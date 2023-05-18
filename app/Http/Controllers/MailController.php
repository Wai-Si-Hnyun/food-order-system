<?php

namespace App\Http\Controllers;
use App\Contracts\Services\MailServiceInterface;
use App\Http\Requests\MailRequest;

class MailController extends Controller
{
    private $mailService;

    public function __construct(MailServiceInterface $mailService)
    {
        $this->mailService = $mailService;
    }
    /**
     * Go to mail index page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View 
     */
    public function index()
    {
        return view('admin.pages.mail.index');
    }

    /**
     * Send email to user
     *
     * @param \App\Http\Requests\MailRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function send(MailRequest $request)
    {
        $recipientEmail = $request->recipient_email;
        $recipientName = $request->recipient_name;
        $subject = $request->subject;
        $body = $request->body;

        $this->mailService->send($recipientEmail, $recipientName, $subject, $body);

        session()->flash('success', 'Mail sent successfully!');

        return redirect()->back();
    }
}
