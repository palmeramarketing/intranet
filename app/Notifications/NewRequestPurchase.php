<?php
    namespace App\Notifications;

    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;

    class NewRequestPurchase extends Notification
    {
        use Queueable;
        protected $purchase;
        /**
         * Create a new notification instance.
         *
         * @return void
         */
        public function __construct($purchase)
        {
            //
            $this->purchase = $purchase;
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
               'product_id' => $this->purchase->product_id,
               'product_name' => $this->purchase->product_name,
               'user' => $this->purchase->buyer_user,
               'admin' => $this->purchase->admin,
               'type' => 'request',          
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