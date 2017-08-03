Feature: Logout
  In order to logout
  As a admin
  I need to be able to click logout link

  Scenario: Logouting user
    When I am on "/login"
    And I fill in "Username" with "flower_lover"
    And I fill in "Password" with "flower1234"
    And I press "Log in"
    And I follow "Logout"
    Then I should be on "/"
    And I should see "Login"