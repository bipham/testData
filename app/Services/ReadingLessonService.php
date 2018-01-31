<?php namespace App\Services;

use App\Models\ReadingLearningTypeQuestion;
use App\Models\ReadingPracticeLesson;
use App\Models\ReadingMiniTestLesson;
use App\Models\ReadingMixTestLesson;
use App\Models\ReadingFullTestLesson;
use App\Models\ReadingResultLesson;
use App\Models\ReadingParagraphOfFullTest;
use Illuminate\Support\Facades\Auth;
use App\Models\ReadingTypeQuestion;
use App\Models\ReadingTotalLesson;

class ReadingLessonService {
    private $_readingLearningTypeQuestionModel;
    private $_readingPracticeLessonModel;
    private $_readingMiniTestLessonModel;
    private $_readingMixTestLessonModel;
    private $_readingFullTestLessonModel;
    private $_readingParagraphOfFullTestModel;
    private $_readingResultLessonModel;
    private $_readingTypeQuestionModel;
    private $_readingTotalLessonModel;
    private $_adminId;
    private $_levelUser;

    public function __construct()
    {
        $this->_readingLearningTypeQuestionModel = new ReadingLearningTypeQuestion();
        $this->_readingPracticeLessonModel = new ReadingPracticeLesson();
        $this->_readingMiniTestLessonModel = new ReadingMiniTestLesson();
        $this->_readingMixTestLessonModel = new ReadingMixTestLesson();
        $this->_readingFullTestLessonModel = new ReadingFullTestLesson();
        $this->_readingParagraphOfFullTestModel = new ReadingParagraphOfFullTest();
        $this->_readingResultLessonModel = new ReadingResultLesson();
        $this->_readingTypeQuestionModel = new ReadingTypeQuestion();
        $this->_readingTotalLessonModel = new ReadingTotalLesson();
        $this->_adminId = Auth::id();
        $this->_levelUser = Auth::user()->level_user_id;
    }

    public function getTotalLessonByLevelLesson($level_lesson_id) {
        return $this->_readingTotalLessonModel->getTotalLessonByLevelLesson($level_lesson_id);
    }

    public function updateTotalLessons($all_level_lessons) {
        $learning = config('constants.type_lesson.learning');
        $practice = config('constants.type_lesson.practice');
        $mini_test = config('constants.type_lesson.mini_test');
        $mix_test = config('constants.type_lesson.mix_test');
        $full_test = config('constants.type_lesson.full_test');
        foreach ($all_level_lessons as $level_lesson) {
            $all_type_questions = $this->_readingTypeQuestionModel->getAllTypeQuestionById($level_lesson->id);
            foreach ($all_type_questions as $type_question) {
                $total_lessons['learning'] = $this->getTotalLessonsByTypeQuestionId($learning, $type_question->id);
                $this->_readingTotalLessonModel->updateNewTotalLessons($level_lesson->id, $learning, $type_question->id, $total_lessons['learning']);

                $total_lessons['practice'] = $this->getTotalLessonsByTypeQuestionId($practice, $type_question->id);
                $this->_readingTotalLessonModel->updateNewTotalLessons($level_lesson->id, $practice, $type_question->id, $total_lessons['practice']);

                $total_lessons['mini_test'] = $this->getTotalLessonsByTypeQuestionId($mini_test, $type_question->id);
                $this->_readingTotalLessonModel->updateNewTotalLessons($level_lesson->id, $mini_test, $type_question->id, $total_lessons['mini_test']);
            }
            $total_lessons['introductions'] = $this->getTotalLessonsByTypeQuestionId($learning, -$level_lesson->id);
            $this->_readingTotalLessonModel->updateNewTotalLessons($level_lesson->id, $learning, -$level_lesson->id, $total_lessons['introductions']);

            $total_lessons['mix_test'] = $this->getTotalTestByLevelLesson($level_lesson->id, $mix_test);
            $this->_readingTotalLessonModel->updateNewTotalLessons($level_lesson->id, $mix_test, 0, $total_lessons['mix_test']);

            $total_lessons['full_test'] = $this->getTotalTestByLevelLesson($level_lesson->id, $full_test);
            $this->_readingTotalLessonModel->updateNewTotalLessons($level_lesson->id, $full_test, 0, $total_lessons['full_test']);
        }
        return 'update-totals-success';
    }

