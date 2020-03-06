<?php
namespace App\Tests\Helpers;

use App\Helpers\ValidationTrait;
use Symfony\Component\Validator\Validation;
use PHPUnit\Framework\TestCase;

class ValidationTraitTest extends TestCase
{
    use ValidationTrait;

    public function testGetValidationConstraint()
    {
        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
        $constraints = $this->getValidationConstraint();

        $validationErrors = $validator->validate(['mmsi' => '1.1', 'dateFrom' => 'date', 'dateTo' => 'date', 'minLat' => 'test', 'minLon' => 'test', 'maxLat' => 'test', 'maxLon' => 'test', 'format' => 'test'], $constraints);
        $this->assertEquals($validationErrors[0]->getMessage(), 'This value is not valid.');
        $this->assertEquals($validationErrors[0]->getInvalidValue(), '1.1');
        $this->assertEquals($validationErrors[1]->getMessage(), 'This value should be of type numeric.');
        $this->assertEquals($validationErrors[1]->getInvalidValue(), 'test');
        $this->assertEquals($validationErrors[2]->getMessage(), 'This value should be of type numeric.');
        $this->assertEquals($validationErrors[2]->getInvalidValue(), 'test');
        $this->assertEquals($validationErrors[3]->getMessage(), 'This value should be of type numeric.');
        $this->assertEquals($validationErrors[3]->getInvalidValue(), 'test');
        $this->assertEquals($validationErrors[4]->getMessage(), 'This value should be of type numeric.');
        $this->assertEquals($validationErrors[4]->getInvalidValue(), 'test');
        $this->assertEquals($validationErrors[5]->getMessage(), 'This value is not a valid datetime.');
        $this->assertEquals($validationErrors[5]->getInvalidValue(), 'date');
        $this->assertEquals($validationErrors[6]->getMessage(), 'This value is not a valid datetime.');
        $this->assertEquals($validationErrors[6]->getInvalidValue(), 'date');
        $this->assertEquals($validationErrors[7]->getMessage(), 'The value you selected is not a valid choice.');
        $this->assertEquals($validationErrors[7]->getInvalidValue(), 'test');
    }
}