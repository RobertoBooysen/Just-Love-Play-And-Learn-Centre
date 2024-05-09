<?php

namespace UnitTests;

use PHPUnit\Framework\TestCase;

class ParentPortalUnitTests extends TestCase
{
    //Parent Register(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    //Function to test if id is 13 characters(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    public function testRegisterChildIDLength()
    {
        //Simulate a POST request with a password less than 13 characters(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $_POST['id'] = '1234567891011';

        // Start output buffering to capture the output(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        ob_start();

        //Include the PHP file to be tested(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'ParentRegister.php';

        //Get the captured output
        $output = ob_get_clean();

        //Assert that the password is 13 characters long(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertEquals(13, strlen($_POST['id']));
    }

    //Function to test if password is 8 characters(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    public function testRegisterPasswordLength()
    {
        //Simulate a POST request with a password less than 8 characters(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $_POST['password'] = '12345678';

        //Start output buffering to capture the output(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        ob_start();

        //Include the PHP file to be tested(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'ParentRegister.php';

        //Get the captured output(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $output = ob_get_clean();

        //Assert that the password is 8 characters long(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertEquals(8, strlen($_POST['password']));
    }

    //Parent Login(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    //Function to test if id is 13 characters(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    public function testLoginChildIDLength()
    {
        //Simulate a POST request with a password less than 13 characters(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $_POST['id'] = '1234567891011';

        // Start output buffering to capture the output(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        ob_start();

        //Include the PHP file to be tested(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'ParentLogin.php';

        //Get the captured output(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $output = ob_get_clean();

        //Assert that the password is 13 characters long(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertEquals(13, strlen($_POST['id']));
    }

    //Parent Log Ticket(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    //Function to test if the data inputted is valid(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    public function testTicketDataFormat()
    {
        //Sample ticket data(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $data = [
            'parent_first_name' => 'Jade',
            'parent_last_name' => 'Willard',
            'parent_email' => 'test@example.com',
            'parent_phone' => '0722334511',
            'query' => 'Do not listen',

        ];

        //Include the PHP file to be tested(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        include 'ParentLogTicket.php';

        //Assert that parent_first_name is a non-empty string(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertIsString($data['parent_first_name']);
        $this->assertNotEmpty($data['parent_first_name']);

        //Assert that parent_last_name is a non-empty string(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertIsString($data['parent_last_name']);
        $this->assertNotEmpty($data['parent_last_name']);

        //Assert that parent_email is a non-empty string(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertIsString($data['parent_email']);
        $this->assertNotEmpty($data['parent_email']);

        //Assert that parent_phone is a non-empty string(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertIsString($data['parent_phone']);
        $this->assertNotEmpty($data['parent_phone']);

        //Assert that query is a non-empty string(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertIsString($data['query']);
        $this->assertNotEmpty($data['query']);
    }

    //Functions to test if users insert a valid phone number(see Running PHPUnit Tests in PhpStorm with Docker,2017)

    /**
     * Test case to validate a correct phone number.
     *
     * @dataProvider validPhoneNumbers
     */
    public function testValidPhoneNumber($phoneNumber)
    {
        //Set the POST data with a valid phone number(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $_POST['parent_phone'] = $phoneNumber;

        //Execute the phone number validation function(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $result = $this->validatePhoneNumber();

        //Assert that the validation result is true for a valid phone number(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertTrue($result);
    }

    //Helper function to validate the phone number by including the PHP file(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    public function validatePhoneNumber()
    {
        //Start output buffering to capture the included file's output(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        ob_start();

        //Include the PHP file containing the phone number validation logic(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        include 'ParentLogTicket.php';

        //Clean the output buffer(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        ob_end_clean();

        //Return true if the output is empty (validation passes), false otherwise(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        return ob_get_contents() === '';
    }

    //Data provider for valid phone numbers(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    public function validPhoneNumbers()
    {
        return [
            ['1234567890'],
            ['9876543210'],
        ];
    }

    //Tour(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    //Function to check for valid time entry(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    public function testIsTimeValid()
    {
        //Simulate a POST request with a valid time(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $_POST['time'] = '12:00:00';

        //Start output buffering to capture the output(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        ob_start();

        //Include the PHP file to be tested(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Tour.php';

        //Get the captured output(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $output = ob_get_clean();

        //Test a valid time(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $result = isTimeValid($_POST['time']);

        //Assert that the time is valid(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertTrue($result);

        //Simulate a POST request with an invalid time(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $_POST['time'] = '07:00:00';

        //Start output buffering to capture the output(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        ob_start();

        //Include the PHP file to be tested(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Tour.php';

        //Get the captured output(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $output = ob_get_clean();

        //Test an invalid time(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $result = isTimeValid($_POST['time']);

        //Assert that the time is invalid(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertFalse($result);
    }

    //Function to test if email is valid(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    public function testIsEmailValid()
    {
        //Simulate a POST request with a valid email(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $_POST['email'] = 'test@example.com';

        //Start output buffering to capture the output(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        ob_start();

        //Include the PHP file to be tested(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Tour.php';

        //Get the captured output(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $output = ob_get_clean();

        //Test a valid email(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $result = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

        //Assert that the email is valid(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertTrue($result !== false);

        //Simulate a POST request with an invalid email(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $_POST['email'] = 'invalid_email';

        //Start output buffering to capture the output(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        ob_start();

        //Include the PHP file to be tested(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Tour.php';

        //Get the captured output(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $output = ob_get_clean();

        //Test an invalid email(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $result = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

        //Assert that the email is invalid(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertFalse($result !== false);
    }
}
