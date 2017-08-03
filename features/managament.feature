Feature: Managament
  In order to manage users
  As a admin
  I need to be able to login as admin and click managament

  Scenario: Managing user
    When I am on "/login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "admin"
    And I press "Log in"
    And I follow "Managament"
    Then I should see "User"