<?php
// Initiate Class Here
class Dog{
    // Get the arguments
    public function __construct($name, $age){
        // Set dog name
        $this->name = $name;
        // Set dog age
        $this->age = $age;
    }

    public function dogName(){
        return "Woof! My name is ". $this->name;
    }

    public function bark(){
        return "BARK BARK BARK";
    }

    // Function to get dog's age
    public function dogAge(){
        return "Woof! I'm ". $this->age ." old";
    }
}

// Create a dog
$fido = new Dog("fido", 12); // Create a new Class "Dog"

// Make fido bark
echo $fido->bark(); // prints "bark bark bark"

// Whats your name fido ?
echo $fido->dogName(); // prints "Woof! My name is fido" on the screen

// Create another dog
$john = new Dog("john", 11);