    //Update totals when new lesson inserted
    public function newUpdateTotalTypeLesson($level_lesson_id, $type_lesson_id, $type_question_id) {
        return $this->_readingTotalLessonModel->updateNewTotalTypeLessonsInserted($level_lesson_id, $type_lesson_id, $type_question_id);
    }

    public function getTheLastLessonId($type_lesson_id) {
        switch ($type_lesson_id) {
            case 1:
                $last_lesson = $this->_readingPracticeLessonModel->getTheLastLessonId();
                break;
            case 2:
                $last_lesson = $this->_readingMiniTestLessonModel->getTheLastLessonId();
                break;
            case 3:
                $last_lesson = $this->_readingMixTestLessonModel->getTheLastLessonId();
                break;
            case 4:
                $last_lesson = $this->_readingFullTestLessonModel->getTheLastLessonId();
                break;
        }
        if (!$last_lesson) {
            $last_lesson_id = 1;
        }
        else {
            $last_lesson_id = $last_lesson->id + 1;
        }
        return $last_lesson_id;
    }

    public function addNewReadingLesson($level_lesson_id, $full_test_id, $order_paragraph, $type_lesson_id, $title, $level_user_id, $content_lesson, $content_highlight, $image_feature, $content_quiz, $content_answer_quiz, $total_questions, $order_lesson, $type_question_id, $limit_time) {
        switch ($type_lesson_id) {
            case 1:
                $result = $this->_readingPracticeLessonModel->addNewPracticeLesson($title, $level_user_id, $content_lesson, $content_highlight, $image_feature, $content_quiz, $content_answer_quiz, $total_questions, $order_lesson, $type_question_id, $this->_adminId);
                break;
            case 2:
                $result = $this->_readingMiniTestLessonModel->addNewMiniTest($title, $level_user_id, $content_lesson, $content_highlight, $image_feature, $content_quiz, $content_answer_quiz, $total_questions, $order_lesson, $type_question_id, $limit_time, $this->_adminId);
                break;
            case 3:
                $result = $this->_readingMixTestLessonModel->addNewMixTest($level_lesson_id, $title, $level_user_id, $content_lesson, $content_highlight, $image_feature, $content_quiz, $content_answer_quiz, $total_questions, $order_lesson, $limit_time, $this->_adminId);
                break;
            case 4:
                $number_paragraphs = $this->_readingFullTestLessonModel->getNumberParagraphOfFullTest($full_test_id);
                $number_paragraphs = $number_paragraphs['number_paragraphs'] + 1;
                $this->_readingFullTestLessonModel->updateNumberParagraphsOfFullTest($full_test_id, $number_paragraphs);
                $this->_readingParagraphOfFullTestModel->createNewParagraph($full_test_id, $content_lesson, $content_highlight, $content_quiz, $content_answer_quiz, $order_paragraph, $this->_adminId);
                $result = $full_test_id;
                break;
        }
        return $result;
    }

    public function getAllLesson($type_lesson_id) {
        switch ($type_lesson_id) {
            case 1:
                $lesson= $this->_readingPracticeLessonModel->getAllPracticeLesson();
                break;
            case 2:
                $lesson['mini_test'] = $this->_readingMiniTestLessonModel->getAllMiniTest();
                break;
            case 3:
                $lesson['mix_test'] = $this->_readingMixTestLessonModel->getAllMixTest();
                break;
            case 4:
                break;
        }
        return $lesson;
    }

