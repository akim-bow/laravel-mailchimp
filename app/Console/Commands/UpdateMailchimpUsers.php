<?php

namespace App\Console\Commands;

use App\Models\UsersToSend;
use Illuminate\Console\Command;
use MailchimpMarketing\ApiClient;
use MailchimpMarketing\ApiException;

class UpdateMailchimpUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailchimp:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update local database users by getting data from remote Mailchimp list';

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
        $users->each(function ($item) use ($client, $list_id) {
            $hash = md5($item->email);
            try {
                $response = $client->lists->getListMember($list_id, $hash);
                $item->subscribed = $response->status == 'subscribed' ? 1 : 0;
                $item->sync_at = now();
                $item->save();
            } catch (ApiException $e) {
                $this->info("Cannot find user with email " . $item->email);
            }
        });

        return 0;
    }
}
