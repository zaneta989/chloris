Feature: Homepage
  In order to enter homepage
  As a user
  I need to be able to enter homepage

  Scenario: Entering homepage
    When I am on "/"
    Then I should see "This is homepage."
