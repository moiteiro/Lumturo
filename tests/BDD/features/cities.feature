Feature: Cities Services
  In order to see all features of cities resources
  As a webservice consumer
  I need to be able get response for all URI avaliable

  @javascript
  Scenario: Getting a list of all cities
    Given I am on "/cities"
    Then I should see "iTotalRecords"
    And I should see "iTotalDisplayRecords"
    And I should see "SALVADOR"

  @javascript
  Scenario: Getting a city information passing an ID
    Given I am on "/cities/981"
    Then I should see "iTotalRecords"
    And I should see "iTotalDisplayRecords"
    And I should see "SALVADOR"

