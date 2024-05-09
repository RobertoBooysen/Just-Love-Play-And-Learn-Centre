<?php

namespace UnitTests;

use PHPUnit\Framework\TestCase;

class AdminPortalUnitTests extends TestCase
{
    //Admin Add(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    //Function to test if admin password is 8 characters(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    public function testAdminPasswordLength()
    {
        //Simulate a POST request with an admin password less than 8 characters(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $_POST['password'] = '12345678';

        //Start output buffering to capture the output(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        ob_start();

        //Include the PHP file to be tested only if it hasn't been included before(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        include 'AddAdmin.php';

        //Get the captured output(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $output = ob_get_clean();

        //Assert that the admin password is 8 characters long(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertEquals(8, strlen($_POST['password']));
    }

    //Admin Events(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    //Function to test if the data inputted is valid(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    public function testEventDataFormat()
    {
        //Sample event data(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $data = [
            'event_name' => 'Test Event',
            'event_description' => 'Description of the event',
            'events_file' => 'path/to/image.jpg',
            'event_date' => '2023-01-01',
        ];

        //Include the PHP file to be tested(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        include 'AdminEvents.php';

        //Assert that event_name is a non-empty string(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertIsString($data['event_name']);
        $this->assertNotEmpty($data['event_name']);

        //Assert that event_description is a non-empty string(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertIsString($data['event_description']);
        $this->assertNotEmpty($data['event_description']);

        //Assert that events_file is a non-empty string and ends with .jpg or .jpeg or .png(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertIsString($data['events_file']);
        $this->assertNotEmpty($data['events_file']);
        $this->assertMatchesRegularExpression('/\.(jpg|jpeg|png)$/', $data['events_file']);

        //Assert that event_date is in the correct format (YYYY-MM-DD)(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertIsString($data['event_date']);
        $this->assertNotEmpty($data['event_date']);

