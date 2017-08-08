Feature: Managament
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
    And I follow "Home"
    Then I should see "This is homepage."

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
    And I fill in "E-mail address" with "test1@chloris.dev"
    And I fill in "Plain password" with "test1234"
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
    And I fill in "E-mail address" with "test1@chloris.dev"
    And I fill in "Plain password" with "test1234"
    And I press "Save changes"
    Then I should see the following text in row:
      | Username | E-mail address    |
      | test1    | test1@chloris.dev |

  Scenario: Search user
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "User"
    When I fill in "query" with "test@"
    And I press "Search"
    Then I should see the following text in row:
      | Username     | E-mail address        |
      | test         | test@chloris.dev      |

