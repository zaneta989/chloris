Feature: Manage plant as guest
  In order to manage plant
  As a anonymous
  I need to be able to log in

  Scenario: Adding plant as guest
    When I am on "plant/new"
    Then I should see "Login"
    And the response status code should be 200

  Scenario: Show my plants as guest
    When I am on "plant/all"
    Then I should see "Login"
    And the response status code should be 200

  Scenario: Show plant as guest
    When I am on "plant/123"
    Then I should see "Login"
    And the response status code should be 200

  Scenario: Edit plant as guest
    When I am on "plant/123/edit"
    Then I should see "Login"
    And the response status code should be 200

  Scenario: Watered plant as guest
    When I am on "plant/123/watered"
    Then I should see "Login"
    And the response status code should be 200
