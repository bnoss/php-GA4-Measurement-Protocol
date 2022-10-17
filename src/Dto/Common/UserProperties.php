<?php
/**
 * User: Damian Zamojski (br33f)
 * Date: 22.06.2021
 * Time: 12:23
 */

namespace Br33f\Ga4\MeasurementProtocol\Dto\Common;


use Br33f\Ga4\MeasurementProtocol\Dto\ExportableInterface;

class UserProperties implements ExportableInterface
{
    /**
     * @var UserProperty[]
     */
    protected $userPropertiesList;

    /**
     * UserProperties constructor.
     * @param UserProperty[] $userPropertiesList
     */
    public function __construct(array $userPropertiesList = null)
    {
        $this->userPropertiesList = $userPropertiesList ?? [];
    }

    /**
     * @param UserProperty $userProperty
     */
    public function addUserProperty(UserProperty $userProperty)
    {
        $this->userPropertiesList[] = $userProperty;
    }

    /**
     * @return array
     */
    public function export(): array
    {
        return array_reduce($this->getUserPropertiesList(), function ($last, UserProperty $userProperty) {
            $last[$userProperty->getName()] = [
                'value' => $userProperty->getValue(),
            ];
            return $last;
        }, []);
    }

    /**
     * @return UserProperty[]
     */
    public function getUserPropertiesList(): array
    {
        return $this->userPropertiesList;
    }

    /**
     * @param UserProperty[] $userPropertiesList
     */
    public function setUserPropertiesList(array $userPropertiesList)
    {
        $this->userPropertiesList = $userPropertiesList;
    }
}