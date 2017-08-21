Feature: Show my plant
  In order to enter my plants
  As a user
  I need to be able to enter My plants

  Scenario: Showing my plants, if you don't have any plants
    Given I am authenticated as "admin" using "admin"
    When I follow "My plants"
    Then I should be on "/my-plants"
    And I should see "You haven't any plants."

  Scenario: Showing my plants, if you have some plants
    Given I am authenticated as "sunflower_lover" using "sunflower1234"
    When I follow "My plants"
    Then I should be on "/my-plants"
    And I should see "My plants"
    And I should see the following text in row:
      | Name        | How many days watered | How many times a day watered | Amount in liters | Is watered |      |
      | Asian basil | 1                     | 1                            | 0.3              | no         | show |

  Scenario: Show details of plant
    Given I am authenticated as "sunflower_lover" using "sunflower1234"
    When I follow "My plants"
    Then I should be on "/my-plants"
    And I click "show" in the "Asian basil" row
    Then I should see "Details of the plant"
    And I should see "Asian basil"