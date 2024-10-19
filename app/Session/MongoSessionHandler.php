<?php

namespace App\Session;

use Illuminate\Session\DatabaseSessionHandler;

class MongoSessionHandler extends DatabaseSessionHandler
{
    /**
     * Get the default payload for the session.
     *
     * @param  string  $data
     * @return array
     */
    protected function getDefaultPayload($data)
    {
        $payload = [
            'payload' => base64_encode($data),
            'last_activity' => $this->currentTime(),
            'custom' => 'aimer_session_debug', // debug
        ];

        if (!$this->container) {
            return $payload;
        }

        return tap($payload, function (&$payload) {
            $this->addUserInformation($payload)->addRequestInformation($payload);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function read($sessionId): false|string
    {
        /**
         * Fix E11000 duplicate key error collection in session table of mongodb Laravel:
         * 1. https://gist.github.com/puuble/b3982acdccb61bbf39e4704428698435
         * 2. https://stackoverflow.com/questions/73088776/why-i-got-duplicate-key-error-collection-sessions-index-error-with-jenssegers-m
         * 3. https://github.com/jenssegers/laravel-mongodb-session/issues/24 : db.sessions.dropIndex("id_1")
         */
        // $session = (object) $this->getQuery()->where('id', $sessionId)->first(); // this here had problem
        $session = (object) $this->getQuery()->find($sessionId); // this function didnt check duplicate from sessions table

        if ($this->expired($session)) {
            $this->exists = true;

            return '';
        }

        if (isset($session->payload)) {
            $this->exists = true;

            return base64_decode($session->payload);
        }

        return '';
    }
}
