## Description:
This is a very simple two wheel vehicle based on a 18F PIC microcontroller controlled via bluetooth. The vehicle is controlled using a simple web interface written in PHP and jQuery.

## Configuration:
Before you are able to run the client code you will have to set the varible `$serialPort` inside the `controller.php` file to the serial port you are using to communicate with the vehicle.
You also have to make sure that apache has write access to that port, otherwise you will get an `Unable to open serial port.` message caused by an access denied error.
