<?php

declare(strict_types=1);

namespace App\Entity\Reservation;

use App\Entity\Organization\Organization;
use App\Entity\Api\Api;

class Reservation
{
    public function __construct(
        private int $id = 0,
        private Organization $organization,
        private string $date,
    )
    {
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

    public static function getReservations(array $params = null): array
    {
        $api = new Api();
        $data = $api->get($_ENV['API_URL'] . '/reservation', $params);
        $reservations = [];

        error_log("Reservation :".json_encode($data));

        foreach ($data as $reservationData) {
            $reservation = self::createReservationFromArray($reservationData);
            $reservations[] = $reservation;
        }

        return $reservations;
    }

    public static function getReservationById(array $params): ?self
    {
        $api = new Api();
        $data = $api->get($_ENV['API_URL'].'/reservation', $params);
        error_log("Reservation :".json_encode($data));
        if (!empty($data)) {
            return self::createReservationFromArray($data);
        }
        return null;
    }

    public static function createReservationFromArray(array $reservationData): self
    {
        $organization = Organization::createOrganizationFromArray($reservationData['organization']);
        $date = explode(" ", $reservationData['startAt']['date'])[0];

        return new self(
            $reservationData['id'],
            $organization,
            $date,
        );
    }
}
