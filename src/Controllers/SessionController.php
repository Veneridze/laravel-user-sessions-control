<?php
namespace Veneridze\LaravelUserSessionsControl\Controllers;

use Veneridze\LaravelUserSessionsControl\Data\SessionData;

class SessionController
{

    public function index() {
        return SessionData::collect(auth()->user()->sessions());
    }
    public function destroy(string $id) {
        \DB::table('sessions')->where('user_id', auth()->user()->id)->delete($id);
        return back();
    }
}
