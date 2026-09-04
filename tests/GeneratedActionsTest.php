<?php

declare(strict_types=1);

namespace WaAPI\WaAPI\Tests;

/**
 * One test per generated action method: the action name and the exact payload
 * that leaves the SDK, asserted against a faked transport.
 *
 * These methods hold no logic -- they name an action and forward named
 * parameters -- so the failures they can actually have are a wrong action
 * string and a parameter dropped from compact(). Both are visible in the
 * outgoing request and invisible everywhere else, because a dropped field
 * still produces a successful call.
 *
 * Sample values carry their own parameter name, so two adjacent parameters
 * swapped fails here instead of passing with a complete-looking payload.
 *
 * Covers only the generated methods. The 25 hand-written ones are excluded:
 * several take different parameters than the spec describes (sendVcard takes a
 * Vcard object, createGroup names its parameters differently), so a generated
 * test would assert the wrong contract for them.
 *
 * Generated alongside the methods -- regenerate both together.
 */
class GeneratedActionsTest extends TestCase
{
    use FakesTheApi;

    public function test_send_media_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->sendMedia('chatId-value');

        $this->assertActionCalled('send-media', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_send_location_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->sendLocation('chatId-value', 1.5, 1.5);

        $this->assertActionCalled('send-location', [
            'chatId' => 'chatId-value',
            'latitude' => 1.5,
            'longitude' => 1.5,
        ]);
    }

    public function test_mark_chat_unread_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->markChatUnread('chatId-value');

        $this->assertActionCalled('mark-chat-unread', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_mute_chat_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->muteChat('chatId-value');

        $this->assertActionCalled('mute-chat', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_unmute_chat_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->unmuteChat('chatId-value');

        $this->assertActionCalled('unmute-chat', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_pin_chat_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->pinChat('chatId-value');

        $this->assertActionCalled('pin-chat', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_unpin_chat_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->unpinChat('chatId-value');

        $this->assertActionCalled('unpin-chat', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_download_media_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->downloadMedia('messageId-value');

        $this->assertActionCalled('download-media', [
            'messageId' => 'messageId-value',
        ]);
    }

    public function test_get_message_info_by_id_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getMessageInfoById('messageId-value');

        $this->assertActionCalled('get-message-info-by-id', [
            'messageId' => 'messageId-value',
        ]);
    }

    public function test_edit_message_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->editMessage('messageId-value', 'message-value');

        $this->assertActionCalled('edit-message', [
            'messageId' => 'messageId-value',
            'message' => 'message-value',
        ]);
    }

    public function test_forward_message_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->forwardMessage('messageId-value', 'chatId-value');

        $this->assertActionCalled('forward-message', [
            'messageId' => 'messageId-value',
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_search_messages_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->searchMessages('query-value');

        $this->assertActionCalled('search-messages', [
            'query' => 'query-value',
        ]);
    }

    public function test_get_number_id_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getNumberId('number-value');

        $this->assertActionCalled('get-number-id', [
            'number' => 'number-value',
        ]);
    }

    public function test_get_country_code_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getCountryCode('number-value');

        $this->assertActionCalled('get-country-code', [
            'number' => 'number-value',
        ]);
    }

    public function test_get_formatted_number_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getFormattedNumber('number-value');

        $this->assertActionCalled('get-formatted-number', [
            'number' => 'number-value',
        ]);
    }

    public function test_create_poll_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->createPoll('chatId-value', 'caption-value', ['options-one', 'options-two']);

