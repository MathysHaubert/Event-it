<?php

namespace App\Entity\Room;

use App\Entity\User\Api;
use App\Entity\User\User;
use App\Trait\ApiTrait;
use App\Trait\Identifier;
use DateTime;

class Room
{
    use ApiTrait;
    use Identifier;
    private string $location;

    private DateTime $integratedAt;



    /**
     * Get the value of integratedAt
     */
    public function getIntegratedAt()
    {
        return $this->integratedAt;
    }

    /**
     * Set the value of integratedAt
     *
     * @return  self
     */
    public function setIntegratedAt($integratedAt)
    {
        $this->integratedAt = $integratedAt;

        return $this;
    }

    /**
     * Get the value of location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @return  self
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    public static function getLinkedRooms(User $user): array
    {
    $api = new Api();
    $data = $api->get($_ENV['API_URL'].'/room', $user->getOrganization()->getId());
    $rooms = [];
    foreach ($data as $roomData) {
        $room = self::createRoomFromArray($roomData);
        $rooms[] = $room;
    }
    return $rooms;
    }

    private static function createRoomFromArray(array $params): Room
    {
        $room = new Room();
        $room->setLocation($params['location']);
        $room->setIntegratedAt($params['integrated_at']);
        return $room;
    }
}
