<?php

namespace App\Entity\Faq;

use App\Trait\ApiTrait;

class Faq
{
    use ApiTrait;

    private string $answer;

    private string $question;



    /**
     * Get the value of question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set the value of question
     *
     * @return  self
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    public static function createFromArray(array $params)
    {
        $resource = new self();
        $resource->setAnswer($params['answer']);
        $resource->setQuestion($params['question']);
        return $resource;
    }

    public function getAllFaq()
    {
        $faqs = $this->get($_ENV['API_URL'].'/faq');
        $result = [];
        foreach ($faqs as $faq) {
            $result[] = self::createFromArray($faq);
        }
        return $result;
    }

    /**
     * Get the value of answer
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set the value of answer
     *
     * @return  self
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }
}