    public function getAllOrderLesson($type_lesson_id, $type_question_id) {
        switch ($type_lesson_id) {
            case 1:
                $result = $this->_readingPracticeLessonModel->getAllOrderPracticeLessonByTypeQuestionId($type_question_id);
                break;
            case 2:
                $result = $this->_readingMiniTestLessonModel->getAllOrderMiniTestByTypeQuestionId($type_question_id);
                break;
            case 3:
                $result = $this->_readingMixTestLessonModel->getAllOrderMixTestByLevelLessonId($type_question_id);
                break;
            case 4:
                $result = $this->_readingFullTestLessonModel->getAllOrderFullTestByLevelLessonId($type_question_id);
                break;
        }
        return $result;
    }

    public function updateTitleLesson($type_lesson_id, $lesson_id, $title) {
        switch ($type_lesson_id) {
            case 1:
                $result = $this->_readingPracticeLessonModel->updateTitlePracticeLesson($lesson_id, $title, $this->_adminId);
                break;
            case 2:
                $result = $this->_readingMiniTestLessonModel->updateTitleMiniTest($lesson_id, $title, $this->_adminId);
                break;
            case 3:
                $result = $this->_readingMixTestLessonModel->updateTitleMixTest($lesson_id, $title, $this->_adminId);
                break;
            case 4:
                $result = $this->_readingFullTestLessonModel->updateTitleFullTest($lesson_id, $title, $this->_adminId);
                break;
        }
        return $result;
    }

    public function updateLevelUserLesson($type_lesson_id, $lesson_id, $level_user_id) {
        switch ($type_lesson_id) {
            case 1:
                $result = $this->_readingPracticeLessonModel->updateLevelUserPracticeLesson($lesson_id, $level_user_id, $this->_adminId);
                break;
            case 2:
                $result = $this->_readingMiniTestLessonModel->updateLevelUserMiniTest($lesson_id, $level_user_id, $this->_adminId);
                break;
            case 3:
                $result = $this->_readingMixTestLessonModel->updateLevelUserMixTest($lesson_id, $level_user_id, $this->_adminId);
                break;
            case 4:
                $result = $this->_readingFullTestLessonModel->updateLevelUserFullTest($lesson_id, $level_user_id, $this->_adminId);
                break;
        }
        return $result;
    }

    public function updateLimitTimeLesson($type_lesson_id, $lesson_id, $limit_time) {
        switch ($type_lesson_id) {
            case 2:
                $result = $this->_readingMiniTestLessonModel->updateLimitTimeMiniTest($lesson_id, $limit_time, $this->_adminId);
                break;
            case 3:
                $result = $this->_readingMixTestLessonModel->updateLimitTimeMixTest($lesson_id, $limit_time, $this->_adminId);
                break;
            case 4:
                $result = $this->_readingFullTestLessonModel->updateLimitTimeFullTest($lesson_id, $limit_time, $this->_adminId);
                break;
        }
        return $result;
    }

    public function updateBasicInfoLesson($type_lesson_id, $lesson_id, $type_question_id, $order_lesson, $level_lesson_id) {
        switch ($type_lesson_id) {
            case 1:
                $result = $this->_readingPracticeLessonModel->updateBasicInfoPracticeLesson($lesson_id, $type_question_id, $order_lesson, $this->_adminId);
                break;
            case 2:
                $result = $this->_readingMiniTestLessonModel->updateBasicInfoMiniTest($lesson_id, $type_question_id, $order_lesson, $this->_adminId);
                break;
            case 3:
                $result = $this->_readingMixTestLessonModel->updateBasicInfoMixTest($lesson_id, $level_lesson_id, $order_lesson, $this->_adminId);
                break;
            case 4:
                $result = $this->_readingFullTestLessonModel->updateBasicInfoFullTest($lesson_id, $level_lesson_id, $order_lesson, $this->_adminId);
                break;
        }
        return $result;
    }

    public function checkChangeTypeQuestion($type_lesson_id, $lesson_id, $type_question_id) {
        switch ($type_lesson_id) {
            case 1:
                $type_question = $this->_readingPracticeLessonModel->getTypeQuestionOfPractice($lesson_id);
                $type_question_current_id = $type_question->type_question_id;
                break;
            case 2:
                $type_question = $this->_readingMiniTestLessonModel->getTypeQuestionOfMiniTest($lesson_id);
                $type_question_current_id = $type_question->type_question_id;
                break;
            case 3:
                $type_question_current_id = 0;
            case 4:
                $type_question_current_id = 0;
        }

        if ($type_question_current_id > 0 && (int)$type_question_id != $type_question_current_id) return true;
        else return false;
    }

