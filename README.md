# Chloris
Web application made for remembering about watering the plants. 
## How to run it
First, check if git, Docker and Docker Compose are present on your system. If you do not have it, complete the basic 
installation using the documentation.

Then clone this repository 

`git clone https://github.com/zawias2704/chloris.git`

Next, go to the project directory. If you have Linux system, run the following command at the terminal to run docker

`./docker/up`

If you have macOS system should use this command 

`./docker/up-mac`

And run on Linux

`./docker/attach`

On macOS

`./docker/attach-mac`

To install the composer, create a database, and load the sample users, run the command

`phing build`

Run the tests after the above command

`phing test`

And run it in your browse of your choice. 

On Linux

`10.0.0.1`

On macOS

`localhost`

To quit the application run

`exit`

And on Linux

`./docker/down`

On macOS

`./docker/down-mac`

