<?php

namespace WaAPI\WaAPI\Action;

use WaAPI\WaAPI\Resources\Vcard;
use WaAPI\WaAPISdk\Resources\ExecutedAction;

trait Actions
{
    /**
     * Sends a message.
     *
     * @param string $chatId The ID of the chat.
     * @param string $message The message to send.
     * @param array|null $mentions Optional mentions in the message.
     * @param int|null $instanceId The ID of the chat instance.
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction The executed action.
     */
    public function sendMessage(
        string $chatId,
        string $message,
        ?array $mentions = [],
        ?int   $instanceId = null
    ): ExecutedAction
    {
        return $this->executeAction(
            'send-message',
            compact('chatId', 'message', 'mentions'),
            $instanceId
        );
    }

    /**
     * Sends a media file from a URL.
     *
     * @param string $chatId The ID of the chat.
     * @param string $mediaUrl The URL of the media file.
     * @param string $mediaCaption The caption for the media file.
     * @param string $mediaName The name of the media file.
     * @param int|null $instanceId The ID of the instance.
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction The executed action.
     */
    public function sendMediaFromUrl(
        string $chatId,
        string $mediaUrl,
        string $mediaCaption,
        string $mediaName,
        ?int   $instanceId = null
    ): ExecutedAction
    {
        return $this->executeAction(
            'send-media',
            compact(
                'chatId',
                'mediaUrl',
                'mediaCaption',
                'mediaName'
            ),
            $instanceId
        );
    }

