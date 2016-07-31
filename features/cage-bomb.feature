Feature: Cage Bomb
  In order to worship our One True God
  As a user
  I want to retrieve a multiple random pictures of Nicolas Cage - referred to as a 'Cage Bomb'

  Scenario: Get multiple random Cage Pictures using the default amount
    Given I am on "/bomb"
    Then the response code should be 200
    And the response should contain the key "cages"

  Scenario: Get multiple random Cage Pictures using a specific amount
    Given I am on "/bomb/2"
    Then the response code should be 200
    And the response should contain "2" items in "cages"

  Scenario: Get multiple random Cage Pictures using a specific amount
    Given I am on "/bomb/4"
    Then the response code should be 200
    And the response should contain "4" items in "cages"

  Scenario: Get multiple random Cage Pictures over the limit we have set (which is 10 maximum images)
    Given I am on "/bomb/12"
    Then the response code should be 400
    And the response should not contain the key "cages"
    And the response should contain the key "error"
