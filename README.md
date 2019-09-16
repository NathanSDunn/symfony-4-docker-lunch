# Installation  / Build
Docker version 1 or higher,  Composer 1.6.3 or higher, PHP7 and git are required for this project to build and run.

If you do not have them, they can be installed on Ubuntu 18.04 or another recent Debian Linux distribution by running

``sudo apt update && sudo apt install docker docker-compose composer git php7.0``

Once these dependencies are installed, simply run
``./build.sh``
to 
* Install dependencies with composer
* Enforce PSR-1 and PSR-2 with PHP CodeSniffer
* Run unit tests with PHPunit
* Install a pre-commit hook to enforce code quality on every commit
* Build and launch docker

# Running the application
If there are no services running on localhost:8080 all you will need to do is Install the application as previously described, build, and navigate to http://localhost:8080/lunch once docker finishes booting up containers. If you are running this application on a cloud server you will need to open port 8080 and change localhost to the IP address of your server, or update docker-compose.yml to choose a different port.

By default, the application starts up in development mode. To change this to production you will need to set the environment variable APP_ENV=prod in .env or within your local environment. Should you be using AWS, you can specify this in the EC2 launch configuration.

# Technology Choices
## Symfony 4 vs Silex
When attempting to install silex via composer it was noted that Silex is no longer maintained. Upon further research a blog post https://symfony.com/blog/the-end-of-silex noted that Symfony 4 and Flex feels as lightweight as Silex. As the company this exercise was prepared for is using Symfony 4 in it's application I wanted to learn more about Symfony 4 while developing this application, and chose it as a 'lightweight' alternative (with no database or additional Symfony features included).

Additionally, Symfony 4 complies with PSR-3: Logging, PSR-4: Autoloading,  PSR-6: Caching Interface and PSR-7: HTTP message interfaces.

Whilst I have not used Symfony 4 previously I am experienced in PHP and Testing. I hope this demonstrates my ability to learn and interest in the topic.

## Docker version 1
Omitting the Docker version from docker-compose falls back to version 1. While there are more features available in newer versions, this excercise did not require these features and as such it was decided using the initial version would provide maximum forward compatibility should any later Docker versions be used.

Using separate php and nginx docker images also allows a faster startup time than would be possible using a Dockerfile to install and configure PHP on each run.

Although my experience with Docker is minimal I decided to learn best practices and implement them for the purposes of this exercise.

For maximum code cleanliness it would be advisable to separate the docker file and app code into separate subdirectories, however as I had started out with the app implemenation I did not want to muddy the git commit history with a large number of file move/renames.

## Composer
Composer is a well known dependency management tool used widely in many PHP projects. It was used to install Composer, PHPunit, and PHP Codesniffer.

## Git
Git is the premier version control system (VCS) used in software projects today. I have many years experience using this great tool, as demonstrated in https://speakerdeck.com/nathansdunn/using-git-to-make-life-easier-and-code-better, and it is my preferred VCS of choice.

### Git Hooks
In the build script, installation of a git hook to check code quality of every commit occurs. This allows developers to find and fix errors in their code in real time.

## PHP Unit
PHP Unit is great for running tests and I have a fair amount of experience using this previously, as demonstrated in https://github.com/NathanSDunn/flickr-gallery.

## PHP CodeSniffer
PHPcs is able to detect and fix code style violations quickly and reliably. By default it checks against PSR-1 and PSR-2. A git pre-commit hook was also created to ensure PHPcs and PHPunit are run on every commit in order to enforce code style and code quality.

# Code choices
## Annotations
While annotations are the recommended way for defining routes in Symfony 4, it was decided that `config/routes.yaml` in order to provide a single point where all routes are defined. Installing the annotations package would also be required, making the project less lightweight.

## Test Driven Development
Given that we wish our code to have tests and that Acceptance criteria, as well as an OOP approach is desired I have chosen to perform Test Driven Development, and write tests before code. Studies by Microsoft have shown that practicing TDD adds a 15% overhead to time taken, and prevents additional overheads of writing tests and needing to redesign code to accomodate them after the fact.

### Property-based testing
Property based testing was considered overkill for the purposes of this exercise regarding ingredient names as it was not specified in the specification and made testing easier, but was used for ingredient dates as these may change in the future.

### Fixtures
A large amount of copy-pasting of fixtures was required in order to provide a full set of tests. It would be useful to investigate opportunities to share fixtures between tests in future work.

## OOP and source data
It was noted from recipies.json and ingredients.json that arrays of Recipies and Ingredients are supplied. To simplify parsing of these it was decided to use arrays of these objects in both testing and parsing, instead of creating container objects for each. The service pattern was used to create a Services that could be tested against acceptance criteria, with prior knoweledge of the input format.

It was also noted that all of the dates in the sample data are now past. For now, the endpoint will always return [] however should the sample data be modified to have ingredient expiry / best before dates in the future this would change. Running find/replace to change 2018 to 2020 produced the following response: ["Ham and Cheese Toastie","Salad","Hotdog"], skipping the "Fry-up" Recipie as there is no entry for "Baked Beans" in the ingredient list (which is required for that recipie).

# Further work
When implementing the Recipie object it was considered that a hasIngredient method may allow O(1) time complexity, should a method be added to ingredient that would display Expired and After Best Before Ingredients. 

It was initially thought that the existing implementation has O(n) time complexity, with n being the largest list of ingredients. Upon further investigation it was noted that array_key_exists sets a numeric key for associative arrays with no value noted. ie. ["Ham","Cheese"] actually is represented as [0 => "Ham", 1 => "Cheese"], creating the need to iterate through both recipies and ingredients. 

array_intersect was used as an alternative to my failed approximation of a hashmap however it is likely that under the hood O(n^2) time complexity would be observed. isset() may be another viable alternative to improving performance in similar situations. Interestingly, JavaScript displays this same quirk when attempting to use an array as a HashMap, as demonstrated in https://github.com/NathanSDunn/eve-online-jump-distance

However, given that the list of ingredients per recipie is small there would not be a noticable difference in runtime performance - the largest real world time costs are handling disk accesses, time to first byte (TTFB) of the endpoint query, and framework overhead.

Although this new approach would be closer to a 'perfect' solution, I hope this 'implementation is sufficient to demonstrate my experience with PHP & Testing as well as my willingness and ability to learn new technologies (Symfony 4 and Docker).

