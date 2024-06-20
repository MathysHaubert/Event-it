<?php

declare(strict_types=1);

namespace App\Entity\Capteur;

use App\Entity\Api\Api;

class Capteur
{
    private int $id;
    private string $type;
    private float $value;
    private string $roomId;

    public function __construct(
        int $id = 0,
        string $type = '',
        float $value = 0.0,
        string $roomId = ''
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->value = $value;
        $this->roomId = $roomId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    public function getRoomId(): string
    {
        return $this->roomId;
    }

    public function setRoomId(string $roomId): void
    {
        $this->roomId = $roomId;
    }

    public static function getCapteurs(array $params = null): array
    {
        $api = new Api();
        $data = $api->get($_ENV['API_URL'] . '/capteur', $params);
        $capteurs = [];

        foreach ($data as $capteurData) {
            $capteur = self::createCapteurFromArray($capteurData);
            $capteurs[] = $capteur;
        }

        return $capteurs;
    }

    public static function getCapteurById(array $params): ?self
    {
        $api = new Api();
        $data = $api->get($_ENV['API_URL'] . '/capteur', $params);
        if (!empty($data)) {
            return self::createCapteurFromArray($data);
        }
        return null;
    }

    public static function getCapteurByRoomId(string $roomId): array
    {
        $api = new Api();
        $data = $api->get($_ENV['API_URL'] . '/capteur', ['room' => $roomId]);
        $capteurs = [];

        foreach ($data as $capteurData) {
            $capteur = self::createCapteurFromArray($capteurData);
            $capteurs[] = $capteur;
        }

        return $capteurs;
    }

    public static function createCapteurFromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['type'],
            $data['value'],
            strval($data['room'])
        );
    }
}
