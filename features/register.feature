Feature: Register
  In order to sign up
  As a user
  I need to be able to fill in the data correctly and click Register

  @database
  Scenario: Registration with correct data
    When I am on "/register"
    And I fill in "Email" with "new_user1@chloris.com"
    And I fill in "Username" with "new_user1"
    And I fill in "Password" with "new_user"
    And I fill in "Repeat password" with "new_user"
    And I press "Register"
    Then I should see "The user has been created successfully."

  Scenario: Registration with wrong password
    When I am on "/register"
    And I fill in "Email" with "new_user@chloris.com"
    And I fill in "Username" with "new_user"
    And I fill in "Password" with "new_user"
    And I fill in "Repeat password" with "new_use"
    And I press "Register"
    Then I should see "The entered passwords don't match."

  Scenario: Registration with wrong username
    When I am on "/register"
    And I fill in "Email" with "new_user@chloris.com"
    And I fill in "Username" with "flower_lover"
    And I fill in "Password" with "new_user"
    And I fill in "Repeat password" with "new_user"
    And I press "Register"
    Then I should see "The username is already used."

  Scenario: Registration with wrong username
    When I am on "/register"
    And I fill in "Email" with "flower_lover@chloris.dev"
    And I fill in "Username" with "new_user"
    And I fill in "Password" with "new_user"
    And I fill in "Repeat password" with "new_user"
    And I press "Register"
    Then I should see "The email is already used."