    public function getLessonDetailForAdminById($type_lesson_id, $lesson_id) {
        switch ($type_lesson_id) {
            case 1:
                $result = $this->_readingPracticeLessonModel->getDetailPracticeLessonForAdminEdit($lesson_id);
                break;
            case 2:
                $result = $this->_readingMiniTestLessonModel->getDetailMiniTestForAdminEdit($lesson_id);
                break;
            case 3:
                $result = $this->_readingMixTestLessonModel->getDetailMixTestForAdminEdit($lesson_id);
                break;
            case 4:
                $result = $this->_readingFullTestLessonModel->getDetailFullTestForAdminEdit($lesson_id);
                break;
        }
        return $result;
    }

    public function getLessonDetailForClientTestById($type_lesson_id, $lesson_id) {
        switch ($type_lesson_id) {
            case 1:
                $result = $this->_readingPracticeLessonModel->getDetailPracticeLessonForClientTest($lesson_id);
                break;
            case 2:
                $result = $this->_readingMiniTestLessonModel->getDetailMiniTestForClientTest($lesson_id);
                break;
            case 3:
                $result = $this->_readingMixTestLessonModel->getDetailMixTestForClientTest($lesson_id);
                break;
            case 4:
                $result['lesson_detail'] = $this->_readingFullTestLessonModel->getDetailFullTestForClient($lesson_id);
                $result['paragraph_detail'] = $this->_readingParagraphOfFullTestModel->getDetailParagraphForClientTest($lesson_id);
                break;
        }
        return $result;
    }

    public function getLessonDetailForClientSolutionById($type_lesson_id, $lesson_id) {
        switch ($type_lesson_id) {
            case 0:
                $result = $this->_readingLearningTypeQuestionModel->getDetailLearningForClientSolution($lesson_id);
                break;
            case 1:
                $result = $this->_readingPracticeLessonModel->getDetailPracticeLessonForClientSolution($lesson_id);
                break;
            case 2:
                $result = $this->_readingMiniTestLessonModel->getDetailMiniTestForClientSolution($lesson_id);
                break;
            case 3:
                $result = $this->_readingMixTestLessonModel->getDetailMixTestForClientSolution($lesson_id);
                break;
            case 4:
                $result['lesson_detail'] = $this->_readingFullTestLessonModel->getDetailFullTestForClient($lesson_id);
                $result['paragraph_detail'] = $this->_readingParagraphOfFullTestModel->getDetailParagraphForClientSolution($lesson_id);
                break;
        }
        return $result;
    }

    public function getLessonDetailForClientMiddleware($type_lesson_id, $lesson_id) {
        switch ($type_lesson_id) {
            case 0:
                $result = $this->_readingLearningTypeQuestionModel->getDetailLearningForClientMiddleware($lesson_id);
                break;
            case 1:
                $result = $this->_readingPracticeLessonModel->getDetailPracticeLessonForClientMiddleware($lesson_id);
                break;
            case 2:
                $result = $this->_readingMiniTestLessonModel->getDetailMiniTestForClientMiddleware($lesson_id);
                break;
            case 3:
                $result = $this->_readingMixTestLessonModel->getDetailMixTestForClientMiddleware($lesson_id);
                break;
            case 4:
                $result = $this->_readingFullTestLessonModel->getDetailFullTestForMiddleware($lesson_id);
                break;
        }
        return $result;
    }

