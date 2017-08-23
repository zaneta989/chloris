Feature: How to start
  In order to enter about the site
  As a user
  I need to be able to enter how to start

  Scenario: Entering how to start
    When I am on "/"
    And I follow "How to start"
    Then I should see "Then you will not forget about watering any plant!"
