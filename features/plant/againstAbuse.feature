Feature: Management plant, which do not belong to you
  In order to management plant
  As a user
  I need to be able to loggin in

  Scenario: Show plant which does not belong to you
    Given I am authenticated as "test" using "test"
    When I am on "plant/1"
    Then the response status code should be 404

  Scenario: Edit plant which does not belong to you
    Given I am authenticated as "test" using "test"
    When I am on "plant/1/edit"
    Then the response status code should be 404

  Scenario: Watered plant which does not belong to you
    Given I am authenticated as "test" using "test"
    When I am on "plant/1/watered"
    Then the response status code should be 404
