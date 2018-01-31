<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*********************************************************
 *
 *                  ROUTE FOR PUBLIC
 *
 *********************************************************/
Route::pattern('nameDomain', '(www.ucendu.bipham|ucendu.bipham|www.ucendu.com|ucendu.com|www.english-stories.com|english-stories.com)');
// Authentication routes...
Route::get('login', ['as'=>'getLogin', 'uses' => 'Auth\LoginController@getLogin']);
Route::post('login',['as'=>'postLogin','uses'=>'Auth\LoginController@postLogin']);
Route::get('changePassword', ['as'=>'getChangePassword', 'uses' => 'Client\UserController@getChangePassword']);
Route::post('changePassword',['as'=>'postChangePassword','uses'=>'Client\UserController@postChangePassword']);
Route::get('logout',['as'=>'logout','uses'=>'Auth\LoginController@getLogout']);
Route::get('deleteCommentReading/{comment_id}',['as'=>'deleteCommentReading','uses'=>'Admin\ReadingCommentController@deleteCommentReading']);
Route::get('setPublicReadingComment/{comment_id}',['as'=>'setPublicReadingComment','uses'=>'Admin\ReadingCommentController@setPublicReadingComment']);
Route::get('setPrivateReadingComment/{comment_id}',['as'=>'setPrivateReadingComment','uses'=>'Admin\ReadingCommentController@setPrivateReadingComment']);
Route::post('managerReadingLessonJSON',['as'=>'managerReadingLessonJSON','uses'=>'Admin\ReadingLessonController@managerReadingLessonJSON']);
/*********************************************************
 *
 *                  ROUTE FOR ADMIN MODULE
 *
 *********************************************************/

