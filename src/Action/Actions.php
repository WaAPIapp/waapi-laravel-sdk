<?php

namespace WaAPI\WaAPI\Action;

use WaAPI\WaAPI\Resources\Vcard;
use WaAPI\WaAPISdk\Resources\ExecutedAction;

trait Actions
{
    /**
     * Sends a message.
     *
     * @param  string  $chatId  The ID of the chat.
     * @param  string  $message  The message to send.
     * @param  array|null  $mentions  Optional mentions in the message.
     * @param  int|null  $instanceId  The ID of the chat instance.
     * @return ExecutedAction The executed action.
     */
    public function sendMessage(
        string $chatId,
        string $message,
        ?array $mentions = [],
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'send-message',
            compact('chatId', 'message', 'mentions'),
            $instanceId
        );
    }

    /**
     * Sends a media file from a URL.
     *
     * @param  string  $chatId  The ID of the chat.
     * @param  string  $mediaUrl  The URL of the media file.
     * @param  string  $mediaCaption  The caption for the media file.
     * @param  string  $mediaName  The name of the media file.
     * @param  int|null  $instanceId  The ID of the instance.
     * @return ExecutedAction The executed action.
     */
    public function sendMediaFromUrl(
        string $chatId,
        string $mediaUrl,
        string $mediaCaption,
        string $mediaName,
        ?int $instanceId = null
    ): ExecutedAction {
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
     * @param  string  $chatId  The ID of the chat to mark as read.
     * @param  int|null  $instanceId  (Optional) The ID of the instance.
     * @return ExecutedAction The executed action.
     */
    public function sendSeen(string $chatId, ?int $instanceId = null): ExecutedAction
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
     * @param  string  $chatId  The ID of the chat.
     * @param  Vcard  $vCard  The vcard object to send.
     * @param  int|null  $instanceId  The ID of the instance (optional).
     * @return ExecutedAction The executed action resource.
     */
    public function sendVcard(string $chatId, Vcard $vCard, ?int $instanceId = null): ExecutedAction
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
     * @param  int|null  $instanceId  The instance ID (optional)
     * @return ExecutedAction The executed action object
     */
    public function getChats(?int $instanceId = null): ExecutedAction
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
     * @param  string  $chatId  The ID of the chat.
     * @param  int|null  $limit  The maximum number of messages to fetch. Default is 25.
     * @param  bool|null  $fromMe  Whether to fetch only messages sent by the current user. Default is null.
     * @param  bool|null  $includeMedia  Whether to include media files in the fetched messages. Default is null.
     * @param  int|null  $instanceId  The ID of the instance to use for the API call. Default is null.
     * @return ExecutedAction The result of the API call.
     */
    public function fetchMessages(
        string $chatId,
        ?int $limit = 25,
        ?bool $fromMe = null,
        ?bool $includeMedia = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'fetch-messages',
            compact('chatId', 'limit', 'fromMe', 'includeMedia'),
            $instanceId
        );
    }

    /**
     * Get a message by ID
     *
     * @param  string  $messageId  The ID of the message to retrieve
     * @param  bool|null  $includeMedia  Whether to include media in the response
     * @param  int|null  $instanceId  The ID of the instance
     * @return ExecutedAction The executed action resource
     */
    public function getMessageById(
        string $messageId,
        ?bool $includeMedia = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-message-by-id',
            compact('messageId', 'includeMedia'),
            $instanceId
        );
    }

    /**
     * Deletes a message by ID.
     *
     * @param  string  $messageId  - The ID of the message to delete.
     * @param  bool|null  $forEveryone  - Optional. Whether the message should be deleted for everyone. Default is null.
     * @param  int|null  $instanceId  - Optional. The ID of the instance. Default is null.
     * @return ExecutedAction - The executed action result.
     */
    public function deleteMessageById(string $messageId, ?bool $forEveryone = null, ?int $instanceId = null): ExecutedAction
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
     * @param  int|null  $instanceId  The ID of the instance. Defaults to null.
     * @return ExecutedAction The executed action result.
     */
    public function getContacts(?int $instanceId = null): ExecutedAction
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
     * @param  string  $contactId  The ID of the user.
     * @param  int|null  $instanceId  (Optional) The instance ID.
     * @return ExecutedAction The executed action object.
     */
    public function isRegisteredUser(string $contactId, ?int $instanceId = null): ExecutedAction
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
     * @param  string  $contactId  The contact ID.
     * @param  int|null  $instanceId  The instance ID (optional).
     * @return ExecutedAction The executed action object.
     */
    public function getProfilePicture(
        string $contactId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-profile-pic-url',
            compact('contactId'),
            $instanceId
        );
    }

    /**
     * Get a contact by ID
     *
     * @param  string  $contactId  The ID of the contact to retrieve
     * @param  int|null  $instanceId  The ID of the instance to use (optional)
     * @return ExecutedAction The executed action result
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
     * @param  string  $contactId  The ID of the contact to block.
     * @param  int|null  $instanceId  (optional) The instance ID.
     * @return ExecutedAction The result of the action.
     */
    public function blockContactById(string $contactId, ?int $instanceId = null): ExecutedAction
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
     * @param  string  $contactId  The ID of the contact to unblock
     * @param  int|null  $instanceId  The ID of the instance (optional)
     */
    public function unblockContactById(string $contactId, ?int $instanceId = null): ExecutedAction
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
     * @param  string  $chatId  The ID of the chat to retrieve.
     * @param  int|null  $instanceId  The ID of the instance (optional).
     * @return ExecutedAction The executed action.
     */
    public function getChatById(string $chatId, ?int $instanceId = null): ExecutedAction
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
     * @param  string  $name  The name of the group.
     * @param  array  $participants  The list of participants in the group.
     * @param  int|null  $instanceId  The ID of the instance (optional).
     * @return ExecutedAction The executed action.
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
     */
    public function getGroupParticipants(string $chatId, ?int $instanceId = null): ExecutedAction
    {
        return $this->executeAction(
            'get-group-participants',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * Get group information by chat ID and instance ID.
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
     */
    public function updateGroupInfo(
        string $chatId,
        string $subject,
        string $description,
        string $pictureUrl,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'update-group-info',
            compact('chatId', 'subject', 'description', 'pictureUrl'),
            $instanceId
        );
    }

    /**
     * Add a participant to a group chat
     *
     * @return ExecutedAction
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
     * @param  string  $chatId  The ID of the chat.
     * @param  string  $participant  The participant to be removed.
     * @param  int|null  $instanceId  The ID of the instance.
     * @return ExecutedAction The executed action.
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
     * @param  string  $chatId  The ID of the chat.
     * @param  string  $participant  The ID of the participant to promote.
     * @param  int|null  $instanceId  The ID of the instance (optional).
     * @return ExecutedAction The executed action.
     */
    public function promoteGroupParticipant(
        string $chatId,
        string $participant,
        ?int $instanceId = null
    ): ExecutedAction {
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
     * @param  int|null  $instanceId  The ID of the instance. If null, the default instance will be used.
     * @return ExecutedAction The executed action.
     */
    public function logout(?int $instanceId = null): ExecutedAction
    {
        return $this->executeAction(
            'logout',
            [],
            $instanceId
        );
    }

    /**
     * Reboot an instance
     */
    public function reboot(?int $instanceId = null): ExecutedAction
    {
        return $this->executeAction(
            'reboot',
            [],
            $instanceId
        );
    }

    // ---------------------------------------------------------------------
    // Generated from the OpenAPI spec by `php artisan sdk:generate-methods`
    // in the proxy repository. Do not hand-edit: regenerate instead.
    //
    // The methods above are hand-written and deliberately NOT regenerated.
    // Thirteen of them match what the generator emits exactly; the other seven
    // differ in ways that would break callers -- sendMessage and getChats would
    // gain parameters before $instanceId, so a positional call would pass the
    // instance id into the wrong slot; createGroup renames its parameters;
    // fetchMessages changes a default from 25 to null; and sendVcard takes a
    // Vcard object rather than the array the spec describes.
    // ---------------------------------------------------------------------

    /**
     * send a media message (image, video, audio, document)
     */
    public function sendMedia(
        string $chatId,
        ?string $mediaUrl = null,
        ?string $mediaBase64 = null,
        ?string $mediaCaption = null,
        ?string $mediaName = null,
        ?string $replyToMessageId = null,
        ?bool $previewLink = null,
        ?bool $asSticker = null,
        ?bool $asVoice = null,
        ?bool $asDocument = null,
        ?bool $firedandforget = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'send-media',
            compact('chatId', 'mediaUrl', 'mediaBase64', 'mediaCaption', 'mediaName', 'replyToMessageId', 'previewLink', 'asSticker', 'asVoice', 'asDocument', 'firedandforget'),
            $instanceId
        );
    }

    /**
     * send location
     */
    public function sendLocation(
        string $chatId,
        float $latitude,
        float $longitude,
        ?array $options = null,
        ?bool $firedandforget = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'send-location',
            compact('chatId', 'latitude', 'longitude', 'options', 'firedandforget'),
            $instanceId
        );
    }

    /**
     * mark chat as unread
     */
    public function markChatUnread(
        string $chatId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'mark-chat-unread',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * mute chat
     */
    public function muteChat(
        string $chatId,
        ?string $unmuteDate = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'mute-chat',
            compact('chatId', 'unmuteDate'),
            $instanceId
        );
    }

    /**
     * unmute chat
     */
    public function unmuteChat(
        string $chatId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'unmute-chat',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * pin chat
     */
    public function pinChat(
        string $chatId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'pin-chat',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * unpin chat
     */
    public function unpinChat(
        string $chatId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'unpin-chat',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * download media from message
     */
    public function downloadMedia(
        string $messageId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'download-media',
            compact('messageId'),
            $instanceId
        );
    }

    /**
     * get message info by id
     */
    public function getMessageInfoById(
        string $messageId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-message-info-by-id',
            compact('messageId'),
            $instanceId
        );
    }

    /**
     * edit a message
     */
    public function editMessage(
        string $messageId,
        string $message,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'edit-message',
            compact('messageId', 'message'),
            $instanceId
        );
    }

    /**
     * forward a message
     */
    public function forwardMessage(
        string $messageId,
        string $chatId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'forward-message',
            compact('messageId', 'chatId'),
            $instanceId
        );
    }

    /**
     * search messages
     */
    public function searchMessages(
        string $query,
        ?array $options = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'search-messages',
            compact('query', 'options'),
            $instanceId
        );
    }

    /**
     * get chat ID from phone number
     */
    public function getNumberId(
        string $number,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-number-id',
            compact('number'),
            $instanceId
        );
    }

    /**
     * get country code
     */
    public function getCountryCode(
        string $number,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-country-code',
            compact('number'),
            $instanceId
        );
    }

    /**
     * get formatted number
     */
    public function getFormattedNumber(
        string $number,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-formatted-number',
            compact('number'),
            $instanceId
        );
    }

    /**
     * create poll message
     */
    public function createPoll(
        string $chatId,
        string $caption,
        array $options,
        ?bool $multipleAnswers = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'create-poll',
            compact('chatId', 'caption', 'options', 'multipleAnswers'),
            $instanceId
        );
    }

    /**
     * get poll votes
     */
    public function getPollVotes(
        string $messageId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-poll-votes',
            compact('messageId'),
            $instanceId
        );
    }

    /**
     * [BETA] get stories
     */
    public function getStories(
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-stories',
            [],
            $instanceId
        );
    }

    /**
     * [BETA] post a text or media status/story
     */
    public function postStatus(
        ?string $content = null,
        ?string $mediaUrl = null,
        ?string $mediaCaption = null,
        ?string $mediaName = null,
        ?int $backgroundColor = null,
        ?int $fontStyle = null,
        ?bool $sendVideoAsGif = null,
        ?bool $sendAudioAsVoice = null,
        ?array $audience = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'post-status',
            compact('content', 'mediaUrl', 'mediaCaption', 'mediaName', 'backgroundColor', 'fontStyle', 'sendVideoAsGif', 'sendAudioAsVoice', 'audience'),
            $instanceId
        );
    }

    /**
     * [BETA] set the Status privacy
     */
    public function setStatusPrivacy(
        string $type,
        ?array $contacts = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'set-status-privacy',
            compact('type', 'contacts'),
            $instanceId
        );
    }

    /**
     * [BETA] get the current Status privacy
     */
    public function getStatusPrivacy(
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-status-privacy',
            [],
            $instanceId
        );
    }

    /**
     * get profile picture URL
     */
    public function getProfilePicUrl(
        string $contactId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-profile-pic-url',
            compact('contactId'),
            $instanceId
        );
    }

    /**
     * get contact LID and phone
     */
    public function getLid(
        array $contactIds,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-lid',
            compact('contactIds'),
            $instanceId
        );
    }

    /**
     * [BETA] add and update contact
     */
    public function upsertContact(
        string $phoneNumber,
        string $firstName,
        string $lastName,
        ?bool $syncToAddressbook = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'upsert-contact',
            compact('phoneNumber', 'firstName', 'lastName', 'syncToAddressbook'),
            $instanceId
        );
    }

    /**
     * delete contact
     */
    public function deleteContact(
        string $phoneNumber,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'delete-contact',
            compact('phoneNumber'),
            $instanceId
        );
    }

    /**
     * block a contact
     */
    public function blockContact(
        string $contactId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'block-contact',
            compact('contactId'),
            $instanceId
        );
    }

    /**
     * unblock a contact
     */
    public function unblockContact(
        string $contactId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'unblock-contact',
            compact('contactId'),
            $instanceId
        );
    }

    /**
     * get blocked contacts
     */
    public function getBlockedContacts(
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-blocked-contacts',
            [],
            $instanceId
        );
    }

    /**
     * get common groups with contact
     */
    public function getCommonGroups(
        string $contactId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-common-groups',
            compact('contactId'),
            $instanceId
        );
    }

    /**
     * get contact about info
     */
    public function getContactAboutInfo(
        string $contactId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-contact-about-info',
            compact('contactId'),
            $instanceId
        );
    }

    /**
     * delete chat by id
     */
    public function deleteChatById(
        string $chatId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'delete-chat-by-id',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * get message reactions
     */
    public function getReactions(
        ?string $messageId = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-reactions',
            compact('messageId'),
            $instanceId
        );
    }

    /**
     * react to message
     */
    public function reactToMessage(
        string $messageId,
        string $reaction,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'react-to-message',
            compact('messageId', 'reaction'),
            $instanceId
        );
    }

    /**
     * get message mentions
     */
    public function getMessageMentions(
        string $messageId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-message-mentions',
            compact('messageId'),
            $instanceId
        );
    }

    /**
     * pin message
     */
    public function pinMessage(
        string $messageId,
        ?int $duration = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'pin-message',
            compact('messageId', 'duration'),
            $instanceId
        );
    }

    /**
     * unpin message
     */
    public function unpinMessage(
        string $messageId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'unpin-message',
            compact('messageId'),
            $instanceId
        );
    }

    /**
     * star message
     */
    public function starMessage(
        string $messageId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'star-message',
            compact('messageId'),
            $instanceId
        );
    }

    /**
     * unstar message
     */
    public function unstarMessage(
        string $messageId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'unstar-message',
            compact('messageId'),
            $instanceId
        );
    }

    /**
     * update group settings
     */
    public function updateGroupSettings(
        string $chatId,
        ?bool $messageAdminOnly = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'update-group-settings',
            compact('chatId', 'messageAdminOnly'),
            $instanceId
        );
    }

    /**
     * approve group membership requests
     */
    public function acceptGroupMemberRequests(
        string $chatId,
        array|string|null $requesterIds = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'accept-group-member-requests',
            compact('chatId', 'requesterIds'),
            $instanceId
        );
    }

    /**
     * deny group membership requests
     */
    public function denyGroupMemberRequests(
        string $chatId,
        array|string|null $requesterIds = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'deny-group-member-requests',
            compact('chatId', 'requesterIds'),
            $instanceId
        );
    }

    /**
     * get group membership requests
     */
    public function getGroupMemberRequests(
        string $chatId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-group-member-requests',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * accept group invite
     */
    public function acceptInvite(
        string $inviteCode,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'accept-invite',
            compact('inviteCode'),
            $instanceId
        );
    }

    /**
     * accept group invite
     */
    public function acceptGroupInvite(
        ?string $inviteCode = null,
        ?array $inviteData = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'accept-group-invite',
            compact('inviteCode', 'inviteData'),
            $instanceId
        );
    }

    /**
     * get group invite info
     */
    public function getInviteInfo(
        string $inviteCode,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-invite-info',
            compact('inviteCode'),
            $instanceId
        );
    }

    /**
     * create a channel
     */
    public function createChannel(
        string $name,
        ?string $description = null,
        ?string $pictureUrl = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'create-channel',
            compact('name', 'description', 'pictureUrl'),
            $instanceId
        );
    }

    /**
     * get channels
     */
    public function getChannels(
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-channels',
            [],
            $instanceId
        );
    }

    /**
     * get channel by id
     */
    public function getChannelById(
        ?string $channelId = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-channel-by-id',
            compact('channelId'),
            $instanceId
        );
    }

    /**
     * subscribe to channel
     */
    public function subscribeToChannel(
        ?string $channelId = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'subscribe-to-channel',
            compact('channelId'),
            $instanceId
        );
    }

    /**
     * unsubscribe from channel
     */
    public function unsubscribeFromChannel(
        ?string $channelId = null,
        ?bool $deleteChannelData = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'unsubscribe-from-channel',
            compact('channelId', 'deleteChannelData'),
            $instanceId
        );
    }

    /**
     * search channels
     */
    public function searchChannels(
        ?array $countryCodes = null,
        ?string $searchText = null,
        ?string $view = null,
        ?int $limit = null,
        ?bool $skipSubscribedNewsletters = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'search-channels',
            compact('countryCodes', 'searchText', 'view', 'limit', 'skipSubscribedNewsletters'),
            $instanceId
        );
    }

    /**
     * [BETA] create a community
     */
    public function createCommunity(
        string $title,
        ?string $description = null,
        ?bool $closed = null,
        ?bool $allowNonAdminSubGroupCreation = null,
        ?bool $createGeneralChat = null,
        ?array $existingGroupIds = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'create-community',
            compact('title', 'description', 'closed', 'allowNonAdminSubGroupCreation', 'createGeneralChat', 'existingGroupIds'),
            $instanceId
        );
    }

    /**
     * [BETA] get communities
     */
    public function getCommunities(
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-communities',
            [],
            $instanceId
        );
    }

    /**
     * [BETA] get community by id
     */
    public function getCommunityById(
        string $communityId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-community-by-id',
            compact('communityId'),
            $instanceId
        );
    }

    /**
     * [BETA] get community subgroups
     */
    public function getCommunitySubgroups(
        string $communityId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-community-subgroups',
            compact('communityId'),
            $instanceId
        );
    }

    /**
     * [BETA] send community announcement
     */
    public function sendCommunityAnnouncement(
        string $communityId,
        ?string $target = null,
        ?string $message = null,
        ?string $mediaUrl = null,
        ?string $mediaCaption = null,
        ?string $mediaName = null,
        ?bool $previewLink = null,
        ?bool $asSticker = null,
        ?bool $asVoice = null,
        ?bool $asDocument = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'send-community-announcement',
            compact('communityId', 'target', 'message', 'mediaUrl', 'mediaCaption', 'mediaName', 'previewLink', 'asSticker', 'asVoice', 'asDocument'),
            $instanceId
        );
    }

    /**
     * [BETA] link community subgroup
     */
    public function linkCommunitySubgroup(
        string $communityId,
        array $groupIds,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'link-community-subgroup',
            compact('communityId', 'groupIds'),
            $instanceId
        );
    }

    /**
     * [BETA] unlink community subgroup
     */
    public function unlinkCommunitySubgroup(
        string $communityId,
        array $groupIds,
        ?bool $removeOrphanMembers = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'unlink-community-subgroup',
            compact('communityId', 'groupIds', 'removeOrphanMembers'),
            $instanceId
        );
    }

    /**
     * [BETA] leave community
     */
    public function leaveCommunity(
        string $communityId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'leave-community',
            compact('communityId'),
            $instanceId
        );
    }

    /**
     * archive chat
     */
    public function archiveChat(
        string $chatId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'archive-chat',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * unarchive chat
     */
    public function unarchiveChat(
        string $chatId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'unarchive-chat',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * get all labels
     */
    public function getLabels(
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-labels',
            [],
            $instanceId
        );
    }

    /**
     * get label by id
     */
    public function getLabelById(
        int $labelId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-label-by-id',
            compact('labelId'),
            $instanceId
        );
    }

    /**
     * get chat labels
     */
    public function getChatLabels(
        string $chatId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-chat-labels',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * get chats by labelId
     */
    public function getChatsByLabelId(
        int $labelId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-chats-by-label-id',
            compact('labelId'),
            $instanceId
        );
    }

    /**
     * change chat labels
     */
    public function changeChatLabels(
        string $chatId,
        array $labelIds,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'change-chat-labels',
            compact('chatId', 'labelIds'),
            $instanceId
        );
    }

    /**
     * send presence available
     */
    public function sendPresenceAvailable(
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'send-presence-available',
            [],
            $instanceId
        );
    }

    /**
     * set status
     */
    public function setStatus(
        string $status,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'set-status',
            compact('status'),
            $instanceId
        );
    }

    /**
     * set display name
     */
    public function setDisplayName(
        string $displayName,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'set-display-name',
            compact('displayName'),
            $instanceId
        );
    }

    /**
     * request pairing code
     */
    public function requestPairingCode(
        string $phoneNumber,
        ?bool $showNotification = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'request-pairing-code',
            compact('phoneNumber', 'showNotification'),
            $instanceId
        );
    }

    /**
     * send typing state
     */
    public function sendTyping(
        string $chatId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'send-typing',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * clear chat messages
     */
    public function clearChatMessages(
        string $chatId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'clear-chat-messages',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * sync chat history
     */
    public function syncChatHistory(
        string $chatId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'sync-chat-history',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * stop typing indicator
     */
    public function sendStopTyping(
        ?string $chatId = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'send-stop-typing',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * send presence unavailable
     */
    public function sendPresenceUnavailable(
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'send-presence-unavailable',
            [],
            $instanceId
        );
    }

    /**
     * [BETA] subscribe to and fetch current presence of a chat
     */
    public function getChatPresence(
        string $chatId,
        ?bool $waitForData = null,
        ?int $timeoutMs = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-chat-presence',
            compact('chatId', 'waitForData', 'timeoutMs'),
            $instanceId
        );
    }

    /**
     * [BETA] read cached presence for a chat without subscribing
     */
    public function getChatPresenceSnapshot(
        string $chatId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-chat-presence-snapshot',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * send event message
     */
    public function sendEvent(
        string $chatId,
        string $name,
        int|string $startTime,
        ?string $description = null,
        int|string|null $endTime = null,
        ?string $location = null,
        ?string $callType = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'send-event',
            compact('chatId', 'name', 'startTime', 'description', 'endTime', 'location', 'callType'),
            $instanceId
        );
    }

    /**
     * vote on poll
     */
    public function voteOnPoll(
        string $messageId,
        array $selectedOptions,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'vote-on-poll',
            compact('messageId', 'selectedOptions'),
            $instanceId
        );
    }

    /**
     * edit scheduled event
     */
    public function editScheduledEvent(
        string $messageId,
        ?string $name = null,
        ?int $startTimeTs = null,
        ?array $eventSendOptions = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'edit-scheduled-event',
            compact('messageId', 'name', 'startTimeTs', 'eventSendOptions'),
            $instanceId
        );
    }

    /**
     * get pinned messages
     */
    public function getPinnedMessages(
        string $chatId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-pinned-messages',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * set device name
     */
    public function setDeviceName(
        ?string $deviceName = null,
        ?string $browserName = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'set-device-name',
            compact('deviceName', 'browserName'),
            $instanceId
        );
    }

    /**
     * create call link
     */
    public function createCallLink(
        int|string $startTime,
        string $callType,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'create-call-link',
            compact('startTime', 'callType'),
            $instanceId
        );
    }

    /**
     * send event response
     */
    public function sendEventResponse(
        int $eventResponse,
        string $eventMessageId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'send-event-response',
            compact('eventResponse', 'eventMessageId'),
            $instanceId
        );
    }

    /**
     * revoke status message
     */
    public function revokeStatusMessage(
        string $messageId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'revoke-status-message',
            compact('messageId'),
            $instanceId
        );
    }

    /**
     * add customer note
     */
    public function addCustomerNote(
        string $chatId,
        string $note,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'add-customer-note',
            compact('chatId', 'note'),
            $instanceId
        );
    }

    /**
     * get customer note
     */
    public function getCustomerNote(
        string $chatId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-customer-note',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * get broadcast
     */
    public function getBroadcast(
        string $contactId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-broadcast',
            compact('contactId'),
            $instanceId
        );
    }

    /**
     * revoke status
     */
    public function revokeStatus(
        string $messageId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'revoke-status',
            compact('messageId'),
            $instanceId
        );
    }

    /**
     * [BETA] get privacy settings
     */
    public function getPrivacySettings(
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-privacy-settings',
            [],
            $instanceId
        );
    }

    /**
     * [BETA] set privacy setting
     */
    public function setPrivacySetting(
        string $category,
        string $value,
        ?array $disallowedList = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'set-privacy-setting',
            compact('category', 'value', 'disallowedList'),
            $instanceId
        );
    }

    /**
     * [BETA] get disappearing messages
     */
    public function getDisappearingMessages(
        string $chatId,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-disappearing-messages',
            compact('chatId'),
            $instanceId
        );
    }

    /**
     * [BETA] set disappearing messages
     */
    public function setDisappearingMessages(
        string $chatId,
        int $duration,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'set-disappearing-messages',
            compact('chatId', 'duration'),
            $instanceId
        );
    }

    /**
     * [BETA] get disappearing durations
     */
    public function getDisappearingDurations(
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-disappearing-durations',
            [],
            $instanceId
        );
    }

    /**
     * [BETA] get business profile
     */
    public function getBusinessProfile(
        ?string $userId = null,
        ?bool $withCompliance = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-business-profile',
            compact('userId', 'withCompliance'),
            $instanceId
        );
    }

    /**
     * [BETA] get business categories
     */
    public function getBusinessCategories(
        ?string $parentId = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-business-categories',
            compact('parentId'),
            $instanceId
        );
    }

    /**
     * [BETA] set business profile
     */
    public function setBusinessProfile(
        ?string $description = null,
        ?string $email = null,
        ?string $address = null,
        ?float $latitude = null,
        ?float $longitude = null,
        ?array $website = null,
        ?array $categories = null,
        ?array $businessHours = null,
        ?string $priceTier = null,
        ?array $serviceAreas = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'set-business-profile',
            compact('description', 'email', 'address', 'latitude', 'longitude', 'website', 'categories', 'businessHours', 'priceTier', 'serviceAreas'),
            $instanceId
        );
    }

    /**
     * [BETA] get quick replies
     */
    public function getQuickReplies(
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'get-quick-replies',
            [],
            $instanceId
        );
    }

    /**
     * [BETA] create quick reply
     */
    public function createQuickReply(
        string $shortcut,
        string $message,
        ?array $keywords = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'create-quick-reply',
            compact('shortcut', 'message', 'keywords'),
            $instanceId
        );
    }

    /**
     * [BETA] update quick reply
     */
    public function updateQuickReply(
        string $id,
        ?string $shortcut = null,
        ?string $message = null,
        ?array $keywords = null,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'update-quick-reply',
            compact('id', 'shortcut', 'message', 'keywords'),
            $instanceId
        );
    }

    /**
     * [BETA] delete quick reply
     */
    public function deleteQuickReply(
        string $id,
        ?int $instanceId = null
    ): ExecutedAction {
        return $this->executeAction(
            'delete-quick-reply',
            compact('id'),
            $instanceId
        );
    }
}
