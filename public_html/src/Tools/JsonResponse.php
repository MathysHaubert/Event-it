<?php

declare(strict_types=1);

namespace App\Tools;

class JsonResponse
{
    private $data;

    private $status;

    public function __construct($data, $status = 200)
    {
        $this->data = $data;
        $this->status = $status;
    }
    public function send(): self
    {
    ob_start();
    ob_clean();

    header_remove(); 
    header('Content-Type: application/json');
    
    http_response_code($this->status);
    echo(json_encode($this->data));
    exit();
    return $this;
    }
    
    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}