<?php
// src/Entity/Room.php
namespace App\Entity\Room;

use App\Entity\User\Api;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

class Room implements \JsonSerializable
{
    private $id;

    private $location;

    private $integrated_at;

    private array $reservations;

    private array $capteur;

    // getters and setters

    /**
     * Get the value of id
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int$id): void
    {
        $this->id = $id;
    }
    /**
     * Get the value of location
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * Set the value of location
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    /**
     * Get the value of integrated_at
     * @return \DateTimeInterface|null
     */
    public function getIntegratedAt(): ?\DateTimeInterface
    {
        return $this->integrated_at;
    }

    /**
     * Set the value of integrated_at
     * @param \DateTimeInterface $integrated_at
     */
    public function setIntegratedAt(\DateTimeInterface $integrated_at): void
    {
        $this->integrated_at = $integrated_at;
    }

    public function getReservations(): array
    {
        return $this->reservations;
    }

    public function setReservations(array $reservations): void
    {
        $this->reservations = $reservations;
    }

    public function getCapteur(): array
    {
        return $this->capteur;
    }

    public function setCapteur(array $capteur): void
    {
        $this->capteur = $capteur;
    }

    public function jsonSerialize(): mixed
    {

        if($this->getCapteur() === null){
            $capteurs = null;
        } else{
            $capteurs = [];
            foreach ($this->getCapteur() as $capteur) {
                $capteurs[] = $capteur->getId();
            }
        }

        if($this->reservations === null){
            $reservations = null;
        } else{
            $reservations = [];
            foreach ($this->getReservations() as $reservation) {
                $reservations[] = $reservation->getId();
            }
        }

        return [
            'id' => $this->id,
            'location' => $this->location,
            'integrated_at' => $this->integrated_at,
            'reservations' => $reservations,
            'capteurs' => $capteurs,
        ];
    }
    public static function getRooms(): array
    {
        $api = new Api();
        $data = $api->get($_ENV['API_URL'].'/room');
        $rooms = [];
        foreach ($data as $roomData) {
            $room = self::createRoomFromArray($roomData);
            $rooms[] = $room;
        }
        return $rooms;
    }

    /**
     * @throws \Exception
     */
    private static function createRoomFromArray(array $params): Room
    {
        $room = new Room();
        $room->setLocation($params['location']);
        $room->setIntegratedAt(new DateTime($params['integrated_at']['date']));
        $room->setCapteur($params['capteurs']);
        $room->setReservations($params['reservations']);
        $room->setId($params['id']);
        return $room;
    }
}
