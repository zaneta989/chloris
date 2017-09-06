Feature: Show my plant
  In order to enter my plants
  As a user
  I need to be able to enter My plants

  Scenario: Showing my plants, if you not log in
    When I am on "/my-plants"
    Then I should see "You must be logged in"

  Scenario: Showing my plants, if you don't have any plants
    Given I am authenticated as "test" using "test"
    When I am on "/my-plants"
    Then I should see "You don't have any plants."

  Scenario: Showing my plants, if you have some plants
    Given I am authenticated as "admin" using "admin"
    When I am on "/my-plants"
    And I should see "My plants"
    And I should see the following text in row:
      | Name   | When         | Amount in liters |
      | cactus | every 14 day | 0.5              |

  Scenario: Show details of plant
    Given I am authenticated as "admin" using "admin"
    When I am on "/my-plants"
    And I should see "My plants"
    And I click "show" in the "cactus" row
    Then I should see "Details of the plant"
    And I should see "cactus"
