Feature: Add plant to acoount
  In order to add plant to account
  As a user
  I need to be able to enter add

  Scenario: Adding plant, if you log in
    Given I am authenticated as "flower" using "flower1234"
    When I follow "Catalogue of plants"
    Then I should see the following text in row:
      | Name   | Latin name   |      |     |
      | Azalia | Rhododendron | show | add |

  Scenario: Adding plant, if you logout
    Given I am authenticated as "flower" using "flower1234"
    When I follow "Catalogue of plants"
    Then I should not see the following text in row:
      | Name   |     |
      | Azalia | add |