<?php

namespace TZK\UserLogger\Logger;

class UserProcessor {

	private $user;

	public function __construct($user)
	{
		$this->user = $user->user;
	}

    public function __invoke(array $record)
    {
    	if($this->user) {
            $identifier = config('user_logger.display_attribute');
        	$record['extra']['user'] = $this->user->$identifier;
    	} else {
        	$record['extra']['user'] = 'anonymous';
    	}

        return $record;
    }

}