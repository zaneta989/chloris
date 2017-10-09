Feature: Watering plant
  In order to water plant
  As a user
  I need to be able to enter watered

  Scenario: Watering plant that should be twice watered - once
    Given I am authenticated as "admin" using "admin"
    When I click "watered" in the "Azalia" row
    Then I should see "The plant was watered today"

  Scenario: Watering plant that should be twice watered - second
    Given I am authenticated as "admin" using "admin"
    When I click "watered" in the "Azalia" row
    Then I should see "The plant was watered today"

  Scenario: Watering plant that should be watered evry x day
    Given I am authenticated as "admin" using "admin"
    When I click "watered" in the "cactus" row
    Then I should see "The plant was watered today"

  Scenario: Watering plant which is already watered
    Given I am authenticated as "admin" using "admin"
    When I click "watered" in the "fern" row
    Then I should see "The plant was enough watered today"