    public function updateContentLesson($type_lesson_id, $lesson_id, $content_lesson, $content_highlight) {
        switch ($type_lesson_id) {
            case 1:
                $result = $this->_readingPracticeLessonModel->updateContentPracticeLesson($lesson_id, $content_lesson, $content_highlight, $this->_adminId);
                break;
            case 2:
                $result = $this->_readingMiniTestLessonModel->updateContentMiniTest($lesson_id, $content_lesson, $content_highlight, $this->_adminId);
                break;
            case 3:
                $result = $this->_readingMixTestLessonModel->updateContentMixTest($lesson_id, $content_lesson, $content_highlight, $this->_adminId);
                break;
            case 4:
                $result = $this->_readingFullTestLessonModel->getTheLastLessonId();
                break;
        }
        return $result;
    }

    public function updateQuizLesson($type_lesson_id, $lesson_id, $content_highlight, $content_quiz, $content_answer_quiz, $total_questions) {
        switch ($type_lesson_id) {
            case 1:
                $result = $this->_readingPracticeLessonModel->updateQuizPracticeLesson($lesson_id, $content_highlight, $content_quiz, $content_answer_quiz, $total_questions, $this->_adminId);
                break;
            case 2:
                $result = $this->_readingMiniTestLessonModel->updateQuizMiniTest($lesson_id, $content_highlight, $content_quiz, $content_answer_quiz, $total_questions, $this->_adminId);
                break;
            case 3:
                $result = $this->_readingMixTestLessonModel->updateQuizMixTest($lesson_id, $content_highlight, $content_quiz, $content_answer_quiz, $total_questions, $this->_adminId);
                break;
            case 4:
                $result = $this->_readingFullTestLessonModel->getTheLastLessonId();
                break;
        }
        return $result;
    }

    public function getLessonsByTypeQuestionId($type_lesson_id, $type_question_id) {
        switch ($type_lesson_id) {
            case 1:
                $result = $this->_readingPracticeLessonModel->getPracticesByTypeQuestionId($type_question_id);
                break;
            case 2:
                $result = $this->_readingMiniTestLessonModel->getMiniTestByTypeQuestionId($type_question_id);
                break;
        }
        return $result;
    }

    public function getTotalLessonsByTypeQuestionId($type_lesson_id, $type_question_id) {
        switch ($type_lesson_id) {
            case 0:
                $result = $this->_readingLearningTypeQuestionModel->getTotalLearningByTypeQuestionId($type_question_id);
                break;
            case 1:
                $result = $this->_readingPracticeLessonModel->getTotalPracticesByTypeQuestionId($type_question_id);
                break;
            case 2:
                $result = $this->_readingMiniTestLessonModel->getTotalMiniTestByTypeQuestionId($type_question_id);
                break;
        }
        return $result;
    }

    public function getTotalTestByLevelLesson($level_lesson_id, $type_lesson_id) {
        switch ($type_lesson_id) {
            case 3:
                $result = $this->_readingMixTestLessonModel->getTotalMixTestByLevelLesson($level_lesson_id);
                break;
            case 4:
                $result = $this->_readingFullTestLessonModel->getTotalFullTestByLevelLesson($level_lesson_id);
                break;
        }
        return $result;
    }

    public function deleteLesson($type_lesson_id, $lesson_id) {
        switch ($type_lesson_id) {
            case 1:
                $result = $this->_readingPracticeLessonModel->deletePracticeLesson($lesson_id);
                break;
            case 2:
                $result = $this->_readingMiniTestLessonModel->deleteMiniTest($lesson_id);
                break;
            case 3:
                $result = $this->_readingMixTestLessonModel->deleteMixTest($lesson_id);
                break;
            case 4:
                $result = $this->_readingFullTestLessonModel->deleteFullTest($lesson_id);
                break;
        }
        return $result;
    }

    public function getTotalQuestionByLessonId($type_lesson_id, $lesson_id) {
        switch ($type_lesson_id) {
            case 0:
                $result = $this->_readingLearningTypeQuestionModel->getTotalQuestionOfLearning($lesson_id);
                break;
            case 1:
                $result = $this->_readingPracticeLessonModel->getTotalQuestionOfPracticeLesson($lesson_id);
                break;
            case 2:
                $result = $this->_readingMiniTestLessonModel->getTotalQuestionOfMiniTestLesson($lesson_id);
                break;
            case 3:
                $result = $this->_readingMixTestLessonModel->getTotalQuestionOfMixTestLesson($lesson_id);
                break;
            case 4:
                $result = $this->_readingFullTestLessonModel->getTotalQuestionOfFullTestLesson($lesson_id);
                break;
        }
        return $result['total_questions'];
    }