Route::group(['domain' => 'admin.{nameDomain}', 'middleware' => ['adminAuth']], function () {
    //************ For Update ***************
    Route::get('updateTotalLessons', ['as' => 'updateTotalLessons', 'uses' => 'Admin\ReadingLessonController@updateTotalLessons']);

    //************ For Full Test ***************
    Route::get('getListFullTestLessonUploaded/{level_lesson_id}', ['as' => 'getListFullTestLessonUploaded', 'uses' => 'Admin\ReadingFullTestController@getListFullTestLessonUploaded']);
    Route::get('getAllOrderParagraphOfFullTest/{full_test_id}', ['as' => 'getAllOrderParagraphOfFullTest', 'uses' => 'Admin\ReadingFullTestController@getAllOrderParagraphOfFullTest']);
    Route::get('createNewFullTest', ['as' => 'createNewFullTest', 'uses' => 'Admin\ReadingFullTestController@createNewFullTest']);

    //************ For Reading Lesson *************
    Route::get('createNewReadingLesson/{type_lesson_id}',['as'=>'getCreateNewReadingLesson','uses'=>'Admin\ReadingLessonController@getCreateNewReadingLesson']);
    Route::post('createNewReadingLesson/{type_lesson_id}',['as'=>'postCreateNewReadingLesson','uses'=>'Admin\ReadingLessonController@postCreateNewReadingLesson']);

    Route::get('createNewLevelLesson',['as'=>'getCreateNewLevelLesson','uses'=>'Admin\ReadingLevelLessonController@getCreateNewLevelLesson']);
    Route::post('createNewLevelLesson',['as'=>'postCreateNewLevelLesson','uses'=>'Admin\ReadingLevelLessonController@postCreateNewLevelLesson']);

    Route::get('deleteLessonReading/{type_lesson_id}-{lesson_id}',['as'=>'deleteLessonReading','uses'=>'Admin\ReadingLessonController@deleteLessonReading']);

    Route::get('editLessonReading/{type_lesson_id}/{lesson_id}',['as'=>'getEditLessonReading','uses'=>'Admin\ReadingLessonController@getEditLessonReading']);

    Route::post('updateContentLessonReading/{type_lesson_id}/{lesson_id}',['as'=>'updateContentLessonReading','uses'=>'Admin\ReadingLessonController@updateContentLessonReading']);

    Route::post('updateQuizReading/{type_lesson_id}/{lesson_id}',['as'=>'updateQuizReading','uses'=>'Admin\ReadingLessonController@updateQuizReading']);

    Route::get('managerReadingLesson/{type_lesson_id}',['as'=>'managerReadingLesson','uses'=>'Admin\ReadingLessonController@managerReadingLesson']);

    Route::post('updateTitleLesson/{type_lesson_id}-{lesson_id}',['as'=>'updateTitleLesson','uses'=>'Admin\ReadingLessonController@updateTitleLesson']);

    Route::post('updateBasicInfoLesson/{type_lesson_id}-{lesson_id}',['as'=>'updateBasicInfoLesson','uses'=>'Admin\ReadingLessonController@updateBasicInfoLesson']);

    Route::post('updateLevelUserLesson/{type_lesson_id}-{lesson_id}',['as'=>'updateLevelUserLesson','uses'=>'Admin\ReadingLessonController@updateLevelUserLesson']);

    Route::get('updateLimitTimeLesson/{type_lesson_id}-{lesson_id}',['as'=>'updateLimitTimeLesson','uses'=>'Admin\ReadingLessonController@updateLimitTimeLesson']);

    //********** For Reading Question *************
    Route::get('createNewTypeQuestion',['as'=>'getCreateNewTypeQuestion','uses'=>'Admin\ReadingTypeQuestionController@getCreateNewTypeQuestion']);
    Route::post('createNewTypeQuestion',['as'=>'postCreateNewTypeQuestion','uses'=>'Admin\ReadingTypeQuestionController@postCreateNewTypeQuestion']);
    Route::get('managerTypeQuestion',['as'=>'managerTypeQuestion','uses'=>'Admin\ReadingTypeQuestionController@managerTypeQuestion']);
    Route::get('editTypeQuestion/{type_question_id}',['as'=>'getEditTypeQuestion','uses'=>'Admin\ReadingTypeQuestionController@getEditTypeQuestion']);
    Route::post('updateTypeQuestion/{type_question_id}',['as'=>'updateTypeQuestion','uses'=>'Admin\ReadingTypeQuestionController@updateTypeQuestion']);

    Route::get('createNewLearningTypeQuestion',['as'=>'getCreateNewLearningTypeQuestion','uses'=>'Admin\ReadingLearningTypeQuestionController@getCreateNewLearningTypeQuestion']);
    Route::post('createNewLearningTypeQuestion',['as'=>'postCreateNewLearningTypeQuestion','uses'=>'Admin\ReadingLearningTypeQuestionController@postCreateNewLearningTypeQuestion']);
    Route::get('getTypeQuestionByLevelLessonId',['as'=>'getTypeQuestionByLevelLessonId','uses'=>'Admin\ReadingTypeQuestionController@getTypeQuestionByLevelLessonId']);
    Route::get('onChangeLevelLessonIdAdmin',['as'=>'onChangeLevellLessonIdAdmin','uses'=>'Admin\ReadingLessonController@onChangeLevelLessonIdAdmin']);

    Route::get('getTypeQuestionForEditTest',['as'=>'getTypeQuestionForEditTest','uses'=>'Admin\ReadingTypeQuestionController@getTypeQuestionForEditTest']);

    //********** For Reading Vocabulary *************
    Route::get('createNewVocabulary',['as'=>'getCreateNewVocabulary','uses'=>'Admin\ReadingVocabularyController@getCreateNewVocabulary']);
    Route::post('createNewVocabulary',['as'=>'postCreateNewVocabulary','uses'=>'Admin\ReadingVocabularyController@postCreateNewVocabulary']);
    Route::post('createNewPhraseWord',['as'=>'postCreateNewPhraseWord','uses'=>'Admin\ReadingVocabularyController@postCreateNewPhraseWord']);

    //********** For Reading Notification + Comments *************/
    Route::get('createNewCate',['as'=>'createNewCate','uses'=>'Admin\CateController@createNewCate']);
//    Route::get('createNewTypeQuiz',['as'=>'createNewTypeQuiz','uses'=>'Admin\TypeQuestionController@createNewTypeQuiz']);
    Route::get('managerCommentReading',['as'=>'managerCommentReading','uses'=>'Admin\ReadingCommentController@managerCommentReading']);

    //********** For Reading User *************/
    Route::get('createNewUser',['as'=>'getCreateNewUser','uses'=>'Admin\UserController@getCreateNewUser']);
    Route::post('createNewUser',['as'=>'postCreateNewUser','uses'=>'Admin\UserController@postCreateNewUser']);
    Route::get('createNewLevelUser',['as'=>'getCreateNewLevelUser','uses'=>'Admin\ReadingLevelUserController@getCreateNewLevelUser']);
    Route::post('createNewLevelUser',['as'=>'postCreateNewLevelUser','uses'=>'Admin\ReadingLevelUserController@postCreateNewLevelUser']);

    //********** For English Story *************/
    Route::get('createNewStory',['as'=>'getCreateNewStory','uses'=>'Admin\StoryEnglishController@getCreateNewStory']);
    Route::post('createNewStory',['as'=>'postCreateNewStory','uses'=>'Admin\StoryEnglishController@postCreateNewStory']);

    Route::get('createNewChapterOfStory',['as'=>'getCreateNewChapterOfStory','uses'=>'Admin\StoryEnglishController@getCreateNewChapterOfStory']);
    Route::post('createNewChapterOfStory',['as'=>'postCreateNewChapterOfStory','uses'=>'Admin\StoryEnglishController@postCreateNewChapterOfStory']);

    Route::get('createNewComponentStory/{type}',['as'=>'getCreateNewComponentStory','uses'=>'Admin\StoryEnglishController@getCreateNewComponentStory']);
    Route::post('createNewComponentStory/{type}',['as'=>'postCreateNewComponentStory','uses'=>'Admin\StoryEnglishController@postCreateNewComponentStory']);

    Route::get('createNewAuthorStory',['as'=>'getCreateNewAuthorStory','uses'=>'Admin\StoryAuthorController@getCreateNewAuthorStory']);
    Route::post('createNewAuthorStory',['as'=>'postCreateNewAuthorStory','uses'=>'Admin\StoryAuthorController@postCreateNewAuthorStory']);

    Route::get('createNewHostDownload',['as'=>'getCreateNewHostDownload','uses'=>'Admin\HostDownloadController@getCreateNewHostDownload']);
    Route::post('createNewHostDownload',['as'=>'postCreateNewHostDownload','uses'=>'Admin\HostDownloadController@postCreateNewHostDownload']);

    Route::get('getAllOrderedChapterOfStory/{story_id}',['as'=>'getAllOrderedChapterOfStory','uses'=>'Admin\StoryEnglishController@getAllOrderedChapterOfStory']);

    //********** For Reading Others *************/
    Route::get('getStepSection',['as'=>'getStepSection','uses'=>'Admin\TypeQuestionController@getStepSection']);
    Route::get('getAllOrdered/{type_lesson_id}-{type_question_id}',['as'=>'getAllOrdered','uses'=>'Admin\ReadingLessonController@getAllOrdered']);
    Route::get('/', function () {
        return view('admin.welcome');
    });
});

