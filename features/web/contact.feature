Feature: Contact
  In order to enter contact
  As a user
  I need to be able to enter contact

  Scenario: Entering contact
    When I am on "/"
    And I follow "Contact"
    Then I should see "admin@gchloris.com"