    public function getCurrentStepOfLesson($type_lesson_id, $lesson_id) {
        switch ($type_lesson_id) {
            case 0:
                $result = $this->_readingLearningTypeQuestionModel->getCurrentStepOfLearning($lesson_id);
                break;
            case 1:
                $result = $this->_readingPracticeLessonModel->getCurrentStepOfPracticeLesson($lesson_id);
                break;
            case 2:
                $result = $this->_readingMiniTestLessonModel->getCurrentStepOfMiniTest($lesson_id);
                break;
            case 3:
                $result = $this->_readingMixTestLessonModel->getCurrentStepOfMixTest($lesson_id);
                break;
            case 4:
                $result = $this->_readingFullTestLessonModel->getCurrentStepOfFullTest($lesson_id);
                break;
        }
        return $result['order_lesson'];
    }

    public function checkVipLesson($type_lesson_id, $lesson_id) {
        switch ($type_lesson_id) {
            case 0:
                $level_user_of_lesson = $this->_readingLearningTypeQuestionModel->checkVipLearning($lesson_id);
                break;
            case 1:
                $level_user_of_lesson = $this->_readingPracticeLessonModel->checkVipPracticeLesson($lesson_id);
                break;
            case 2:
                $level_user_of_lesson = $this->_readingMiniTestLessonModel->checkVipMiniTestLesson($lesson_id);
                break;
            case 3:
                $level_user_of_lesson = $this->_readingMixTestLessonModel->getTheLastLessonId();
                break;
            case 4:
                $level_user_of_lesson = $this->_readingFullTestLessonModel->getTheLastLessonId();
                break;
        }
        if ($this->_levelUser != 1 && $level_user_of_lesson['level_user_id'] > $this->_levelUser) {
            return true;
        }
        else return false;
    }

    public function getMinStepLesson($level_lesson_id, $type_question_id, $type_lesson_id) {
        switch ($type_lesson_id) {
            case 0:
                $min_step = $this->_readingLearningTypeQuestionModel->getMinStepOfLearning($type_question_id);
                break;
            case 1:
                $min_step = $this->_readingPracticeLessonModel->getMinStepPracticeLesson($type_question_id);
                break;
            case 2:
                $min_step = $this->_readingMiniTestLessonModel->getMinStepMiniLesson($type_question_id);
                break;
            case 3:
                $min_step = $this->_readingMixTestLessonModel->getMinStepMixTest($level_lesson_id);
                break;
            case 4:
                $min_step = $this->_readingFullTestLessonModel->getMinStepFullTest($level_lesson_id);
                break;
        }
        return $min_step->order_lesson;
    }

    public function getMaxStepLesson($level_lesson_id, $type_question_id, $type_lesson_id) {
        switch ($type_lesson_id) {
            case 0:
                $max_step = $this->_readingLearningTypeQuestionModel->getMaxStepOfLearning($type_question_id);
                break;
            case 1:
                $max_step = $this->_readingPracticeLessonModel->getMaxStepPracticeLesson($type_question_id);
                break;
            case 2:
                $max_step = $this->_readingMiniTestLessonModel->getMaxStepMiniLesson($type_question_id);
                break;
            case 3:
                $max_step = $this->_readingMixTestLessonModel->getMaxStepMixTest($level_lesson_id);
                break;
            case 4:
                $max_step = $this->_readingFullTestLessonModel->getMaxStepFullTest($level_lesson_id);
                break;
        }
        return $max_step->order_lesson;
    }

