Feature: Register
  In order to sign up
  As a user
  I need to be able to fill in the data correctly and click Register

  @database
  Scenario: Registration with correct data
    When I am on "/register"
    And I fill in "Email" with "new_user1@chloris.dev"
    And I fill in "Username" with "new_user1"
    And I fill in "Password" with "new_user1"
    And I fill in "Repeat password" with "new_user1"
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

  Scenario: Registration with too short password
    When I am on "/register"
    And I fill in "Email" with "new_user@chloris.com"
    And I fill in "Username" with "new_user"
    And I fill in "Password" with "t"
    And I fill in "Repeat password" with "t"
    And I press "Register"
    Then I should see "The password is too short."

  Scenario: Registration with already existing username
    When I am on "/register"
    And I fill in "Email" with "new_user@chloris.com"
    And I fill in "Username" with "flower_lover"
    And I fill in "Password" with "new_user"
    And I fill in "Repeat password" with "new_user"
    And I press "Register"
    Then I should see "The username is already used."

  Scenario: Registration with too short username
    When I am on "/register"
    And I fill in "Email" with "new_user@chloris.com"
    And I fill in "Username" with "f"
    And I fill in "Password" with "new_user"
    And I fill in "Repeat password" with "new_user"
    And I press "Register"
    Then I should see "The username is too short."

  Scenario: Registration with too long username
    When I am on "/register"
    And I fill in "Email" with "new_user@chloris.com"
    And I fill in "Username" with "asseocarnisanguineoviscericartilaginonervomedullary"
    And I fill in "Password" with "new_user"
    And I fill in "Repeat password" with "new_user"
    And I press "Register"
    Then I should see "This value is too long. It should have 50 characters or less."

  Scenario: Registration with already existing email
    When I am on "/register"
    And I fill in "Email" with "flower_lover@chloris.dev"
    And I fill in "Username" with "new_user"
    And I fill in "Password" with "new_user"
    And I fill in "Repeat password" with "new_user"
    And I press "Register"
    Then I should see "The email is already used."

  Scenario: Registration with too long email
    When I am on "/register"
    And I fill in "Email" with "asseocarnisanguineoviscericartilaginonervomedullaryaequeosalinocalcalinoceraceoaluminosocupreovitriolicaequdddddeosalinocalcalinoceraceoaluminosocupreovitriolicaequeosal@chloris.dev"
    And I fill in "Username" with "new_user"
    And I fill in "Password" with "new_user"
    And I fill in "Repeat password" with "new_user"
    And I press "Register"
    Then I should see "The email is too long."

  Scenario: Registration with not valid email
    When I am on "/register"
    And I fill in "Email" with "a@"
    And I fill in "Username" with "new_user"
    And I fill in "Password" with "new_user"
    And I fill in "Repeat password" with "new_user"
    And I press "Register"
    Then I should see "The email is not valid."

  Scenario: Registration with blank username, email and password
    When I am on "/register"
    And I fill in "Email" with ""
    And I fill in "Username" with ""
    And I fill in "Password" with ""
    And I fill in "Repeat password" with ""
    And I press "Register"
    Then I should see "Please enter a username."
    And I should see "Please enter an email."
    And I should see "Please enter a password."