        $this->assertActionCalled('create-poll', [
            'chatId' => 'chatId-value',
            'caption' => 'caption-value',
            'options' => ['options-one', 'options-two'],
        ]);
    }

    public function test_get_poll_votes_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getPollVotes('messageId-value');

        $this->assertActionCalled('get-poll-votes', [
            'messageId' => 'messageId-value',
        ]);
    }

    public function test_get_stories_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getStories();

        $this->assertActionCalled('get-stories', []);
    }

    public function test_post_status_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->postStatus();

        $this->assertActionCalled('post-status', []);
    }

    public function test_set_status_privacy_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->setStatusPrivacy('type-value');

        $this->assertActionCalled('set-status-privacy', [
            'type' => 'type-value',
        ]);
    }

    public function test_get_status_privacy_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getStatusPrivacy();

        $this->assertActionCalled('get-status-privacy', []);
    }

    public function test_get_profile_pic_url_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getProfilePicUrl('contactId-value');

        $this->assertActionCalled('get-profile-pic-url', [
            'contactId' => 'contactId-value',
        ]);
    }

    public function test_get_lid_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getLid(['contactIds-one', 'contactIds-two']);

        $this->assertActionCalled('get-lid', [
            'contactIds' => ['contactIds-one', 'contactIds-two'],
        ]);
    }

    public function test_upsert_contact_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->upsertContact('phoneNumber-value', 'firstName-value', 'lastName-value');

        $this->assertActionCalled('upsert-contact', [
            'phoneNumber' => 'phoneNumber-value',
            'firstName' => 'firstName-value',
            'lastName' => 'lastName-value',
        ]);
    }

    public function test_delete_contact_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->deleteContact('phoneNumber-value');

        $this->assertActionCalled('delete-contact', [
            'phoneNumber' => 'phoneNumber-value',
        ]);
    }

    public function test_block_contact_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->blockContact('contactId-value');

        $this->assertActionCalled('block-contact', [
            'contactId' => 'contactId-value',
        ]);
    }

    public function test_unblock_contact_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->unblockContact('contactId-value');

        $this->assertActionCalled('unblock-contact', [
            'contactId' => 'contactId-value',
        ]);
    }

    public function test_get_blocked_contacts_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getBlockedContacts();

        $this->assertActionCalled('get-blocked-contacts', []);
    }

    public function test_get_common_groups_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getCommonGroups('contactId-value');

        $this->assertActionCalled('get-common-groups', [
            'contactId' => 'contactId-value',
        ]);
    }

    public function test_get_contact_about_info_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getContactAboutInfo('contactId-value');

        $this->assertActionCalled('get-contact-about-info', [
            'contactId' => 'contactId-value',
        ]);
    }

    public function test_delete_chat_by_id_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->deleteChatById('chatId-value');

        $this->assertActionCalled('delete-chat-by-id', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_get_reactions_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getReactions();

        $this->assertActionCalled('get-reactions', []);
    }

    public function test_react_to_message_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->reactToMessage('messageId-value', 'reaction-value');

        $this->assertActionCalled('react-to-message', [
            'messageId' => 'messageId-value',
            'reaction' => 'reaction-value',
        ]);
    }

    public function test_get_message_mentions_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getMessageMentions('messageId-value');

        $this->assertActionCalled('get-message-mentions', [
            'messageId' => 'messageId-value',
        ]);
    }

    public function test_pin_message_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->pinMessage('messageId-value');

        $this->assertActionCalled('pin-message', [
            'messageId' => 'messageId-value',
        ]);
    }

    public function test_unpin_message_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->unpinMessage('messageId-value');

        $this->assertActionCalled('unpin-message', [
            'messageId' => 'messageId-value',
        ]);
    }

    public function test_star_message_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->starMessage('messageId-value');

        $this->assertActionCalled('star-message', [
            'messageId' => 'messageId-value',
        ]);
    }

    public function test_unstar_message_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->unstarMessage('messageId-value');

        $this->assertActionCalled('unstar-message', [
            'messageId' => 'messageId-value',
        ]);
    }

    public function test_update_group_settings_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->updateGroupSettings('chatId-value');

        $this->assertActionCalled('update-group-settings', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_accept_group_member_requests_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->acceptGroupMemberRequests('chatId-value');

        $this->assertActionCalled('accept-group-member-requests', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_deny_group_member_requests_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->denyGroupMemberRequests('chatId-value');

        $this->assertActionCalled('deny-group-member-requests', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_get_group_member_requests_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getGroupMemberRequests('chatId-value');

        $this->assertActionCalled('get-group-member-requests', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_accept_invite_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->acceptInvite('inviteCode-value');

        $this->assertActionCalled('accept-invite', [
            'inviteCode' => 'inviteCode-value',
        ]);
    }

    public function test_accept_group_invite_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->acceptGroupInvite();

        $this->assertActionCalled('accept-group-invite', []);
    }

    public function test_get_invite_info_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getInviteInfo('inviteCode-value');

        $this->assertActionCalled('get-invite-info', [
            'inviteCode' => 'inviteCode-value',
        ]);
    }

    public function test_create_channel_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->createChannel('name-value');

        $this->assertActionCalled('create-channel', [
            'name' => 'name-value',
        ]);
    }

    public function test_get_channels_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getChannels();

        $this->assertActionCalled('get-channels', []);
    }

    public function test_get_channel_by_id_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getChannelById();

        $this->assertActionCalled('get-channel-by-id', []);
    }

    public function test_subscribe_to_channel_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->subscribeToChannel();

        $this->assertActionCalled('subscribe-to-channel', []);
    }

    public function test_unsubscribe_from_channel_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->unsubscribeFromChannel();

        $this->assertActionCalled('unsubscribe-from-channel', []);
    }

    public function test_search_channels_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->searchChannels();

        $this->assertActionCalled('search-channels', []);
    }

    public function test_create_community_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->createCommunity('title-value');

        $this->assertActionCalled('create-community', [
            'title' => 'title-value',
        ]);
    }

    public function test_get_communities_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getCommunities();

        $this->assertActionCalled('get-communities', []);
    }

    public function test_get_community_by_id_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getCommunityById('communityId-value');

        $this->assertActionCalled('get-community-by-id', [
            'communityId' => 'communityId-value',
        ]);
    }

    public function test_get_community_subgroups_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getCommunitySubgroups('communityId-value');

        $this->assertActionCalled('get-community-subgroups', [
            'communityId' => 'communityId-value',
        ]);
    }

    public function test_send_community_announcement_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->sendCommunityAnnouncement('communityId-value');

        $this->assertActionCalled('send-community-announcement', [
            'communityId' => 'communityId-value',
        ]);
    }

    public function test_link_community_subgroup_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->linkCommunitySubgroup('communityId-value', ['groupIds-one', 'groupIds-two']);

        $this->assertActionCalled('link-community-subgroup', [
            'communityId' => 'communityId-value',
            'groupIds' => ['groupIds-one', 'groupIds-two'],
        ]);
    }

    public function test_unlink_community_subgroup_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->unlinkCommunitySubgroup('communityId-value', ['groupIds-one', 'groupIds-two']);

        $this->assertActionCalled('unlink-community-subgroup', [
            'communityId' => 'communityId-value',
            'groupIds' => ['groupIds-one', 'groupIds-two'],
        ]);
    }

    public function test_leave_community_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->leaveCommunity('communityId-value');

        $this->assertActionCalled('leave-community', [
            'communityId' => 'communityId-value',
        ]);
    }

    public function test_archive_chat_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->archiveChat('chatId-value');

        $this->assertActionCalled('archive-chat', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_unarchive_chat_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->unarchiveChat('chatId-value');

        $this->assertActionCalled('unarchive-chat', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_get_labels_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getLabels();

        $this->assertActionCalled('get-labels', []);
    }

    public function test_get_label_by_id_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getLabelById(42);

        $this->assertActionCalled('get-label-by-id', [
            'labelId' => 42,
        ]);
    }

    public function test_get_chat_labels_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getChatLabels('chatId-value');

        $this->assertActionCalled('get-chat-labels', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_get_chats_by_label_id_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getChatsByLabelId(42);

        $this->assertActionCalled('get-chats-by-label-id', [
            'labelId' => 42,
        ]);
    }

    public function test_change_chat_labels_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->changeChatLabels('chatId-value', ['labelIds-one', 'labelIds-two']);

        $this->assertActionCalled('change-chat-labels', [
            'chatId' => 'chatId-value',
            'labelIds' => ['labelIds-one', 'labelIds-two'],
        ]);
    }

    public function test_send_presence_available_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->sendPresenceAvailable();

        $this->assertActionCalled('send-presence-available', []);
    }

    public function test_set_status_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->setStatus('status-value');

        $this->assertActionCalled('set-status', [
            'status' => 'status-value',
        ]);
    }

    public function test_set_display_name_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->setDisplayName('displayName-value');

        $this->assertActionCalled('set-display-name', [
            'displayName' => 'displayName-value',
        ]);
    }

    public function test_request_pairing_code_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->requestPairingCode('phoneNumber-value');

        $this->assertActionCalled('request-pairing-code', [
            'phoneNumber' => 'phoneNumber-value',
        ]);
    }

    public function test_send_typing_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->sendTyping('chatId-value');

        $this->assertActionCalled('send-typing', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_clear_chat_messages_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->clearChatMessages('chatId-value');

        $this->assertActionCalled('clear-chat-messages', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_sync_chat_history_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->syncChatHistory('chatId-value');

        $this->assertActionCalled('sync-chat-history', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_send_stop_typing_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->sendStopTyping();

        $this->assertActionCalled('send-stop-typing', []);
    }

    public function test_send_presence_unavailable_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->sendPresenceUnavailable();

        $this->assertActionCalled('send-presence-unavailable', []);
    }

    public function test_get_chat_presence_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getChatPresence('chatId-value');

        $this->assertActionCalled('get-chat-presence', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_get_chat_presence_snapshot_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getChatPresenceSnapshot('chatId-value');

        $this->assertActionCalled('get-chat-presence-snapshot', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_send_event_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->sendEvent('chatId-value', 'name-value', 'startTime-value');

        $this->assertActionCalled('send-event', [
            'chatId' => 'chatId-value',
            'name' => 'name-value',
            'startTime' => 'startTime-value',
        ]);
    }

    public function test_vote_on_poll_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->voteOnPoll('messageId-value', ['selectedOptions-one', 'selectedOptions-two']);

        $this->assertActionCalled('vote-on-poll', [
            'messageId' => 'messageId-value',
            'selectedOptions' => ['selectedOptions-one', 'selectedOptions-two'],
        ]);
    }

    public function test_edit_scheduled_event_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->editScheduledEvent('messageId-value');

        $this->assertActionCalled('edit-scheduled-event', [
            'messageId' => 'messageId-value',
        ]);
    }

    public function test_get_pinned_messages_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getPinnedMessages('chatId-value');

        $this->assertActionCalled('get-pinned-messages', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_set_device_name_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->setDeviceName();

        $this->assertActionCalled('set-device-name', []);
    }

    public function test_create_call_link_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->createCallLink('startTime-value', 'callType-value');

        $this->assertActionCalled('create-call-link', [
            'startTime' => 'startTime-value',
            'callType' => 'callType-value',
        ]);
    }

    public function test_send_event_response_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->sendEventResponse(42, 'eventMessageId-value');

        $this->assertActionCalled('send-event-response', [
            'eventResponse' => 42,
            'eventMessageId' => 'eventMessageId-value',
        ]);
    }

    public function test_revoke_status_message_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->revokeStatusMessage('messageId-value');

        $this->assertActionCalled('revoke-status-message', [
            'messageId' => 'messageId-value',
        ]);
    }

    public function test_add_customer_note_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->addCustomerNote('chatId-value', 'note-value');

        $this->assertActionCalled('add-customer-note', [
            'chatId' => 'chatId-value',
            'note' => 'note-value',
        ]);
    }

    public function test_get_customer_note_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getCustomerNote('chatId-value');

        $this->assertActionCalled('get-customer-note', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_get_broadcast_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getBroadcast('contactId-value');

        $this->assertActionCalled('get-broadcast', [
            'contactId' => 'contactId-value',
        ]);
    }

    public function test_revoke_status_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->revokeStatus('messageId-value');

        $this->assertActionCalled('revoke-status', [
            'messageId' => 'messageId-value',
        ]);
    }

    public function test_get_privacy_settings_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getPrivacySettings();

        $this->assertActionCalled('get-privacy-settings', []);
    }

    public function test_set_privacy_setting_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->setPrivacySetting('category-value', 'value-value');

        $this->assertActionCalled('set-privacy-setting', [
            'category' => 'category-value',
            'value' => 'value-value',
        ]);
    }

    public function test_get_disappearing_messages_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getDisappearingMessages('chatId-value');

        $this->assertActionCalled('get-disappearing-messages', [
            'chatId' => 'chatId-value',
        ]);
    }

    public function test_set_disappearing_messages_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->setDisappearingMessages('chatId-value', 42);

        $this->assertActionCalled('set-disappearing-messages', [
            'chatId' => 'chatId-value',
            'duration' => 42,
        ]);
    }

    public function test_get_disappearing_durations_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getDisappearingDurations();

        $this->assertActionCalled('get-disappearing-durations', []);
    }

    public function test_get_business_profile_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getBusinessProfile();

        $this->assertActionCalled('get-business-profile', []);
    }

    public function test_get_business_categories_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getBusinessCategories();

        $this->assertActionCalled('get-business-categories', []);
    }

    public function test_set_business_profile_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->setBusinessProfile();

        $this->assertActionCalled('set-business-profile', []);
    }

    public function test_get_quick_replies_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getQuickReplies();

        $this->assertActionCalled('get-quick-replies', []);
    }

    public function test_create_quick_reply_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->createQuickReply('shortcut-value', 'message-value');

        $this->assertActionCalled('create-quick-reply', [
            'shortcut' => 'shortcut-value',
            'message' => 'message-value',
        ]);
    }

    public function test_update_quick_reply_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->updateQuickReply('id-value');

        $this->assertActionCalled('update-quick-reply', [
            'id' => 'id-value',
        ]);
    }

    public function test_delete_quick_reply_sends_the_right_action(): void
    {
        $waapi = $this->fakeAction();

        $waapi->deleteQuickReply('id-value');

        $this->assertActionCalled('delete-quick-reply', [
            'id' => 'id-value',
        ]);
    }
}
