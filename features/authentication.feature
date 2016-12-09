Feature: Member
    In order to give customers teh ability to post enquiries and make deposits
    As an administrator
    I need authentication and registration for customers

    Scenario: Registration
        When I register "john@doe.com"
        Then I should have an account
