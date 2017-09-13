Feature: Add plant to user account
  In order to add plant
  As a user
  I need to be able to enter Add Plant

  @database
  Scenario: Adding plants with required field
    Given I am authenticated as "test" using "test"
    When I am on "plant/new"
    And I fill in "Name" with "flower"
    And I fill in "Frequency" with "4"
    And I fill in "Amount" with "0.25"
    And I press "Add"
    Then I should see "Plant added!"
    And I should see the following text in row:
      | Name   | When        | Amount in liters |
      | flower | every 4 day | 0.25             |

  @database
  Scenario: Adding plants with all field
    Given I am authenticated as "test" using "test"
    When I am on "plant/new"
    And I fill in "Name" with "flower"
    And I fill in "Frequency" with "4"
    And I fill in "Amount" with "0.25"
    And I fill in "Place" with "Window"
    And I fill in "Description" with "Nice a flower"
    And I press "Add"
    Then I should see "Plant added!"
    And I should see the following text in row:
      | Name   | When        | Amount in liters |
      | flower | every 4 day | 0.25             |
    And I click "show" in the "flower" row
    And I should see "Window"
    And I should see "Nice a flower"

  Scenario: Adding plants with blank required field
    Given I am authenticated as "admin" using "admin"
    When I am on "plant/new"
    And I press "Add"
    Then I should see "This value should not be blank."

  Scenario: Adding plants and back to my plants
    Given I am authenticated as "test" using "test"
    When I am on "plant/new"
    And I fill in "Name" with "flower"
    And I fill in "Frequency" with "4"
    And I fill in "Amount" with "0.25"
    And I follow "Back to My Plant"
    Then I should not see the following text in row:
      | Name   | When        | Amount in liters |
      | flower | every 4 day | 0.25             |
