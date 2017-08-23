Feature: User managament
  In order to manage users
  As a admin
  I need to be able to login as admin and click managament

  Scenario: Managing user
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    Then I should see "User"

  Scenario: Back to homepage
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "Go to homepage"
    Then I should see "Web application"

  Scenario: Edit user
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I follow "Edit"
    Then I should see "Edit User"

  @database
  Scenario: Edit user data
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I click "Edit" in the "test@chloris.dev" row
    And I fill in "Username" with "test1"
    And I fill in "Email" with "test1@chloris.dev"
    And I press "Save changes"
    Then I should see the following text in row:
      | Username | E-mail address    |
      | test1    | test1@chloris.dev |

  @database
  Scenario: Edit user role
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I click "Edit" in the "test@chloris.dev" row
    And I select "Administrator" from "Roles"
    And I press "Save changes"
    And I click "Edit" in the "test@chloris.dev" row
    Then the "Administrator" option from "Roles" should be selected

  Scenario: Add user
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I follow "Add User"
    Then I should see "Create User"

  Scenario: Doesn't create user
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I follow "Add User"
    And I fill in "Username" with "test1"
    And I fill in "Email" with "test1@chloris.dev"
    And I fill in "Password" with "test1234"
    And I follow "Back to listing"
    Then I should not see the following text in row:
      | Username | E-mail address    |
      | test1    | test1@chloris.dev |

  @database
  Scenario: Add new user
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I follow "Add User"
    And I fill in "Username" with "test1"
    And I fill in "Email" with "test1@chloris.dev"
    And I fill in "Password" with "test1234"
    And I press "Save changes"
    Then I should see the following text in row:
      | Username | E-mail address    |
      | test1    | test1@chloris.dev |

  Scenario: Don't found user
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    When I fill in "query" with "test@chloris.com"
    And I press "Search"
    Then I should see "No results found."

  Scenario: Search user
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    When I fill in "query" with "test@"
    And I press "Search"
    Then I should see the following text in row:
      | Username     | E-mail address        |
      | test         | test@chloris.dev      |

  Scenario: Add new user with too short password
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I follow "Add User"
    And I fill in "Email" with "new_user@chloris.com"
    And I fill in "Username" with "new_user"
    And I fill in "Password" with "t"
    And I press "Save changes"
    Then I should see "The password is too short."

  Scenario: Add new user with already existing username
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I follow "Add User"
    And I fill in "Email" with "new_user@chloris.com"
    And I fill in "Username" with "flower_lover"
    And I fill in "Password" with "new_user"
    And I press "Save changes"
    Then I should see "The username is already used."

  Scenario: Add new user with too short username
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I follow "Add User"
    And I fill in "Email" with "new_user@chloris.com"
    And I fill in "Username" with "f"
    And I fill in "Password" with "new_user"
    And I press "Save changes"
    Then I should see "The username is too short."

  Scenario: Add new user with too long username
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I follow "Add User"
    And I fill in "Email" with "new_user@chloris.com"
    And I fill in "Username" with "asseocarnisanguineoviscericartilaginonervomedullary"
    And I fill in "Password" with "new_user"
    And I press "Save changes"
    Then I should see "This value is too long. It should have 50 characters or less."

  Scenario: Add new user with already existing email
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I follow "Add User"
    And I fill in "Email" with "flower_lover@chloris.dev"
    And I fill in "Username" with "new_user"
    And I fill in "Password" with "new_user"
    And I press "Save changes"
    Then I should see "The email is already used."

  Scenario: Add new user with too long email
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I follow "Add User"
    And I fill in "Email" with "aasseocarnisanguineoviscericartilaginonervomedullaryaequeosalinocalcalinoceraceoaluminosocupreovitriolicaequdddddeosalinocalcalinoceraceoaluminosocupreovitriolicaequeosal@chloris.dev"
    And I fill in "Username" with "new_user"
    And I fill in "Password" with "new_user"
    And I press "Save changes"
    Then I should see "The email is too long."

  Scenario: Add new user with not valid email
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I follow "Add User"
    And I fill in "Email" with "a@"
    And I fill in "Username" with "new_user"
    And I fill in "Password" with "new_user"
    And I press "Save changes"
    Then I should see "The email is not valid."

  Scenario: Add new user with blank username, email and password
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I follow "Add User"
    And I fill in "Email" with ""
    And I fill in "Username" with ""
    And I fill in "Password" with ""
    And I press "Save changes"
    Then I should see "Please enter a username."
    And I should see "Please enter an email."
    And I should see "Please enter a password."

  Scenario: Edit user with already existing username
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I click "Edit" in the "test@chloris.dev" row
    And I fill in "Email" with "new_user@chloris.com"
    And I fill in "Username" with "flower_lover"
    And I press "Save changes"
    Then I should see "The username is already used."

  Scenario: Edit user with too short username
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I click "Edit" in the "test@chloris.dev" row
    And I fill in "Email" with "new_user@chloris.com"
    And I fill in "Username" with "f"
    And I press "Save changes"
    Then I should see "The username is too short."

  Scenario: Edit user with too long username
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I click "Edit" in the "test@chloris.dev" row
    And I fill in "Email" with "new_user@chloris.com"
    And I fill in "Username" with "asseocarnisanguineoviscericartilaginonervomedullary"
    And I press "Save changes"
    Then I should see "This value is too long. It should have 50 characters or less."

  Scenario: Edit user with already existing email
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I click "Edit" in the "test@chloris.dev" row
    And I fill in "Email" with "flower_lover@chloris.dev"
    And I fill in "Username" with "new_user"
    And I press "Save changes"
    Then I should see "The email is already used."

  Scenario: Edit user with too long email
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I click "Edit" in the "test@chloris.dev" row
    And I fill in "Email" with "asseocarnisanguineoviscericartilaginonervomedullaryaequeosalinocalcalinoceraceoaluminosocupreovitriolicaequdddddeosalinocalcalinoceraceoaluminosocupreovitriolicaequeosal@chloris.dev"
    And I fill in "Username" with "new_user"
    And I press "Save changes"
    Then I should see "The email is too long."

  Scenario: Edit user with not valid email
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I click "Edit" in the "test@chloris.dev" row
    And I fill in "Email" with "a@"
    And I fill in "Username" with "new_user"
    And I press "Save changes"
    Then I should see "The email is not valid."

  Scenario: Edit user with blank username and email
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    And I click "Edit" in the "test@chloris.dev" row
    And I fill in "Email" with ""
    And I fill in "Username" with ""
    And I press "Save changes"
    Then I should see "Please enter a username."
    And I should see "Please enter an email."