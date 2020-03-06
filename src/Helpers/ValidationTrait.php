<?php

namespace App\Helpers;

use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Regex;

/**
 * Class ValidationTrait
 */
trait ValidationTrait
{
    /**
     * Returns a validation constraint collection that can be used to validate incoming requests
     *
     * @return Collection
     */
    public function getValidationConstraint()
    {
        return new Collection(array(
            'allowExtraFields' => false,
            'fields' => array(
                'mmsi' => new Required(array(
                    new NotNull(),
                    new NotBlank(),
                    new Regex(array('pattern' => '/^\d+(?:,\d+)*$/'))
                )),
                'minLat' => new Optional(array(
                    new Type(array('type' => 'numeric')),
                )),
                'maxLat' => new Optional(array(
                    new Type(array('type' => 'numeric')),
                )),
                'minLon' => new Optional(array(
                    new Type(array('type' => 'numeric'))
                )),
                'maxLon' => new Optional(array(
                    new Type(array('type' => 'numeric'))
                )),
                'dateFrom' => new Optional(array(
                    new DateTime(array('format' => 'Y-m-d\TH:i:s\Z')),
                )),
                'dateTo' => new Optional(array(
                    new DateTime(array('format' => 'Y-m-d\TH:i:s\Z')),
                )),
                'format' => new Optional(array(
                    new Choice(array('json', 'csv', 'xml', 'hal')),
                ))
            )
        ));
    }
}