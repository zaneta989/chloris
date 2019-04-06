# Chloris
Web application made for remembering about watering the plants. 
## How to run it
First, check if git, docker and docker-compose are present on your system. Git is required to clone this repository while docker and docker-compose must be installed to use this application in container environment.

First, clone this repository 

`git clone https://github.com/zaneta989/chloris.git`

Next, go to the project directory.

`cd chloris`

Now you can run containers in order to start an application:

`./docker/up`

Run the following command at the terminal to reach container console:

`./docker/attach`

To install the composer, create a database, and load the sample users, run the command

`phing build`

Run the tests after the above command

`phing test`

Now you can run application in browser. 

On Linux

`10.0.0.1`

On macOS

`localhost`

To destroy containers and network:

`./docker/down`
