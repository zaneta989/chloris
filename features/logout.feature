Feature: Logout
  In order to logout
  As a admin
  I need to be able to click logout link

  Scenario: Logouting user
    Given I am authenticated as "flower_lover" using "flower1234"
    When I follow "Logout"
    Then I should be on "/"
    And I should see "Login"
