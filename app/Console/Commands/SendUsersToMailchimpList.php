<?php

namespace App\Console\Commands;

use App\Models\UsersToSend;
use Illuminate\Console\Command;
use MailchimpMarketing\ApiClient;
use MailchimpMarketing\ApiException;


class SendUsersToMailchimpList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailchimp:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send local database users to remote Mailchimp list';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new ApiClient();
        $list_id = '66f5f628fa';

        $client->setConfig([
            'apiKey' => '7c3dedb7882faa6fc52a165ae77c42ce-us7',
            'server' => 'us7'
        ]);

        $users = UsersToSend::all();
        $size = $users->count();
        $i = 0;
        $users->each(function ($item) use (&$i, $client, $list_id) {
            try {
                $response = $client->lists->addListMember($list_id, [
                    "email_address" => $item['email'],
                    "status" => $item['subscribed'] ? 'subscribed' : 'unsubscribed',
                    "merge_fields" => [
                        "FNAME" => $item['name'],
                        "LNAME" => $item['surname']
                    ]
                ]);
                $i++;
            } catch (ApiException $e) {
                $this->info(print_r($e->getMessage(), true));
            }

        });
        if ($i == $size)
            $this->info('All data proceed');
        else
            $this->info($i . ' from ' . $size . ' accounts were added');

        return 0;
    }
}
