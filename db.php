<?php

require_once 'vendor/autoload.php'; // Include the Faker library

// Set up the database connection
$servername = 'localhost';
$username = 'harsh';
$password = '123456';
$dbname = 'dbTocsv';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Generate fake data using Faker
    $faker = Faker\Factory::create();

    // Insert 1000 records into the customer table
    $stmt = $conn->prepare("INSERT INTO customer (first_name, middle_name, last_name, mobile_number, address, email_id, created_at) 
                            VALUES (:first_name, :middle_name, :last_name, :mobile_number, :address, :email_id, :created_at)");

    for ($i = 0; $i < 10; $i++) {
        $firstName = $faker->firstName;
        $middleName = $faker->firstNameMale;
        $lastName = $faker->lastName;
        $mobileNumber = $faker->phoneNumber;
        $address = $faker->address;
        $email = $faker->email;
        $createdAt = date('Y-m-d H:i:s');

        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':middle_name', $middleName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':mobile_number', $mobileNumber);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':email_id', $email);
        $stmt->bindParam(':created_at', $createdAt);

        $stmt->execute();
    }

    echo "Records inserted successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>
