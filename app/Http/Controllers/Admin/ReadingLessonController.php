<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ReadingLessonService;
use App\Services\ReadingLevelLessonService;
use App\Services\ReadingLevelUserService;
use App\Services\ReadingQuestionLessonService;
use App\Services\ReadingTypeQuestionService;
use App\Services\ReadingImageService;
use App\Services\ReadingTypeQuestionDetailOfLessonService;
use App\Models\ReadingPracticeLesson;

class ReadingLessonController extends Controller
{
    //updateTotalLessons
    public function updateTotalLessons($domain) {
        $readingLessonService = new ReadingLessonService();
        $readingLevelLessonService = new ReadingLevelLessonService();
        $all_level_lessons = $readingLevelLessonService->getAllLevelLesson();
        $result = $readingLessonService->updateTotalLessons($all_level_lessons);
        return $result;
    }

//    Create new lesson:
    public function getCreateNewReadingLesson($domain, $type_lesson_id) {
        $readingLevelLessonService = new ReadingLevelLessonService();
        $all_level_lessons = $readingLevelLessonService->getAllLevelLesson();
        $first_level_lesson_id = $readingLevelLessonService->getFirstLevelLesson();
        $readingTypeQuestionService = new ReadingTypeQuestionService();
        $all_type_questions = $readingTypeQuestionService->getAllTypeQuestionById($first_level_lesson_id->id);
        $readingQuestionLessonServicee = new ReadingQuestionLessonService();
        $last_question_custom_id = $readingQuestionLessonServicee->getTheLastQuestionCustomId();
        $readingLevelUserService = new ReadingLevelUserService();
        $readingLessonService = new ReadingLessonService();
        $all_level_users = $readingLevelUserService->getAllLevelUser();
        $type_lesson_id = getIdFromLink($type_lesson_id);
        switch ($type_lesson_id) {
            case 1:
                return view('admin.readingUploadNewPractice', compact('type_lesson_id', 'last_question_custom_id', 'all_type_questions', 'all_level_lessons', 'all_level_users'));
                break;
            case 2:
                return view('admin.readingUploadNewPractice', compact('type_lesson_id', 'last_question_custom_id', 'all_type_questions', 'all_level_lessons', 'all_level_users'));
                break;
            case 3:
                return view('admin.readingUploadNewMixTest', compact('type_lesson_id', 'last_question_custom_id', 'all_level_lessons', 'all_level_users'));
                break;
            case 4:
                $last_lesson_id = $readingLessonService->getTheLastLessonId($type_lesson_id);
                return view('admin.readingUploadNewFullTest', compact('last_lesson_id', 'type_lesson_id', 'last_question_custom_id', 'all_level_lessons', 'all_level_users'));
                break;
        }
    }

    /**
     * @param ClientUpRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateNewReadingLesson(Request $request, $domain, $type_lesson_id)
    {
        //Get variable:
        $type_lesson_id = getIdFromLink($type_lesson_id);
        $img_url = $_POST['img_url'];
        $img_name_no_ext = $_POST['img_name_no_ext'];
        $img_extension = $_POST['img_extension'];
        $content_lesson = $_POST['content_post'];
        $content_highlight = $_POST['content_highlight'];
        $content_quiz = $_POST['content_quiz'];
        $content_answer_quiz = $_POST['content_answer_quiz'];
        $list_answer = $_POST['list_answer'];
        $title = $_POST['title_post'];
        $type_question_id = $_POST['type_question_id'];
        $level_user_id = $_POST['level_user_id'];
        $lesson_id_create = $_POST['lesson_id'];
        $order_paragraph = $_POST['order_paragraph'];
        $level_lesson_id = $_POST['level_lesson_id'];
        $order_lesson = $_POST['order_lesson'];
        $listKeyword = $_POST['listKeyword'];
        $list_type_questions = $_POST['list_type_questions'];
        $limit_time = $_POST['limit_time'];
        $total_questions = sizeof($list_answer);
        $readingLessonService = new ReadingLessonService();
        $readingQuestionLessonService = new ReadingQuestionLessonService();
        $current_lesson_id = $readingLessonService->getTheLastLessonId($type_lesson_id);
        //Function save img:
        if ($img_name_no_ext != '') {
            $readingImageService = new ReadingImageService();
            $image_feature = $readingImageService->saveImageToLocal($type_lesson_id, $img_name_no_ext, $img_url, $img_extension, $current_lesson_id);
        }

        //Save Lesson to DB:
        $lesson_id = $readingLessonService->addNewReadingLesson($level_lesson_id, $lesson_id_create, $order_paragraph, $type_lesson_id, $title, $level_user_id, $content_lesson, $content_highlight, $image_feature = null, $content_quiz, $content_answer_quiz, $total_questions, $order_lesson, $type_question_id, $limit_time);

        //Save questions - answers:
        if ($lesson_id != 'fail-order') {
            //Save type question:
            if ($type_lesson_id > 2) {
                foreach ($list_answer as $question_custom_id => $answer) {
                    $readingQuestionLessonService->addNewQuestionLesson($type_lesson_id, $lesson_id, $list_type_questions[$question_custom_id], $question_custom_id, $answer, $listKeyword[$question_custom_id]);
                }

                foreach ($list_type_questions as $type_question_detail_id) {
                    $readingTypeQuestionDetailOfLessonService = new ReadingTypeQuestionDetailOfLessonService();
                    $readingTypeQuestionDetailOfLessonService->createNewTypeQuestionDetail($lesson_id, $type_lesson_id, $type_question_detail_id);
                }
                $readingLessonService->newUpdateTotalTypeLesson($level_lesson_id, $type_lesson_id, 0);
            }
            else {
                foreach ($list_answer as $question_custom_id => $answer) {
                    $readingQuestionLessonService->addNewQuestionLesson($type_lesson_id, $lesson_id, $type_question_id, $question_custom_id, $answer, $listKeyword[$question_custom_id]);
                }
                $readingLessonService->newUpdateTotalTypeLesson($level_lesson_id, $type_lesson_id, $type_question_id);
            }

            $result = 'success';
        }
        else $result = 'fail-order';

        return json_encode(['result' => $result]);
    }
//    /* ------------------------------------------------------------------- */

