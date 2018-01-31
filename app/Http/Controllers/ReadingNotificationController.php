<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\ReadingQuestionAnswerLessonService;
use App\Services\ReadingNotificationService;
use App\Events\CommentNotificationEvent;
use App\Services\UcenduUserService;

class ReadingNotificationController extends Controller
{
    public function getNotification() {
        $readingNotificationService = new ReadingNotificationService();
        $list_notifications = $readingNotificationService->getAllNotifications();
        return json_encode(['list_notis' => $list_notifications]);
    }

    public function readNotification($domain, $id) {
        $readingNotificationService = new ReadingNotificationService();
        $result = $readingNotificationService->markAsReadNotification($id);
        return json_encode(['ok' => $result]);
    }

    public function markAllNotificationAsRead() {
        $readingNotificationService = new ReadingNotificationService();
        $result = $readingNotificationService->markAllAsReadNotification();
        return json_encode(['ok' => $result]);
    }
}
