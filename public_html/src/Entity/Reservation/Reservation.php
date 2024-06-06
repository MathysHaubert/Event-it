<?php

declare(strict_types=1);

namespace App\Entity\Reservation;

use App\Entity\Organization\Organization;
use App\Entity\Api\Api;

class Reservation
{
    public function __construct(
        private string $date,
        private Organization $organization,
        private int $id = 0,
        private int $roomId = 0
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
    }

    public function setOrganization(Organization $organization): void
    {
        $this->organization = $organization;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function setRoomId(int $roomId): void
    {
        $this->roomId = $roomId;
    }

    public static function getReservations(array $params = null): array
    {
        $api = new Api();
        $data = $api->get($_ENV['API_URL'] . '/reservation', $params);
        $reservations = [];

        foreach ($data as $reservationData) {
            $reservation = self::createReservationFromArray($reservationData);
            $reservations[] = $reservation;
        }

        return $reservations;
    }

    public static function getReservationById(array $params): ?self
    {
        $api = new Api();
        $data = $api->get($_ENV['API_URL'] . '/reservation', $params);
        if (!empty($data)) {
            return self::createReservationFromArray($data);
        }
        return null;
    }

    public static function createReservation(array $reservationData): void
    {
        error_log('Creating reservation');
        $api = new Api();
        $response = $api->post($_ENV['API_URL'] . '/reservation', $reservationData);
    }

    public static function createReservationFromArray(array $reservationData): self
    {
        $organization = Organization::createOrganizationFromArray($reservationData['organization']);
        $date = explode(" ", $reservationData['startAt']['date'])[0];

        return new self(
            $date,
            $organization,
            $reservationData['id'],
            $reservationData['room']['id']
        );
    }
}
