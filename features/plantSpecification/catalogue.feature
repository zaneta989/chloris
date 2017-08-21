Feature: Catalogue of plants
  In order to enter catalogue
  As a user
  I need to be able to enter catalogue

  Scenario: View catalogue of plants specification
    When I am on "/"
    And I follow "Catalogue of plants"
    Then I should be on "/catalogue"
    And I should see "Catalogue of plants"
    And I should see the following text in row:
      | Name   | Latin name   |      |
      | Azalia | Rhododendron | show |

  Scenario: Show details of plants specification
    When I am on "/catalogue"
    And I click "show" in the "Azalia" row
    Then I should see "Details of the plant"
    And I should see "Azalia"