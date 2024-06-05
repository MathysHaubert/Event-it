<?php

declare(strict_types=1);

namespace App\Controller\FAQ;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Entity\Forum\Forum;
use App\Entity\Forum\ForumMessage\ForumMessage;
use App\Entity\Faq\Faq;
use App\Entity\Api\Api;

class FaqController extends Controller{
    public function index($data = []): void
    {
        $faq = (new Faq)->getAllFaq();
        // define the default locale at french
        $this->webRender('public/faqPage/' . self::INDEX, [
            'title' => 'Home Page',
            'content' => 'Welcome to the home page',
            'cookieSet' => CookieHandler::isCookieSet(),
            'faqs' => $faq,
        ]);
    }

    public function manageAction($data = []): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $index = 0;
            $datas = [];
            /** @var array<Faq> $faqs */
            $faqs = (new Faq)->getAllFaq();
            foreach ($faqs as $faq) {
                (new Api())->delete($_ENV['API_URL'].'/faq',array("question" => $faq->getQuestion(),"answer"=>$faq->getAnswer()));
            }
            while(true) {
                if (count($_POST) > 0) {
                    if (isset($_POST['question_'.$index])) {
                        if ($_POST['question_'.$index] !== "" || $_POST['answer_'.$index] !== "") {
                            $datas[] = array("question" => $_POST['question_'.$index],"answer" => $_POST['answer_'.$index]);
                        }
                        unset($_POST['question_'.$index]);
                        unset($_POST['answer_'.$index]);
                    }
                    $index++;
                    continue;
                } else {
                    break;
                }
            }
            foreach($datas as $data) {
                $this->post($_ENV['API_URL'].'/faq',$data);
            }
        }
        $faq = (new Faq)->getAllFaq();
        // define the default locale at french
        $this->webRender('public/faqPage/' . self::MANAGE, [
            'title' => 'Home Page',
            'content' => 'Welcome to the home page',
            'cookieSet' => CookieHandler::isCookieSet(),
            'faqs' => $faq,
        ]);
    }
    private function linkForumToMessage($forums,$forumMessages)
    {
        $result = [];
        /** @var Forum $forum */
        foreach ($forums as $forum) {
            if (!array_key_exists($forum->getId(),$result)) {
                $result[$forum->getId()] = [];
            }
            /** @var ForumMessage $forumMessage */
            foreach ($forumMessages as $forumMessage) {
                if ($forum->getId() === $forumMessage->getForum()) {
                    $result[$forum->getId()][] = $forumMessage;
                }
            }
        }
        return $result;
    }
}
