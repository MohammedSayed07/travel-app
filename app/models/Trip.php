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
    private ?string $startDate;
    private ?string $endDate;
    private ?array $images;

    /**
     */
    public function __construct()
    {
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDetails(string $details): void
    {
        $this->details = $details;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function setCompanyId(int $companyId): void
    {
        $this->companyId = $companyId;
    }

    public function setNumOfTripsAvailable(?int $numOfTripsAvailable): void
    {
        $this->numOfTripsAvailable = $numOfTripsAvailable;
    }

    public function setNumOfReservedTrips(?int $numOfReservedTrips): void
    {
        $this->numOfReservedTrips = $numOfReservedTrips;
    }

    public function setRateId(?int $rateId): void
    {
        $this->rateId = $rateId;
    }

    public function setStartDate(?string $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function setEndDate(?string $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function setImages(?array $images): void
    {
        $this->images = $images;
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

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getEndDate(): string
    {
        return $this->endDate;
    }

    public function getImages(): array
    {
        return $this->images ?? [];
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

    public static function factory(array $data): Trip
    {
        $obj = new static();
        $mapper = ($obj)->dataMapper();

        if (isset($data['images'])) {
            $data['images'] = explode(',', $data['images']);
        }

        foreach ($data as $key => $value) {
            if (array_key_exists($key, $mapper)) {
                $setterMethod = 'set'.$mapper[$key];
                $obj->{$setterMethod}($value);
            }
        }
        return $obj;
    }

    private function dataMapper(): array
    {
        return [
            'trip_id' => 'id',
            'trip_title' => 'title',
            'trip_details' => 'details',
            'trip_location' => 'location',
            'trip_price' => 'price',
            'company_id' => 'companyId',
            'no_of_available_trips' => 'numOfTripsAvailable',
            'no_of_reserved_trips' => 'numOfReservedTrips',
            'trip_rate_id' => 'rateId',
            'trip_start_date' => 'startDate',
            'trip_end_date' => 'endDate',
            'images' => 'images',
        ];
    }
}
