# Course-tracker-app

This application shows how laravel in-built events and listeners can be used to build software in a decoupled manner to promote maintainability and scalability.

There is an in-app sql lite database setup for testing.

# Application setup

This application is running on laravel version ^8.69.0, and PHP ^8.0. Kindly ensure that your system meets this specification.

Ensure that your .env file is a replica of the .env.example file and set your database credentials.

The main business logic of this application consists of listeners that listens for events that are dispatched when a user carries out an action on the system like watching a lesson or making a comment. To promote scalability the factory design pattern was used, the listeners call a factory which returns an instance of a class that would handle a specific event action. This would ensure that changes made to the manner in which listeners are to handle events would be handled in specific classes called by the factory.

Repositories are used to handle the interaction between the controller or service and the data layer to promote dependency inversion incase models are changed in future.

Configs are used to represent the kinds of achievements and badges that are present on the system this also promotes scalability and maintainability because badges and achievements can be updated and added in the future without initiating any errors and very minor updates to existing code base.

There are unit and feature tests that exists to ensure that edge cases are covered.

There is a service called AchievementAndBadgeProcessingService used in the AchievementsController to perform relevant computation thereby keeping the controller light.

# Course Tracker App Setup

This application has the following server app setup

Ensure that xampp server is used.

On the command terminal Run composer install

To run migration files run command: php artisan migrate

To run tests on the system run tests: php artisan test
