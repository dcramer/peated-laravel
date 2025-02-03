<?php

namespace App\Enums;

enum NotificationType: string
{
    case Comment = 'comment';
    case Toast = 'toast';
    case FriendRequest = 'friend_request';

}
