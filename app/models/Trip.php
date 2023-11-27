<?php

namespace app\models;

use app\core\DateUtils;
use app\database\DatabaseConnection;
use app\database\TripsDatabase;
use DateTime;
use Exception;

class Trip
{
    private int $id;
    private string $title;
    private string $details;
    private string $location;
    private int $price;
    private int $companyId;
    private ?int $numOfTripsAvailable;
    private ?int $numOfReservedTrips;
    private ?int $rateId;
    private ?DateTime $startDate;
    private ?DateTime $endDate;
    private ?array $images;

    /**
     * @param array $trip
     * @throws Exception
     */
    public function __construct(array $trip)
    {
        $this->id = $trip['trip_id'];
        $this->title = $trip['trip_title'];
        $this->details = $trip['trip_details'];
        $this->location = $trip['trip_location'];
        $this->price = $trip['trip_price'];
        $this->companyId = $trip['company_id'];
        $this->numOfTripsAvailable = $trip['no_of_available_trips'] ?? null;
        $this->numOfReservedTrips = $trip['no_of_reserved_trips'] ?? null;
        $this->rateId = $trip['trip_rate_id'] ?? null;
        $this->startDate = new DateTime($trip['trip_start_date']);
        $this->endDate = new DateTime($trip['trip_end_date']);
        $this->images = explode(',', $trip['images']) ?? null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDetails(): string
    {
        return $this->details;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    public function getNumOfTripsAvailable(): int
    {
        return $this->numOfTripsAvailable;
    }

    public function getNumOfReservedTrips(): int
    {
        return $this->numOfReservedTrips;
    }

    public function getRateId(): int
    {
        return $this->rateId;
    }

    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function calculateDayToEndOfReservation(): int
    {
        return DateUtils::calculateDateUntil($this->endDate);
    }

    public function getEndOfReservationFormatted(): string
    {
        return DateUtils::formatDate($this->endDate, -8);
    }

    public static function getTripById($tripId): bool|array
    {
        return TripsDatabase::show($tripId);
    }
}