    public function getPreLessonId($level_lesson_id, $type_question_id, $type_lesson_id, $current_order_lesson) {
        switch ($type_lesson_id) {
            case 0:
                $pre_lesson = $this->_readingLearningTypeQuestionModel->getPreLearningId($type_question_id, $current_order_lesson);
                break;
            case 1:
                $pre_lesson = $this->_readingPracticeLessonModel->getPrePracticeLessonId($type_question_id, $current_order_lesson);
                break;
            case 2:
                $pre_lesson = $this->_readingMiniTestLessonModel->getPreMiniTestId($type_question_id, $current_order_lesson);
                break;
            case 3:
                $pre_lesson = $this->_readingMixTestLessonModel->getPreMixTestId($level_lesson_id, $current_order_lesson);
                break;
            case 4:
                $pre_lesson = $this->_readingFullTestLessonModel->getPreFullTestId($level_lesson_id, $current_order_lesson);
                break;
        }
        if ($pre_lesson == null) return null;
        else return $pre_lesson->id;
    }

    public function getNextLessonId($level_lesson_id, $type_question_id, $type_lesson_id, $current_order_lesson) {
        switch ($type_lesson_id) {
            case 0:
                $next_lesson = $this->_readingLearningTypeQuestionModel->getNextLearningId($type_question_id, $current_order_lesson);
                break;
            case 1:
                $next_lesson = $this->_readingPracticeLessonModel->getNextPracticeLessonId($type_question_id, $current_order_lesson);
                break;
            case 2:
                $next_lesson = $this->_readingMiniTestLessonModel->getNextMiniTestId($type_question_id, $current_order_lesson);
                break;
            case 3:
                $next_lesson = $this->_readingMixTestLessonModel->getNextMixTestId($level_lesson_id, $current_order_lesson);
                break;
            case 4:
                $next_lesson = $this->_readingFullTestLessonModel->getNextFullTestId($level_lesson_id, $current_order_lesson);
                break;
        }
        if ($next_lesson == null) return null;
        else return $next_lesson->id;
    }

    public function getResumeLesson($level_lesson_id) {
        $all_result_user = $this->_readingResultLessonModel->getAllResultOfUser($this->_adminId);
        foreach ($all_result_user as $result_user) {
            switch ($result_user->type_lesson_id) {
                case 0:
                    $lesson_resume = $this->_readingLearningTypeQuestionModel->getLessonResume($result_user->lesson_id);
                    $lesson_resume->type_lesson_id = $result_user->type_lesson_id;
                    $lesson_resume->highest_correct = $result_user->highest_correct;
                    if ($lesson_resume->type_question_id > 0) {
                        $level_lesson_resume = $lesson_resume->typeQuestion->level_lesson_id;
                    }
                    else {
                        $level_lesson_resume = - $lesson_resume->type_question_id;
                    }
                    break;
                case 1:
                    $lesson_resume = $this->_readingPracticeLessonModel->getLessonResume($result_user->lesson_id);
                    $lesson_resume->type_lesson_id = $result_user->type_lesson_id;
                    $lesson_resume->highest_correct = $result_user->highest_correct;
                    $level_lesson_resume = $lesson_resume->typeQuestion->level_lesson_id;
                    break;
                case 2:
                    $lesson_resume = $this->_readingMiniTestLessonModel->getLessonResume($result_user->lesson_id);
                    $lesson_resume->type_lesson_id = $result_user->type_lesson_id;
                    $lesson_resume->highest_correct = $result_user->highest_correct;
                    $level_lesson_resume = $lesson_resume->typeQuestion->level_lesson_id;
                    break;
                case 3:
                    $lesson_resume = $this->_readingMixTestLessonModel->getLessonResume($result_user->lesson_id);
                    $lesson_resume->type_lesson_id = $result_user->type_lesson_id;
                    $lesson_resume->highest_correct = $result_user->highest_correct;
                    $lesson_resume->type_question_id = 0;
                    $level_lesson_resume = $lesson_resume->level_lesson_id;
                    break;
                case 4:
                    $lesson_resume = $this->_readingFullTestLessonModel->getLessonResume($result_user->lesson_id);
                    $lesson_resume->type_lesson_id = $result_user->type_lesson_id;
                    $lesson_resume->highest_correct = $result_user->highest_correct;
                    $lesson_resume->type_question_id = 0;
                    $level_lesson_resume = $lesson_resume->level_lesson_id;
                    break;
            }
            if ($level_lesson_id == $level_lesson_resume) {
                return $this->getNextResumeLesson($lesson_resume, $level_lesson_id);
            }
        }
        return null;
    }