/*********************************************************
 *
 *
 *                  ROUTE FOR CLIENT MODULE
 *
 *
 *
 *********************************************************/
Route::get('/', function () {
    return view('client.welcome');
});

Route::group(['domain'=>'{nameDomain}', 'middleware' => ['clientAuth']], function () {
    Route::get('getNotification',['as'=>'getMatchNotification','uses'=>'ReadingNotificationController@getNotification'])->middleware('auth');
    Route::get('readNotification/{id}',['as'=>'readNotification','uses'=>'ReadingNotificationController@readNotification']);
    Route::get('markAllNotificationAsRead',['as'=>'markAllNotificationAsRead','uses'=>'ReadingNotificationController@markAllNotificationAsRead']);

    //********** For Reading Solution *************
    Route::get('showComments/{question_id_custom}',['as'=>'showComments','uses'=>'Client\CommentQuestionController@getComments']);
    Route::get('reading',['as'=>'reading','uses'=>'Client\ReadingLessonController@getReading']);
    Route::get('showExplanation/{type_lesson_id}/{question_id_custom}',['as'=>'showExplanation','uses'=>'Client\ReadingResultController@getExplanation']);
    Route::post('enterNewComment/{type_lesson_id}',['as'=>'enterNewComment','uses'=>'Client\CommentQuestionController@createNewComment']);

    //For Reading English:
    Route::group(['prefix'=>'reading/{level_id}'],function () {
        Route::get('',['as'=>'readingOverview','uses'=>'Client\ReadingLessonController@overViewLevelLesson']);
        Route::get('readingOverviewDetail/{type_lesson_id}/{type_question_id}',['as'=>'readingOverviewDetail','uses'=>'Client\ReadingLessonController@readingOverviewDetail']);
        Route::get('readingLesson/{type_lesson_id}/{lesson_id}',['as'=>'readingLesson','uses'=>'Client\ReadingLessonController@readingLessonDetail'])->middleware('checkStepLesson');
        Route::get('getResultReadingLesson/{type_lesson_id}-{lesson_id}',['as'=>'getResultReadingLesson','uses'=>'Client\ReadingResultController@getResultReadingLesson'])->middleware('checkStepLesson');
        Route::get('readingViewResultLesson/{type_lesson_id}-{lesson_id}',['as'=>'readingViewResultLesson','uses'=>'Client\ReadingResultController@getReadingViewResultLesson'])->middleware('checkStepLesson');
        Route::get('readingViewSolutionLesson/{type_lesson_id}-{lesson_id}',['as'=>'readingViewSolutionLesson','uses'=>'Client\ReadingResultController@getReadingViewSolutionLesson'])->middleware('checkStepLesson');
        Route::get('readingViewLearning/{type_lesson_id}/{lesson_id}',['as'=>'readingViewLearning','uses'=>'Client\ReadingLessonController@getReadingViewLearning'])->middleware('checkStepLesson');
    });

    //For english Story:
    Route::get('vocabularyReading',['as'=>'vocabularyReading','uses'=>'Client\ReadingVocabularyController@getVocabularyReading']);

    Route::group(['prefix'=>'englishStory'],function () {
        Route::get('/',['as'=>'homeStory','uses'=>'Client\StoryEnglishController@getHomeStory']);
        Route::get('viewStoryDetail/{story_id}',['as'=>'viewStory','uses'=>'Client\StoryEnglishController@viewStoryDetail']);
    });

    //For profile user:
    Route::group(['prefix'=>'profile'],function () {
        Route::get('/{user_id}',['as'=>'profile','uses'=>'Client\UserController@viewProfile']);
        Route::post('updateAvatar/{user_id}',['as'=>'updateAvatar','uses'=>'Client\UserController@updateAvatar']);
        Route::post('userChangePassword/{user_id}',['as'=>'userChangePassword','uses'=>'Client\UserController@userChangePassword']);
    });
});
