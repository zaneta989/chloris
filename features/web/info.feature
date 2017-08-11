Feature: Information about the site
  In order to enter about the site
  As a user
  I need to be able to enter about the site

  Scenario: Entering about the site
    When I am on "/info"
    Then I should see "Chloris is a web application,"