    public function getResumeLessonOverDetail($level_lesson_id, $type_lesson_id, $type_question_id) {
        $all_result_user = $this->_readingResultLessonModel->getAllResultOfUser($this->_adminId);
        foreach ($all_result_user as $result_user) {
            switch ($result_user->type_lesson_id) {
                case 0:
                    $lesson_resume = $this->_readingLearningTypeQuestionModel->getLessonResume($result_user->lesson_id);
                    $lesson_resume->type_lesson_id = $result_user->type_lesson_id;
                    $lesson_resume->highest_correct = $result_user->highest_correct;
                    if ($lesson_resume->type_question_id > 0) {
                        $level_lesson_resume = $lesson_resume->typeQuestion->level_lesson_id;
                    }
                    else {
                        $level_lesson_resume = - $lesson_resume->type_question_id;
                    }
                    break;
                case 1:
                    $lesson_resume = $this->_readingPracticeLessonModel->getLessonResume($result_user->lesson_id);
                    $lesson_resume->type_lesson_id = $result_user->type_lesson_id;
                    $lesson_resume->highest_correct = $result_user->highest_correct;
                    $level_lesson_resume = $lesson_resume->typeQuestion->level_lesson_id;
                    break;
                case 2:
                    $lesson_resume = $this->_readingMiniTestLessonModel->getLessonResume($result_user->lesson_id);
                    $lesson_resume->type_lesson_id = $result_user->type_lesson_id;
                    $lesson_resume->highest_correct = $result_user->highest_correct;
                    $level_lesson_resume = $lesson_resume->typeQuestion->level_lesson_id;
                    break;
                case 3:
                    $lesson_resume = $this->_readingMixTestLessonModel->getLessonResume($result_user->lesson_id);
                    $lesson_resume->type_lesson_id = $result_user->type_lesson_id;
                    $lesson_resume->highest_correct = $result_user->highest_correct;
                    $lesson_resume->type_question_id = 0;
                    $level_lesson_resume = $lesson_resume->level_lesson_id;
                    break;
                case 4:
                    $lesson_resume = $this->_readingFullTestLessonModel->getLessonResume($result_user->lesson_id);
                    $lesson_resume->type_lesson_id = $result_user->type_lesson_id;
                    $lesson_resume->highest_correct = $result_user->highest_correct;
                    $lesson_resume->type_question_id = 0;
                    $level_lesson_resume = $lesson_resume->level_lesson_id;
                    break;
            }
            if ($type_question_id == 0) {
                if ($level_lesson_id == $level_lesson_resume && $type_lesson_id == $lesson_resume->type_lesson_id) {
                    return $this->getNextResumeLesson($lesson_resume, $level_lesson_id);
                }
            }
            else {
                if ($level_lesson_id == $level_lesson_resume && $type_lesson_id == $lesson_resume->type_lesson_id && $type_question_id == $lesson_resume->type_question_id) {
                    return $this->getNextResumeLesson($lesson_resume, $level_lesson_id);
                }
            }
        }
        return null;
    }

    public function getNextResumeLesson($lesson_resume, $level_lesson_id) {
        if ($lesson_resume->highest_correct >= ($lesson_resume->total_questions/2)) {
            $next_lesson_id = $this->getNextLessonId($level_lesson_id, $lesson_resume->type_question_id, $lesson_resume->type_lesson_id, $lesson_resume->order_lesson);
            if ($next_lesson_id != null) $lesson_resume->lesson_resume_id = $next_lesson_id;
        }
        else $lesson_resume->lesson_resume_id = $lesson_resume->id;
        return $lesson_resume;
    }
}
?>