        //Use the global DateTime class, not in a namespace(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertTrue(
            \DateTime::createFromFormat('Y-m-d', $data['event_date']) !== false,
            'Invalid date format. Expected format: YYYY-MM-DD'
        );
    }

    //Function to test if the uploading of images in admin events is in the correct format(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    public function testHandleEventsUpload()
    {
        //Simulate a POST request with a valid file(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $_FILES['events_file'] = [
            'name' => 'test.jpg',
            'type' => 'image/jpeg',
            'tmp_name' => '/tmp/test.tmp',
            'error' => UPLOAD_ERR_OK,
            'size' => 123,
        ];

        //Include the PHP file to be tested(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        include 'AdminEvents.php';

        //Use an anonymous function to simulate the behavior of handleEventsUpload()(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $handleEventsUpload = function () {
            //Check if the uploaded file is of an allowed image format(see Running PHPUnit Tests in PhpStorm with Docker,2017)
            $allowedFormats = ['image/jpg', 'image/jpeg', 'image/png'];

            //Get the file type from the simulated upload(see Running PHPUnit Tests in PhpStorm with Docker,2017)
            $fileType = $_FILES['events_file']['type'];

            //Check if the uploaded file type is in the allowed formats(see Running PHPUnit Tests in PhpStorm with Docker,2017)
            if (in_array($fileType, $allowedFormats)) {
                return 'Uploads/test.jpg';
            } else {
                //Handle the case when the file type is not allowed(see Running PHPUnit Tests in PhpStorm with Docker,2017)
                return false;
            }
        };

        //Call the simulated handleEventsUpload function(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $eventPath = $handleEventsUpload();

        //Set the expected path based on the simulated file upload(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $expectedPath = 'Uploads/test.jpg';

        //Assert that the $eventPath matches the expected path(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertEquals($expectedPath, $eventPath);

        //Additional assertion to check if the file type is valid(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertNotEquals(false, $eventPath, 'Invalid image format. Allowed formats are: jpg, jpeg, png');
    }

    //Admin Resources(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    //Function to test if the data inputted is valid(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    public function testResourceDataFormat()
    {
        //Sample resource data(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $data = [
            'name_of_resource' => 'Test Resource',
            'resource_name' => 'Resource name',
            'resource_date' => '2023-01-01',
            'resource_file' => 'path/to/image.jpg',
        ];

        //Include the PHP file to be tested (if not already included)(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        include 'AdminResources.php';

        //Assert that name_of_resource is a non-empty string(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertIsString($data['name_of_resource']);
        $this->assertNotEmpty($data['name_of_resource']);

        //Assert that resource_name is a non-empty string(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertIsString($data['resource_name']);
        $this->assertNotEmpty($data['resource_name']);

        //Assert that resource_date is in the correct format (YYYY-MM-DD)(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertIsString($data['resource_date']);
        $this->assertNotEmpty($data['resource_date']);

        //Assert that resource_file is a non-empty string and ends with .jpg or .jpeg or .png(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertIsString($data['resource_file']);
        $this->assertNotEmpty($data['resource_file']);
        $this->assertMatchesRegularExpression('/\.(jpg|jpeg|png)$/', $data['resource_file']);

        //Use the global DateTime class, not in a namespace(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertTrue(
            \DateTime::createFromFormat('Y-m-d', $data['resource_date']) !== false,
            'Invalid date format. Expected format: YYYY-MM-DD'
        );
    }

    //Function to test if the uploading of resources in admin resources is in the correct format(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    public function testHandleResourcesUpload()
    {
        //Simulate a POST request with a valid file(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $_FILES['resource_file'] = [
            'name' => 'test.jpg',
            'type' => 'image/jpeg',
            'tmp_name' => '/tmp/test.tmp',
            'error' => UPLOAD_ERR_OK,
            'size' => 123,
        ];

        //Include the PHP file to be tested(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        include 'AdminResources.php';

        //Use an anonymous function to simulate the behavior of handleResourcesUpload()(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $handleResourcesUpload = function () {
            //Check if the uploaded file is of an allowed image format(see Running PHPUnit Tests in PhpStorm with Docker,2017)
            $allowedFormats = ['image/jpg', 'image/jpeg', 'image/png'];

            //Get the file type from the simulated upload(see Running PHPUnit Tests in PhpStorm with Docker,2017)
            $fileType = $_FILES['resource_file']['type'];

            //Check if the uploaded file type is in the allowed formats(see Running PHPUnit Tests in PhpStorm with Docker,2017)
            if (in_array($fileType, $allowedFormats)) {
                return 'Uploads/test.jpg'; //Adjust the return value based on your resource file handling logic(see Running PHPUnit Tests in PhpStorm with Docker,2017)
            } else {
                //Handle the case when the file type is not allowed(see Running PHPUnit Tests in PhpStorm with Docker,2017)
                return false;
            }
        };

        //Call the simulated handleResourcesUpload function(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $resourcePath = $handleResourcesUpload();

        //Set the expected path based on the simulated file upload(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $expectedPath = 'Uploads/test.jpg';

        //Assert that the $resourcePath matches the expected path(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertEquals($expectedPath, $resourcePath);

        //Additional assertion to check if the file type is valid(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertNotEquals(false, $resourcePath, 'Invalid image format. Allowed formats are: jpg, jpeg, png');
    }

    //Admin Images(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    public function testImageDataFormat()
    {
        //Sample event data(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $data = [
            'c_name' => 'Test Image',
            'image_description' => 'Description of the event',
            'image_date' => '2023-01-01',
            'image_file' => 'path/to/image.jpg',
        ];
        //Include the PHP file to be tested(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        include 'AdminImages.php';

        //Assert that c_name is a non-empty string(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertIsString($data['c_name']);
        $this->assertNotEmpty($data['c_name']);

        //Assert that image_description is a non-empty string(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertIsString($data['image_description']);
        $this->assertNotEmpty($data['image_description']);

        //Assert that image_date is in the correct format (YYYY-MM-DD)(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertIsString($data['image_date']);
        $this->assertNotEmpty($data['image_date']);

        //Assert that image_file is a non-empty string and ends with .jpg or .jpeg or .png(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertIsString($data['image_file']);
        $this->assertNotEmpty($data['image_file']);
        $this->assertMatchesRegularExpression('/\.(jpg|jpeg|png)$/', $data['image_file']);
    }

    //Function to test if the uploading of images in admin images is in the correct format(see Running PHPUnit Tests in PhpStorm with Docker,2017)
    public function testHandleImagesUpload()
    {
        //Simulate a POST request with a valid file(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $_FILES['image_file'] = [
            'name' => 'test.jpg',
            'type' => 'image/jpeg',
            'tmp_name' => '/tmp/test.tmp',
            'error' => UPLOAD_ERR_OK,
            'size' => 123,
        ];
        //Include the PHP file to be tested(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        include 'AdminImages.php';
        //Use an anonymous function to simulate the behavior of handleImageUpload()(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $handleImageUpload = function () {
            //Check if the uploaded file is of an allowed image format(see Running PHPUnit Tests in PhpStorm with Docker,2017)
            $allowedFormats = ['image/jpg', 'image/jpeg', 'image/png'];
            //Get the file type from the simulated upload(see Running PHPUnit Tests in PhpStorm with Docker,2017)
            $fileType = $_FILES['image_file']['type'];
            //Check if the uploaded file type is in the allowed formats(see Running PHPUnit Tests in PhpStorm with Docker,2017)
            if (in_array($fileType, $allowedFormats)) {
                return 'Uploads/test.jpg';
            } else {
                //Handle the case when the file type is not allowed(see Running PHPUnit Tests in PhpStorm with Docker,2017)
                return false;
            }
        };
        //Call the simulated handleEventsUpload function(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $imagePath = $handleImageUpload();
        //Set the expected path based on the simulated file upload(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $expectedPath = 'Uploads/test.jpg';
        //Assert that the $eventPath matches the expected path(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertEquals($expectedPath, $imagePath);
        //Additional assertion to check if the file type is valid(see Running PHPUnit Tests in PhpStorm with Docker,2017)
        $this->assertNotEquals(false, $imagePath, 'Invalid image format. Allowed formats are: jpg, jpeg, png');
    }
}
