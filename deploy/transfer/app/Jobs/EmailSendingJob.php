<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailSendingTemplate;

class EmailSendingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $data;
    private $view;
    /**
     * Create a new job instance.
     */
    public function __construct($view, $data)
    {
        $this->data = $data;
        $this->view = $view;
    }

    /**
     * Execute the job.
     * dispatch(new \App\Jobs\EmailSendingJob($data));
     */
    public function handle(): void
    {
        if (! isset($this->data['email']) || empty($this->data['email']) ) {
            return;
        }

        $template = new EmailSendingTemplate( $this->view, $this->data);
        Mail::to($this->data['email'])->send($template);
    }

    // public static function notifyTranslator($data)
    // {
    //     $translator = Input::get('translator');

    //     if (! isset($translator['notify'])) {
    //         return false;
    //     }

    //     $translatorData = Input::get('translator');
    //     $link = URL::to('staffView/translator/'.$action->id.'/'.md5($action->id));
    //     $translator = Translator::findOrFail($translatorData['id']);

    //     Log::info('Notify translator: '.$link.' > '.$translator->email);

    //     try {
    //         Mail::send('emails.translator', compact('link'), function ($message) use ($translator, $action) {
    //             $gender = PublicVariables::getGender()[$action->travel->patient()->first()->gender];
    //             $age = $action->travel->patient()->first()->age;
    //             $nameAndCode = $action->travel->patient()->first()->name_and_code;

    //             $message->to(explode(',', $translator->email), $translator->name)->subject("Clinics Patients : {$nameAndCode} {$gender} {$age}");
    //         });
    //     } catch (\Exception $exception) {
    //         Log::info('Error Notify translator:'.$translator->email.' '.$exception->getMessage());
    //     }
    // }

    // public static function notifyHospital($data)
    // {
    //     //        $hospital = Input::get('hospital');
    //     //        if (! isset($hospital['notify'])) {
    //     //            return false;
    //     //        }

    //     $settings = Setting::get('settings');
    //     if (! $settings['hospitalEmail']) {
    //         return false;
    //     }

    //     $link = URL::to('staffView/hospital/'.$action->travel->id.'/'.md5($action->travel->id));

    //     Log::info('Notify hospital: '.$link.' > '.$settings['hospitalEmail']);

    //     try {
    //         Mail::send('emails.hospital', compact('link'), function ($message) use ($settings, $action) {
    //             $gender = PublicVariables::getGender()[$action->travel->patient()->first()->gender];
    //             $age = $action->travel->patient()->first()->age;
    //             $nameAndCode = $action->travel->patient()->first()->name_and_code;

    //             $message->to(explode(',', $settings['hospitalEmail']), "Clinics-Hospital")
    //                     ->subject("Clinics Patients : {$nameAndCode} {$gender} {$age}");

    //             if ($settings['hospitalEmailCC']) {
    //                 $message->cc(explode(',', $settings['hospitalEmailCC']));
    //             }

    //             if ($settings['hospitalEmailBCC']) {
    //                 $message->bcc(explode(',', $settings['hospitalEmailBCC']));
    //             }
    //         });
    //     } catch (\Exception $exception) {
    //         Log::info('Error Notify hospital mail:'.$settings['hospitalEmail'].' '.$exception->getMessage());
    //     }
    // }

    // public static function notifyHospitalMails($data)
    // {
    //     $hospital = Input::get('hospital');
    //     if (! isset($hospital['notify'])) {
    //         return false;
    //     }

    //     if (! $action->travel->hospital_mail_notify) {
    //         return false;
    //     }

    //     $hospitalMails = HospitalMails::select(['name', 'email'])
    //                                   ->whereIn('id', explode(',', $action->travel->hospital_mail_notify))
    //                                   ->get();

    //     if (! $hospitalMails) {
    //         return false;
    //     }

    //     $link = URL::to('staffView/hospital/'.$action->travel->id.'/'.md5($action->travel->id));

    //     foreach ($hospitalMails as $hospitalMailsItem) {
    //         Log::info('Notify hospital mail: '.$link.' > '.$hospitalMailsItem->email);

    //         try {
    //             Mail::send('emails.hospital', compact('link', 'hospitalMailsItem'), function ($message) use (
    //                 $action,
    //                 $hospitalMailsItem
    //             ) {
    //                 $gender = PublicVariables::getGender()[$action->travel->patient()->first()->gender];
    //                 $age = $action->travel->patient()->first()->age;
    //                 $nameAndCode = $action->travel->patient()->first()->name_and_code;
    //                 $message->to(explode(',', $hospitalMailsItem->email), "Clinics-Hospital")
    //                         ->subject("Clinics Patients : {$nameAndCode} {$gender} {$age}");
    //             });
    //         } catch (\Exception $exception) {
    //             Log::info('Error Notify hospital mail:'.$hospitalMailsItem->email.' '.$exception->getMessage());
    //         }
    //     }
    // }

    // public static function notifyTask($data)
    // {
    //     $createdUserName = $task->createdUser->name;
    //     $startTime = $task->start_time;
    //     $endTime = $task->end_time;
    //     $description = $task->description;
    //     $patientName = $task->travel->patient()->first()->name;

    //     $files = $task->action()->first()->files()->get();

    //     Log::info('Notify task: '.$createdUserName.' > '.$task->user()->first()->email);

    //     try {
    //         Mail::send('emails.task', compact('createdUserName', 'startTime', 'endTime', 'description', 'patientName', 'files'),
    //             function ($message) use ($task) {
    //                 $message->to($task->user()->first()->email, $task->user()->first()->name)->subject("Yeni Görev : {$task->travel->patient()->first()->code}");
    //             });
    //     } catch (\Exception $exception) {
    //         Log::info('Error Notify task:'.$task->user()->first()->email.' '.$exception->getMessage());
    //     }
    // }
}
