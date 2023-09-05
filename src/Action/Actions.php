<?php

namespace WaAPI\WaAPI\Action;

use WaAPI\WaAPI\Resources\Vcard;

trait Actions
{
    /**
     * send a message
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function sendMessage(
        string $chatId,
        string $message,
        ?array $mentions = [],
        int $instanceId = null
    ) {
        return $this->executeAction('send-message',
            compact([
                'chatId',
                'message',
                'mentions',
            ]),
            $instanceId
        );
    }

    /**
     * send a media file from a URL
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function sendMediaFromUrl(
        string $chatId,
        string $mediaUrl,
        string $mediaCaption,
        string $mediaName,
        int $instanceId = null
    ) {
        return $this->executeAction('send-media',
            compact([
                'chatId',
                'mediaUrl',
                'mediaCaption',
                'mediaName',
            ]),
            $instanceId
        );
    }

    /**
     * send seen
     * marks a chat as read / seen
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function sendSeen(
        string $chatId,
        int $instanceId = null
    ) {
        return $this->executeAction('send-seen',
            compact([
                'chatId',
            ]),
            $instanceId
        );
    }

    /**
     * send a vcard
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function sendVcard(
        string $chatId,
        Vcard $vCard,
        int $instanceId = null
    ) {
        return $this->executeAction('send-vcard',
            compact([
                'chatId',
                'vCard',
            ]),
            $instanceId
        );
    }

    /**
     * Get chats
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getChats(int $instanceId = null)
    {
        return $this->executeAction('get-chats', [], $instanceId);
    }

    /**
     * fetch messages
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function fetchMessages(
        string $chatId,
        ?int $limit = 25,
        bool $fromMe = null,
        bool $includeMedia = null,
        int $instanceId = null

    ) {
        return $this->executeAction('fetch-messages',
            compact([
                'chatId',
                'limit',
                'fromMe',
                'includeMedia',
            ]),
            $instanceId
        );
    }

    /**
     * Get a message by ID
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getMessageById(
        string $messageId,
        bool $includeMedia = null,
        int $instanceId = null
    ) {
        return $this->executeAction('get-message-by-id',
            compact([
                'messageId',
                'includeMedia',
            ]),
            $instanceId
        );
    }

    /**
     * Delete a message by ID
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function deleteMessageById(
        string $messageId,
        bool $forEveryone = null,
        int $instanceId = null
    ) {
        return $this->executeAction('delete-message-by-id',
            compact([
                'messageId',
                'forEveryone',
            ]),
            $instanceId
        );
    }

    /**
     * Get contacts
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getContacts(
        int $instanceId = null
    ) {
        return $this->executeAction('get-contacts', [], $instanceId);
    }

    /**
     * Check if a user is registered
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function isRegisteredUser(
        string $contactId,
        int $instanceId = null
    ) {
        return $this->executeAction('is-registered-user',
            compact([
                'contactId',
            ]),
            $instanceId
        );
    }

    /**
     * Get profile picture
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getProfilePicture(
        string $contactId,
        int $instanceId = null
    ) {
        return $this->executeAction('get-profile-pic-url',
            compact([
                'contactId',
            ]),
            $instanceId
        );
    }

    /**
     * Get a contact by ID
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getContactbyId(
        string $contactId,
        int $instanceId = null
    ) {
        return $this->executeAction('get-contact-by-id',
            compact([
                'contactId',
            ]),
            $instanceId
        );
    }

    /**
     * Block a contact by ID
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function blockContactbyId(
        string $contactId,
        int $instanceId = null
    ) {
        return $this->executeAction('block-contact',
            compact([
                'contactId',
            ]),
            $instanceId
        );
    }

    /**
     * Unblock a contact by ID
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function unblockContactbyId(
        string $contactId,
        int $instanceId = null
    ) {
        return $this->executeAction('unblock-contact',
            compact([
                'contactId',
            ]),
            $instanceId
        );
    }

    /**
     * Get a chat by ID
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getChatById(
        string $chatId,
        int $instanceId = null
    ) {
        return $this->executeAction('get-chat-by-id',
            compact([
                'chatId',
            ]),
            $instanceId
        );
    }

    /**
     * Create a group
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function createGroup(
        string $groupName,
        array $groupParticipants,
        int $instanceId = null
    ) {
        return $this->executeAction('create-group',
            compact([
                'groupName',
                'groupParticipants',
            ]),
            $instanceId
        );
    }

    /**
     * Get group participants
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getGroupParticipants(
        string $chatId,
        int $instanceId = null
    ) {
        return $this->executeAction('get-group-participants',
            compact([
                'chatId',
            ]),
            $instanceId
        );
    }

    /**
     * Get group Info
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getGroupInfo(
        string $chatId,
        int $instanceId = null
    ) {
        return $this->executeAction('get-group-info',
            compact([
                'chatId',
            ]),
            $instanceId
        );
    }

    /**
     * Update Group Info
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function updateGroupInfo(
        string $chatId,
        string $subject,
        string $description,
        string $pictureUrl,
        int $instanceId = null
    ) {
        return $this->executeAction('update-group-info',
            compact([
                'chatId',
                'subject',
                'description',
                'pictureUrl',
            ]),
            $instanceId
        );
    }

    /**
     * Add a group participant
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function addGroupParticipant(
        string $chatId,
        string $participant,
        int $instanceId = null
    ) {
        return $this->executeAction('add-group-participant',
            compact([
                'chatId',
                'participant',
            ]),
            $instanceId
        );
    }

    /**
     * Remove a group participant
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function removeGroupParticipant(
        string $chatId,
        string $participant,
        int $instanceId = null
    ) {
        return $this->executeAction('remove-group-participant',
            compact([
                'chatId',
                'participant',
            ]),
            $instanceId
        );
    }

    /**
     * Promote a group participant to admin
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function promoteGroupParticipant(
        string $chatId,
        string $participant,
        int $instanceId = null
    ) {
        return $this->executeAction('promote-group-participant',
            compact([
                'chatId',
                'participant',
            ]),
            $instanceId
        );
    }

    /**
     * Demote a group participant from admin
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function demoteGroupParticipant(
        string $chatId,
        string $participant,
        int $instanceId = null
    ) {
        return $this->executeAction('demote-group-participant',
            compact([
                'chatId',
                'participant',
            ]),
            $instanceId
        );
    }

    /**
     * Logout the connected number
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function logout(
        int $instanceId = null
    ) {
        return $this->executeAction('logout', [], $instanceId);
    }

    /**
     * Reboot an instance
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function reboot(int $instanceId = null)
    {
        return $this->executeAction('reboot', [], $instanceId);
    }
}