    /**
     * Marks a chat as read/seen.
     *
     * @param string $chatId The ID of the chat to mark as read.
     * @param int|null $instanceId (Optional) The ID of the instance.
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction The executed action.
     */
    public function sendSeen(string $chatId, int $instanceId = null): ExecutedAction
    {
        return $this->executeAction(
            'send-seen',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * Sends a vcard to a chat.
     *
     * @param string $chatId The ID of the chat.
     * @param Vcard $vCard The vcard object to send.
     * @param int|null $instanceId The ID of the instance (optional).
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction The executed action resource.
     */
    public function sendVcard(string $chatId, Vcard $vCard, int $instanceId = null): ExecutedAction
    {
        // Execute the 'send-vcard' action with the provided parameters
        return $this->executeAction(
            'send-vcard',
            compact(['chatId', 'vCard']),
            $instanceId
        );
    }

    /**
     * Retrieves the list of chats
     *
     * @param int|null $instanceId The instance ID (optional)
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction The executed action object
     */
    public function getChats(int $instanceId = null): ExecutedAction
    {
        // Call the executeAction method to get the chats
        return $this->executeAction(
            'get-chats',
            [],
            $instanceId
        );
    }

    /**
     * Fetch messages from a chat.
     *
     * @param string $chatId The ID of the chat.
     * @param int|null $limit The maximum number of messages to fetch. Default is 25.
     * @param bool|null $fromMe Whether to fetch only messages sent by the current user. Default is null.
     * @param bool|null $includeMedia Whether to include media files in the fetched messages. Default is null.
     * @param int|null $instanceId The ID of the instance to use for the API call. Default is null.
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction The result of the API call.
     */
    public function fetchMessages(
        string $chatId,
        ?int   $limit = 25,
        ?bool  $fromMe = null,
        ?bool  $includeMedia = null,
        ?int   $instanceId = null
    ): ExecutedAction
    {
        return $this->executeAction(
            'fetch-messages',
            compact('chatId', 'limit', 'fromMe', 'includeMedia'),
            $instanceId
        );
    }

    /**
     * Get a message by ID
     *
     * @param string $messageId The ID of the message to retrieve
     * @param bool|null $includeMedia Whether to include media in the response
     * @param int|null $instanceId The ID of the instance
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction The executed action resource
     */
    public function getMessageById(
        string $messageId,
        ?bool  $includeMedia = null,
        ?int   $instanceId = null
    ): ExecutedAction
    {
        return $this->executeAction(
            'get-message-by-id',
            compact('messageId', 'includeMedia'),
            $instanceId
        );
    }

    /**
     * Deletes a message by ID.
     *
     * @param string $messageId - The ID of the message to delete.
     * @param bool|null $forEveryone - Optional. Whether the message should be deleted for everyone. Default is null.
     * @param int|null $instanceId - Optional. The ID of the instance. Default is null.
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction - The executed action result.
     */
    public function deleteMessageById(string $messageId, bool $forEveryone = null, int $instanceId = null): ExecutedAction
    {
        // Execute the action 'delete-message-by-id' and pass the message ID and 'forEveryone' parameter.
        return $this->executeAction(
            'delete-message-by-id',
            compact('messageId', 'forEveryone'),
            $instanceId
        );
    }

    /**
     * Get contacts.
     *
     * @param int|null $instanceId The ID of the instance. Defaults to null.
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction The executed action result.
     */
    public function getContacts(int $instanceId = null): ExecutedAction
    {
        // Execute the 'get-contacts' action with an empty set of parameters and the provided instance ID
        return $this->executeAction(
            'get-contacts',
            [],
            $instanceId
        );
    }

    /**
     * Check if a user is registered.
     *
     * @param string $contactId The ID of the user.
     * @param int|null $instanceId (Optional) The instance ID.
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction The executed action object.
     */
    public function isRegisteredUser(string $contactId, int $instanceId = null): ExecutedAction
    {
        return $this->executeAction(
            'is-registered-user',
            compact('contactId'),
            $instanceId
        );
    }

    /**
     * Get profile picture.
     *
     * Retrieves the URL of the profile picture for a given contact ID.
     *
     * @param string $contactId The contact ID.
     * @param int|null $instanceId The instance ID (optional).
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction The executed action object.
     */
    public function getProfilePicture(
        string $contactId,
        int    $instanceId = null
    ): ExecutedAction
    {
        return $this->executeAction(
            'get-profile-pic-url',
            compact('contactId'),
            $instanceId
        );
    }

    /**
     * Get a contact by ID
     *
     * @param string $contactId The ID of the contact to retrieve
     * @param int|null $instanceId The ID of the instance to use (optional)
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction The executed action result
     */
    public function getContactById(string $contactId, ?int $instanceId = null): ExecutedAction
    {
        return $this->executeAction(
            'get-contact-by-id',
            compact('contactId'),
            $instanceId
        );
    }

    /**
     * Block a contact by ID.
     *
     * @param string $contactId The ID of the contact to block.
     * @param int|null $instanceId (optional) The instance ID.
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction The result of the action.
     */
    public function blockContactById(string $contactId, int $instanceId = null): ExecutedAction
    {
        // Execute the 'block-contact' action with the provided contact ID and instance ID.
        return $this->executeAction(
            'block-contact', [
            'contactId' => $contactId,
        ], $instanceId
        );
    }

    /**
     * Unblock a contact by ID
     *
     * @param string $contactId The ID of the contact to unblock
     * @param int|null $instanceId The ID of the instance (optional)
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function unblockContactById(string $contactId, int $instanceId = null): ExecutedAction
    {
        return $this->executeAction(
            'unblock-contact',
            compact('contactId'),
            $instanceId
        );
    }

    /**
     * Retrieve a chat by ID.
     *
     * @param string $chatId The ID of the chat to retrieve.
     * @param int|null $instanceId The ID of the instance (optional).
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction The executed action.
     */
    public function getChatById(string $chatId, int $instanceId = null): ExecutedAction
    {
        return $this->executeAction(
            'get-chat-by-id',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * Creates a group.
     *
     * @param string $name The name of the group.
     * @param array $participants The list of participants in the group.
     * @param int|null $instanceId The ID of the instance (optional).
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction The executed action.
     */
    public function createGroup(string $name, array $participants, ?int $instanceId = null): ExecutedAction
    {
        return $this->executeAction(
            'create-group',
            compact('name', 'participants'),
            $instanceId
        );
    }

    /**
     * Retrieves the participants of a group.
     *
     * @param string $chatId
     * @param int|null $instanceId
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getGroupParticipants(string $chatId, int $instanceId = null): ExecutedAction
    {
        return $this->executeAction(
            'get-group-participants',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * Get group information by chat ID and instance ID.
     *
     * @param string $chatId
     * @param int|null $instanceId
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function getGroupInfo(string $chatId, ?int $instanceId = null): ExecutedAction
    {
        return $this->executeAction(
            'get-group-info',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * Update Group Info
     *
     * @param string $chatId
     * @param string $subject
     * @param string $description
     * @param string $pictureUrl
     * @param int|null $instanceId
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function updateGroupInfo(
        string $chatId,
        string $subject,
        string $description,
        string $pictureUrl,
        ?int   $instanceId = null
    ): ExecutedAction
    {
        return $this->executeAction(
            'update-group-info',
            compact('chatId', 'subject', 'description', 'pictureUrl'),
            $instanceId
        );
    }

    /**
     * Add a participant to a group chat
     *
     * @param string $chatId
     * @param string $participant
     * @param int|null $instanceId
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function addGroupParticipant(string $chatId, string $participant, ?int $instanceId = null)
    {
        return $this->executeAction(
            'add-group-participant',
            compact('chatId', 'participant'),
            $instanceId
        );
    }

    /**
     * Remove a group participant.
     *
     * @param string $chatId The ID of the chat.
     * @param string $participant The participant to be removed.
     * @param int|null $instanceId The ID of the instance.
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction The executed action.
     */
    public function removeGroupParticipant(string $chatId, string $participant, ?int $instanceId = null): ExecutedAction
    {
        return $this->executeAction(
            'remove-group-participant',
            compact('chatId', 'participant'),
            $instanceId
        );
    }

    /**
     * Promotes a group participant to admin.
     *
     * @param string $chatId The ID of the chat.
     * @param string $participant The ID of the participant to promote.
     * @param int|null $instanceId The ID of the instance (optional).
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction The executed action.
     */
    public function promoteGroupParticipant(
        string $chatId,
        string $participant,
        int    $instanceId = null
    ): ExecutedAction
    {
        // Execute the action to promote the group participant
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
     * @param string $chatId
     * @param string $participant
     * @param int|null $instanceId
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function demoteGroupParticipant(string $chatId, string $participant, ?int $instanceId = null): ExecutedAction
    {
        return $this->executeAction(
            'demote-group-participant',
            compact('chatId', 'participant'),
            $instanceId
        );
    }

    /**
     * Logout the connected number.
     *
     * @param int|null $instanceId The ID of the instance. If null, the default instance will be used.
     * @return ExecutedAction The executed action.
     */
    public function logout(int $instanceId = null): ExecutedAction
    {
        return $this->executeAction(
            'logout',
            [],
            $instanceId
        );
    }

    /**
     * Reboot an instance
     *
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     */
    public function reboot(int $instanceId = null): ExecutedAction
    {
        return $this->executeAction(
            'reboot',
            [],
            $instanceId
        );
    }
}
