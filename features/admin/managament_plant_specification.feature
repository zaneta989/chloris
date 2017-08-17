Feature: Managament plants specification
  In order to manage plants specification
  As a admin
  I need to be able to login as admin and click managament

  Scenario: View plants specification
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "Plant Specification"
    Then I should see "Plant Specification"

  Scenario: Add plant specification
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "Plant Specification"
    And I follow "Add PlantSpecification"
    Then I should see "Add Plant Specification"

  Scenario: Doesn't create plant specification
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "Plant Specification"
    And I follow "Add PlantSpecification"
    And I fill in "Name" with "sunflower"
    And I fill in "Frequency" with "1"
    And I fill in "Frequency days" with "2"
    And I fill in "Amount" with "2"
    And I follow "Back to listing"
    Then I should not see the following text in row:
      | Name      | Frequency |
      | sunflower | 1         |

  @database
  Scenario: Add new plant specification - required fields
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "Plant Specification"
    And I follow "Add PlantSpecification"
    And I fill in "Name" with "sunflower"
    And I fill in "Frequency" with "1"
    And I fill in "Frequency days" with "2"
    And I fill in "Amount" with "2"
    And I press "Save changes"
    Then I should see the following text in row:
      | Name      | Frequency |
      | sunflower | 1         |

  @database
  Scenario: Add new plant specification
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "Plant Specification"
    And I follow "Add PlantSpecification"
    And I fill in "Name" with "sunflower"
    And I fill in "Latin name" with "Helianthu"
    And I fill in "Description" with "Pretty and yellow"
    And I fill in "Frequency" with "1"
    And I fill in "Frequency days" with "2"
    And I fill in "Amount" with "0.5"
    And I fill in "Place" with "sunny"
    And I press "Save changes"
    Then I should see the following text in row:
      | Name      | Latin name | Description       | Frequency | Frequency days | Amount | Place | Author |
      | sunflower | Helianthu  | Pretty and yellow | 1         | 2              | 0.5    | sunny | admin  |

  Scenario: Add new plant specification with blank name, frequency, frequency days and amount
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "Plant Specification"
    And I follow "Add PlantSpecification"
    And I fill in "Name" with ""
    And I fill in "Frequency" with ""
    And I fill in "Frequency days" with ""
    And I fill in "Amount" with ""
    And I press "Save changes"
    Then I should see "Please enter a name."
    And I should see "Please enter a frequency."
    And I should see "Please enter a frequency days."
    And I should see "Please enter an amount."

  Scenario: Add new plant specification with too long name
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "Plant Specification"
    And I follow "Add PlantSpecification"
    And I fill in "Name" with "njnjbnjbjbhjbbbbjsb`vhdbeahsdhjdsg`jfgkadyjkgjasgdj`vhgmfhghvdsghfadvhghabadhcbvhvdhsvshdvcdsbdhscbhnjnjbnjbjbhjbbbbjsb`vhdbeahsdhjdsg`jfgkadyjkgjasgdj`vhgfhghvdsghfadvhghabadhcbvhvdhsvshdvcdsbdhscbhhdbeahsdhjdsg`jfgkadyjkgjasgdj`vhgfhghvdsghfadvhghabadhcb"
    And I fill in "Frequency" with "1"
    And I fill in "Frequency days" with "2"
    And I fill in "Amount" with "2"
    And I press "Save changes"
    Then I should see "The name is too long."

  Scenario: Add new plant specification with too long latin name
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "Plant Specification"
    And I follow "Add PlantSpecification"
    And I fill in "Name" with "sunflower"
    And I fill in "Latin name" with "njnjbnjbjbhjbbbbjsb`vhdbeahsdhjdsg`jfgkadyjkgjasgdj`vhgfhghvdsmghfadvhghabadhcbvhvdhsvshdvcdsbdhscbhnjnjbnjbjbhjbbbbjsb`vhdbeahsdhjdsg`jfgkadyjkgjasgdj`vhgfhghvdsghfadvhghabadhcbvhvdhsvshdvcdsbdhscbhhdbeahsdhjdsg`jfgkadyjkgjasgdj`vhgfhghvdsghfadvhghabadhcb"
    And I fill in "Frequency" with "1"
    And I fill in "Frequency days" with "2"
    And I fill in "Amount" with "2"
    And I press "Save changes"
    Then I should see "The latin name is too long."

  Scenario: Add new plant specification with too long description
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "Plant Specification"
    And I follow "Add PlantSpecification"
    And I fill in "Name" with "sunflower"
    And I fill in "Description" with "njnjbnjbjbhjbbbbjsb`vhdbeahsdhjdsg`jfgkadyjkgjasmgdj`vhgfhghvdsghfadvhghabadhcbvhvdhsvshdvcdsbdhscbhnjnjbnjbjbhjbbbbjsb`vhdbeahsdhjdsg`jfgkadyjkgjasgdj`vhgfhghvdsghfadvhghabadhcbvhvdhsvshdvcdsbdhscbhhdbeahsdhjdsg`jfgkadyjkgjasgdj`vhgfhghvdsghfadvhghabadhcb"
    And I fill in "Frequency" with "1"
    And I fill in "Frequency days" with "2"
    And I fill in "Amount" with "2"
    And I press "Save changes"
    Then I should see "The description is too long."

  Scenario: Add new plant specification with too long place
    Given I am authenticated as "admin" using "admin"
    When I follow "Managament"
    And I follow "Plant Specification"
    And I follow "Add PlantSpecification"
    And I fill in "Name" with "sunflower"
    And I fill in "Place" with "njnjbnjbjbhjbbbbjsb`vhdbeahsdhjdsg`jfgkadyjkgjamsgdj`vhgfhghvdsghfadvhghabadhcbvhvdhsvshdvcdsbdhscbhnjnjbnjbjbhjbbbbjsb`vhdbeahsdhjdsg`jfgkadyjkgjasgdj`vhgfhghvdsghfadvhghabadhcbvhvdhsvshdvcdsbdhscbhhdbeahsdhjdsg`jfgkadyjkgjasgdj`vhgfhghvdsghfadvhghabadhcb"
    And I fill in "Frequency" with "1"
    And I fill in "Frequency days" with "2"
    And I fill in "Amount" with "2"
    And I press "Save changes"
    Then I should see "The place is too long."