    public function managerReadingLesson($domain) {

        return view('admin.readingManagerLessons');
    }

    public function managerReadingLessonJSON(Request $request) {
        $readingLevelLessonService = new ReadingLevelLessonService();
        $readingPracticeLesson = new ReadingPracticeLesson();
        $all_level_lessons = $readingLevelLessonService->getAllLevelLesson();
        $readingLessonService = new ReadingLessonService();
        $lessons = $readingLessonService->getAllLesson(1);
        $readingLevelUserService = new ReadingLevelUserService();
        $all_level_users = $readingLevelUserService->getAllLevelUser();

        $draw = $request->get('draw');
        if ($request->get('draw')) {
            $draw = $request->get('draw');
        }
        else $draw = 1;

        if ($request->get('start')) {
            $start = $request->get('start');
        }

        else $start = 0;
        if ($request->get('length') !== null) {
            $length = $request->get('length');
        }
        else $length = 10;

        $columns = array(
            0 =>'id',
            1 =>'title',
            2=> 'level_user_id',
            3=> 'image_feature',
            4=> 'order_lesson',
        );
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');


//        echo '<pre>'. printf($search) . '</pre>';

        $total_members = ReadingPracticeLesson::all()->count(); // get your total no of data;
        $members = $readingPracticeLesson->getPracticeLesson($start, $length); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'search' => $search,
            'order' => $order,
            'dir' => $dir,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);
    }

    public function updateTitleLesson($domain, $type_lesson_id, $lesson_id) {
        //Get variable:
        $title_lesson = $_POST['title_lesson'];
        $readingLessonService = new ReadingLessonService();
        $result = $readingLessonService->updateTitleLesson($type_lesson_id, $lesson_id, $title_lesson);
        return json_encode(['result' => $result]);
    }

    public function updateLevelUserLesson($domain, $type_lesson_id, $lesson_id) {
        //Get variable:
        $level_user_id = $_POST['level_user_id'];
        $readingLessonService = new ReadingLessonService();
        $result = $readingLessonService->updateLevelUserLesson($type_lesson_id, $lesson_id, $level_user_id);
        return json_encode(['result' => $result]);
    }

    public function updateLimitTimeLesson($domain, $type_lesson_id, $lesson_id) {
        //Get variable:
        $limit_time = $_GET['limit_time'];
        $readingLessonService = new ReadingLessonService();
        $result = $readingLessonService->updateLimitTimeLesson($type_lesson_id, $lesson_id, $limit_time);
        return json_encode(['result' => $result]);
    }

    public function updateBasicInfoLesson($domain, $type_lesson_id, $lesson_id) {
        //Get variable:
        $type_question_id = $_POST['type_question_id'];
        $order_lesson = $_POST['order_lesson'];
        $level_lesson_id = $_POST['level_lesson_selected'];
        $readingLessonService = new ReadingLessonService();
        $isChangeTypeQuestion = $readingLessonService->checkChangeTypeQuestion($type_lesson_id, $lesson_id, $type_question_id);
        if ($isChangeTypeQuestion) {
            $readingQuestionLessonService = new ReadingQuestionLessonService();
            $readingQuestionLessonService->updateQuestionType($type_lesson_id, $lesson_id, $type_question_id);
        }
        $result = $readingLessonService->updateBasicInfoLesson($type_lesson_id, $lesson_id, $type_question_id, $order_lesson, $level_lesson_id);
        return json_encode(['result' => $result, 'isChangeTypeQuestion' => $isChangeTypeQuestion]);
    }

    public function updateContentLessonReading($domain, $type_lesson_id, $lesson_id) {
        $content_highlight = $_POST['content_highlight_lesson'];
        $content_lesson = $_POST['content_lesson_source'];
        $readingLessonService = new ReadingLessonService();
        $result = $readingLessonService->updateContentLesson($type_lesson_id, $lesson_id, $content_lesson, $content_highlight);
        return json_encode(['result' => $result]);
    }

    public function updateQuizReading($domain, $type_lesson_id, $lesson_id) {
        $content_highlight = $_POST['content_highlight'];
        $content_quiz = $_POST['content_quiz'];
        $content_answer_quiz = $_POST['content_answer_quiz'];
        $list_answer = $_POST['list_answer'];
        $type_question_id = $_POST['type_question_id'];
        $list_type_questions = $_POST['list_type_questions'];
        $list_Q_old = $_POST['list_Q_old'];
        $listKeyword = $_POST['listKeyword'];
        $total_questions = sizeof($list_answer);

        //Save quiz - answers:
        $readingLessonService = new ReadingLessonService();
        $readingLessonService->updateQuizLesson($type_lesson_id, $lesson_id, $content_highlight, $content_quiz, $content_answer_quiz, $total_questions);

        //Delete old-question:
        $readingQuestionLessonService = new ReadingQuestionLessonService();
        for ($i=0; $i < sizeof($list_Q_old); $i++) {
            $readingQuestionLessonService->deleteQuestionLesson($type_lesson_id, $lesson_id, $list_Q_old[$i]);
        }

        //Save questions - answers:
        if ($type_lesson_id > 2) {
            foreach ($list_answer as $question_custom_id => $answer) {
                $readingQuestionLessonService->addNewQuestionLesson($type_lesson_id, $lesson_id, $list_type_questions[$question_custom_id], $question_custom_id, $answer, $listKeyword[$question_custom_id]);
            }

            foreach ($list_type_questions as $type_question_detail_id) {
                $readingTypeQuestionDetailOfLessonService = new ReadingTypeQuestionDetailOfLessonService();
                $readingTypeQuestionDetailOfLessonService->createNewTypeQuestionDetail($lesson_id, $type_lesson_id, $type_question_detail_id);
            }
        }
        else {
            //Save new question:
            foreach ($list_answer as $question_custom_id => $answer) {
                $readingQuestionLessonService->addNewQuestionLesson($type_lesson_id, $lesson_id, $type_question_id, $question_custom_id, $answer, $listKeyword[$question_custom_id]);
            }
        }

        return json_encode(['result' => 'success']);
    }

    public function getAllOrdered($domain, $type_lesson_id, $type_question_id) {
        $readingLessonService = new ReadingLessonService();
        $all_orders = $readingLessonService->getAllOrderLesson($type_lesson_id, $type_question_id);
        $miss_orders = getMissOrder($all_orders);
        return json_encode(['all_orders' => $all_orders, 'miss_orders' => $miss_orders]);
    }

    public function deleteLessonReading($domain, $type_lesson_id, $lesson_id) {
        $readingLessonService = new ReadingLessonService();
        $result = $readingLessonService->deleteLesson($type_lesson_id, $lesson_id);
        return json_encode(['result' => 'success']);
    }

    public function onChangeLevelLessonIdAdmin($domain) {
        $level_lesson_id = $_GET['level_lesson_id'];
        $type_lesson_id = $_GET['type_lesson_current'];
        $readingTypeQuestionService = new ReadingTypeQuestionService();
        $all_type_questions = $readingTypeQuestionService->getAllTypeQuestionById($level_lesson_id);
        $readingLessonService = new ReadingLessonService();
        switch ($type_lesson_id) {
            case 1:
                $all_orders = $readingLessonService->getAllOrderLesson($type_lesson_id, $all_type_questions[0]->id);
                break;
            case 2:
                $all_orders = $readingLessonService->getAllOrderLesson($type_lesson_id, $all_type_questions[0]->id);
                break;
            case 3:
                $all_orders = $readingLessonService->getAllOrderLesson($type_lesson_id, $level_lesson_id);
                break;
            case 4:
                $all_orders = $readingLessonService->getAllOrderLesson($type_lesson_id, $level_lesson_id);
                break;
        }
        $miss_orders = getMissOrder($all_orders);
        return json_encode(['list_type_questions' => $all_type_questions, 'all_orders' => $all_orders, 'miss_orders' => $miss_orders]);
    }

    public function getEditLessonReading($domain, $type_lesson_id, $lesson_id) {
        $readingQuestionLessonService = new ReadingQuestionLessonService();
        $last_question_custom_id = $readingQuestionLessonService->getTheLastQuestionCustomId();
        $readingLessonService = new ReadingLessonService();
        $lesson = $readingLessonService->getLessonDetailForAdminById($type_lesson_id, $lesson_id);
        switch ($type_lesson_id) {
            case 1:
                $level_lesson_id = $lesson->typeQuestion->levelLesson->id;
                break;
            case 2:
                $level_lesson_id = $lesson->typeQuestion->levelLesson->id;
                break;
            case 3:
                $level_lesson_id = $lesson->level_lesson_id;
                break;
            case 4:
                $level_lesson_id = $lesson->level_lesson_id;
                break;
        }
        return view('admin.readingEditLesson',compact('last_question_custom_id', 'type_lesson_id', 'lesson', 'level_lesson_id'));
    }
}
