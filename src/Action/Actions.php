<?php

namespace WaAPI\WaAPI\Action;

use WaAPI\WaAPI\Resources\Vcard;

Trait Actions
{
    /**
     * send a message
     *
     * @param string $chatId
     * @param string $message
     * @param array|null $mentions
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function sendMessage(
        string $chatId,
        string $message,
        ?array $mentions = []
    )
    {
        return $this->executeAction('send-message',
            compact([
                'chatId',
                'message',
                'mentions'
            ])
        );
    }

    /**
     * send a media file from a URL
     *
     * @param string $chatId
     * @param string $mediaUrl
     * @param string $mediaCaption
     * @param string $mediaName
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function sendMediaFromUrl(
        string $chatId,
        string $mediaUrl,
        string $mediaCaption,
        string $mediaName,
    )
    {
        return $this->executeAction('send-media',
            compact([
                'chatId',
                'mediaUrl',
                'mediaCaption',
                'mediaName'
            ])
        );
    }

    /**
     * send seens
     * marks a chat as read / seen
     *
     * @param string $chatId
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function sendSeen(
        string $chatId,
    )
    {
        return $this->executeAction('send-seen',
            compact([
                'chatId',
            ])
        );
    }


    /**
     * send a vcard
     *
     * @param string $chatId
     * @param Vcard $vCard
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function sendVcard(
        string $chatId,
        Vcard  $vCard
    )
    {
        return $this->executeAction('send-vcard',
            compact([
                'chatId',
                'vCard'
            ])
        );
    }

    /**
     * Get chats
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getChats()
    {
        return $this->executeAction('get-chats', []);
    }

    /**
     * fetch messages
     *
     * @param string $chatId
     * @param int|null $limit
     * @param bool|null $fromMe
     * @param bool|null $includeMedia
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function fetchMessages(
        string $chatId,
        ?int   $limit = 25,
        ?bool  $fromMe = null,
        ?bool  $includeMedia = null

    )
    {
        return $this->executeAction('fetch-messages',
            compact([
                'chatId',
                'limit',
                'fromMe',
                'includeMedia'
            ])
        );
    }

    /**
     * Get a message by ID
     *
     * @param string $messageId
     * @param bool|null $includeMedia
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getMessageById(
        string $messageId,
        ?bool  $includeMedia = null
    )
    {
        return $this->executeAction('get-message-by-id',
            compact([
                'messageId',
                'includeMedia',
            ])
        );
    }

    /**
     * Delete a message by ID
     *
     * @param string $messageId
     * @param bool|null $forEveryone
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function deleteMessageById(
        string $messageId,
        ?bool  $forEveryone = null
    )
    {
        return $this->executeAction('delete-message-by-id',
            compact([
                'messageId',
                'forEveryone',
            ])
        );
    }

    /**
     * Get conctacts
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getContacts()
    {
        return $this->executeAction('get-contacts', []);
    }

    /**
     * Check if a user is registered
     *
     * @param string $contactId
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function isRegisteredUser(
        string $contactId
    )
    {
        return $this->executeAction('is-registered-user',
            compact([
                'contactId'
            ])
        );
    }

    /**
     * Get profile picture
     *
     * @param string $contactId
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getProfilePicture(
        string $contactId
    )
    {
        return $this->executeAction('get-profile-pic-url',
            compact([
                'contactId'
            ])
        );
    }

    /**
     * Get a contact by ID
     *
     * @param string $contactId
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getContactbyId(
        string $contactId
    )
    {
        return $this->executeAction('get-contact-by-id',
            compact([
                'contactId'
            ])
        );
    }

    /**
     * Block a contact by ID
     *
     * @param string $contactId
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function blockContactbyId(
        string $contactId
    )
    {
        return $this->executeAction('block-contact',
            compact([
                'contactId'
            ])
        );
    }

    /**
     * Unblock a contact by ID
     *
     * @param string $contactId
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function unblockContactbyId(
        string $contactId
    )
    {
        return $this->executeAction('unblock-contact',
            compact([
                'contactId'
            ])
        );
    }

    /**
     * Get a chat by ID
     *
     * @param string $chatId
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getChatById(
        string $chatId
    )
    {
        return $this->executeAction('get-chat-by-id',
            compact([
                'chatId'
            ])
        );
    }

    /**
     * Create a group
     *
     * @param string $groupName
     * @param array $groupParticipants
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function createGroup(
        string $groupName,
        array $groupParticipants
    )
    {
        return $this->executeAction('create-group',
            compact([
                'groupName',
                'groupParticipants'
            ])
        );
    }

    /**
     * Get group participants
     *
     * @param string $chatId
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getGroupParticipants(
        string $chatId
    )
    {
        return $this->executeAction('get-group-participants',
            compact([
                'chatId'
            ])
        );
    }

    /**
     * Get group Info
     *
     * @param string $chatId
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getGroupInfo(
        string $chatId
    )
    {
        return $this->executeAction('get-group-info',
            compact([
                'chatId'
            ])
        );
    }

    /**
     * Update Group Info
     *
     * @param string $chatId
     * @param string $subject
     * @param string $description
     * @param string $pictureUrl
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function updateGroupInfo(
        string $chatId,
        string $subject,
        string $description,
        string $pictureUrl,
    )
    {
        return $this->executeAction('update-group-info',
            compact([
                'chatId',
                'subject',
                'description',
                'pictureUrl'
            ])
        );
    }

    /**
     * Add a group participant
     *
     * @param string $chatId
     * @param string $participant
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function addGroupParticipant(
        string $chatId,
        string $participant
    )
    {
        return $this->executeAction('add-group-participant',
            compact([
                'chatId',
                'participant'
            ])
        );
    }

    /**
     * Remove a group participant
     *
     * @param string $chatId
     * @param string $participant
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function removeGroupParticipant(
        string $chatId,
        string $participant
    )
    {
        return $this->executeAction('remove-group-participant',
            compact([
                'chatId',
                'participant'
            ])
        );
    }

    /**
     * Promote a group participant to admin
     *
     * @param string $chatId
     * @param string $participant
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function promoteGroupParticipant(
        string $chatId,
        string $participant
    )
    {
        return $this->executeAction('promote-group-participant',
            compact([
                'chatId',
                'participant'
            ])
        );
    }

    /**
     * Demote a group participant from admin
     *
     * @param string $chatId
     * @param string $participant
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function demoteGroupParticipant(
        string $chatId,
        string $participant
    )
    {
        return $this->executeAction('demote-group-participant',
            compact([
                'chatId',
                'participant'
            ])
        );
    }

    /**
     * Logout the connected number
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function logout()
    {
        return $this->executeAction('logout', []);
    }

    /**
     * Reboot your instance
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function reboot()
    {
        return $this->executeAction('reboot', []);
    }
}
