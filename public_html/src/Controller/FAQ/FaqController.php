<?php

declare(strict_types=1);

namespace App\Controller\FAQ;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Entity\Forum\Forum;
use App\Entity\Forum\ForumMessage\ForumMessage;
use App\Entity\Faq\Faq;

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
            $index = 1;
            $datas = [];
            while(true) {
                if (isset($_POST['question_'.$index])) {
                    $datas[] = array("question" => $_POST['question_'.$index],"answer" => $_POST['answer_'.$index]);
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
