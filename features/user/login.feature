Feature: Login
  In order to sign in
  As a user
  I need to be able to fill in the data correctly and click Login in

  Scenario: Logging as admin
    When I am on "/login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "admin"
    And I press "Log in"
    Then I should see "Managament"

  Scenario: Logging as users
    When I am on "/login"
    And I fill in "Username" with "flower_lover"
    And I fill in "Password" with "flower1234"
    And I press "Log in"
    Then I should see "Account"

  Scenario: Logging as users with wrong data
    When I am on "/login"
    And I fill in "Username" with "flower_lover"
    And I fill in "Password" with "flower"
    And I press "Log in"
    Then I should see "Invalid credentials."


