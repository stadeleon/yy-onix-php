<?php

namespace AragornYang\Onix\Composites;

use AragornYang\Onix\CodeInList;
use AragornYang\Onix\CodeLists\CodeList49RegionCodeSimplified;
use AragornYang\Onix\CodeLists\CodeList53ReturnsConditionsCodeType;
use AragornYang\Onix\CodeLists\CodeList54AvailabilityStatus;
use AragornYang\Onix\CodeLists\CodeList65ProductAvailability;
use AragornYang\Onix\CodeLists\CodeList91CountryCodeISO31661;
use AragornYang\Onix\CodeLists\CodeList93SupplierRole;
use AragornYang\Onix\ProductFeatures\HasExpectedShipDate;
use AragornYang\Onix\ProductFeatures\HasStock;

class SupplyDetail extends Composite
{
    use HasExpectedShipDate, HasStock;
    /** @var CodeInList */
    protected $supplierRole;
    /** @var string */
    protected $supplierSAN = '';
    /** @var string */
    protected $SupplierName = '';
    /** @var CodeInList */
    protected $availabilityCode;
    /** @var CodeInList */
    protected $productAvailability;
    /** @var CodeInList */
    protected $returnsCodeType;
    /** @var string */
    protected $returnsCode = '';
    /**
     * @var int Estimated time to supply
     */
    protected $orderTime = 0;
    /** @var int */
    protected $packQuantity = 10;
    /** @var CodeInList[] */
    protected $supplyToCountries = [];
    /** @var CodeInList[] */
    protected $supplyToTerritories = [];
    /** @var Price[] */
    protected $prices = [];

    /** @var string */
    protected $supplierEANLocationNumber = '';

    public function getSupplierRole(): string
    {
        return $this->supplierRole ? $this->supplierRole->code() : '';
    }

    public function getSupplierRoleDesc(): string
    {
        return $this->supplierRole ? $this->supplierRole->desc() : '';
    }

    public function setSupplierRole(string $code): void
    {
        $this->supplierRole = new CodeInList(CodeList93SupplierRole::class, $code);
    }

    public function getSupplierSAN(): string
    {
        return $this->supplierSAN;
    }

    public function setSupplierSAN(string $supplierSAN): void
    {
        $this->supplierSAN = $supplierSAN;
    }

    public function getSupplierName(): string
    {
        return $this->SupplierName;
    }

    public function setSupplierName(string $SupplierName): void
    {
        $this->SupplierName = $SupplierName;
    }

    public function getAvailabilityCode(): string
    {
        return $this->availabilityCode ? $this->availabilityCode->code() : '';
    }

    public function getAvailabilityCodeDesc(): string
    {
        return $this->availabilityCode ? $this->availabilityCode->desc() : '';
    }

    public function setAvailabilityCode(string $code): void
    {
        $this->availabilityCode = new CodeInList(CodeList54AvailabilityStatus::class, $code);
    }

    public function getProductAvailability(): string
    {
        return $this->productAvailability ? $this->productAvailability->code() : '';
    }

    public function getProductAvailabilityDesc(): string
    {
        return $this->productAvailability ? $this->productAvailability->desc() : '';
    }

    public function setProductAvailability(string $code): void
    {
        $this->productAvailability = new CodeInList(CodeList65ProductAvailability::class, $code);
    }

    public function getReturnsCodeType(): string
    {
        return $this->returnsCodeType ? $this->returnsCodeType->code() : '';
    }

    public function getReturnsCodeTypeDesc(): string
    {
        return $this->returnsCodeType ? $this->returnsCodeType->desc() : '';
    }

    public function setReturnsCodeType(string $code): void
    {
        $this->returnsCodeType = new CodeInList(CodeList53ReturnsConditionsCodeType::class, $code);
    }

    /**
     * @return Price[]
     */
    public function getPrices(): array
    {
        return $this->prices;
    }

    public function setPrice(\SimpleXMLElement $xml): void
    {
        $this->prices[] = Price::buildFromXml($xml, $this);
    }

    public function getOrderTime(): int
    {
        return $this->orderTime;
    }

    public function setOrderTime(string $orderTime): void
    {
        $this->orderTime = (int)$orderTime;
    }

    public function getPackQuantity(): int
    {
        return $this->packQuantity;
    }

    public function setPackQuantity(string $packQuantity): void
    {
        $this->packQuantity = (int)$packQuantity;
    }

    public function getReturnsCode(): string
    {
        return $this->returnsCode;
    }

    public function setReturnsCode(string $returnsCode): void
    {
        $this->returnsCode = $returnsCode;
    }

    public function getSupplyToCountries(): array
    {
        return $this->supplyToCountries;
    }

    public function setSupplyToCountry(string $codes): void
    {
        foreach (explode(' ', $codes) as $code) {
            if (!$code) {
                continue;
            }
            new CodeInList(CodeList91CountryCodeISO31661::class, $code);
            $this->supplyToCountries[] = $code;
        }
    }

    public function getSupplyToTerritories(): array
    {
        return $this->supplyToTerritories;
    }

    public function setSupplyToTerritory(string $codes): void
    {
        foreach (explode(' ', $codes) as $code) {
            if (!$code) {
                continue;
            }
            new CodeInList(CodeList49RegionCodeSimplified::class, $code);
            $this->supplyToTerritories[] = $code;
        }
    }

    public function setSupplierEANLocationNumber(string $value): void
    {
        $this->supplierEANLocationNumber = $value;
    }

    public function getSupplierEANLocationNumber(): string
    {
        return $this->supplierEANLocationNumber;
    }
}