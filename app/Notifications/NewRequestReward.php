<?php
    namespace App\Notifications;

    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;

    class NewRequestReward extends Notification
    {
        use Queueable;
        protected $reward;
        /**
         * Create a new notification instance.
         *
         * @return void
         */
        public function __construct($reward)
        {
            //
            $this->reward = $reward;
        }

        /**
         * Get the notification's delivery channels.
         *
         * @param  mixed  $notifiable
         * @return array
         */
        public function via($notifiable)
        {
            return ['database'];
        }

        /**
         * Get the mail representation of the notification.
         *
         * @param  mixed  $notifiable
         * @return \Illuminate\Notifications\Messages\MailMessage
         */
        public function toDatabase($notifiable)
        {
            return [
                //
                'id' => $this->reward->id,
                'id_admin' => $this->reward->from_admin,
                'id_user' => $this->reward->to_user,
                'amount' => $this->reward->amount,
                'type' => 'rewardRequest',
            ];
        }
        /**
         * Get the array representation of the notification.
         *
         * @param  mixed  $notifiable
         * @return array
         */
        public function toArray($notifiable)
        {
            return [
                //
                
            ];
        }
    }
