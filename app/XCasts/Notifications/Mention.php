<?php

namespace XCasts\Notifications;

use App\Models\User;

class Mention
{
    public $body_parsed;
    public $users = [];
    public $userNames;
    public $origin_body;

    public function getMentionedUsername()
    {
        preg_match_all("/(\S*)\@([^\r\n\s]*)/i", $this->origin_body, $atList);

        $userNames = [];
        foreach ($atList[2] as $k=>$v) {
            if ($atList[1][$k] || strlen($v) >25) {
                continue;
            }
            $userNames[] = $v;
        }
        return array_unique($userNames);
    }

    public function replace()
    {
        $this->body_parsed = $this->origin_body;

        foreach ($this->users as $user) {
            $search = '@' . $user->name;
            $place = '['.$search.']('.route('user.show', $user->id).')';
            $this->body_parsed = str_replace($search, $place, $this->body_parsed);
        }
    }

    public function parse($body)
    {
        $this->origin_body = $body;
        $this->userNames = $this->getMentionedUsername();
        count($this->userNames) > 0 && $this->users = User::whereIn('name', $this->userNames)->get();

        $this->replace();

        return $this->body_parsed;
    }
}