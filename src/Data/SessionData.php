<?php
namespace Veneridze\LaravelUserSessionsControl\Data;

use DeviceDetector\DeviceDetector;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\Hidden;
use Spatie\LaravelData\Data;

class SessionData extends Data
{
    #[Computed]
    readonly string $platform;
    #[Computed]
    readonly mixed $system;
    #[Computed]
    readonly mixed $agent;
    #[Computed]
    readonly Carbon $date;

    public function __construct(
        public string $id,
        public int $user_id,
        #[Hidden]
        public string $user_agent,
        #[Hidden]
        public string $payload,
        #[Hidden]
        public int $last_activity,
    ) {
        $browser = new DeviceDetector($user_agent);
        $browser->skipBotDetection();
        $browser->parse();
        $this->agent = $browser->getClient();
        $this->system =  $browser->getOs();
        $this->platform = $browser->getDeviceName();
        $this->date = Carbon::parse($this->last_activity);
    }
}