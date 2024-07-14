# Employer Recruitment

- [Description](#markdown-header-description)
- [Installation](#markdown-header-installation)
- [Configuration](#markdown-header-configuration)
- [Usage](#markdown-header-usage)
- [Specifications](#markdown-header-specifications)

## Description

This is a example module to showcase Magento 2 development experience. It adds Job applications, sent to the Apply
endpoint, to the message queue for processing (see Specifications). Successful Applicants are displayed in Magento's Admin Application page.
- Note: the consumer is very bias.

## Installation

### Type 1: Composer

- Add the Package `composer config repositories.EmployerRecruitment vcs https://github.com/developerdancouk/EmployerRecruitment.git`
- Install the Package `composer require employer/module-recruitment:dev-main`
- Enable Module `bin/magento module:enable Employer_Recruitment`
- Apply Database Updates `bin/magento setup:upgrade`
- Flush the Cache `bin/magento cache:flush`

### Type 2: Zip file

- Unzip to `app/code/Employer/Recruitment`
- Enable Module `bin/magento module:enable Employer_Recruitment`
- Apply Database Updates `bin/magento setup:upgrade`
- Flush the Cache `bin/magento cache:flush`

## Configuration

- Enable Recruitment Module
  - In Magento Admin - Recruitment->Settings->Enable
  - OR Enable with CLI: `bin/magento config:set recruitment/settings/enable 1`
- *** Requires a running message queue *** (see Specifications)

## Usage

- Submit an application
  - POST to API (see specification - API Endpoint)
  - OR Populate with dummy data use CLI command: `bin/magento employer_recruitment:dummy-data`
- Consumer will pick it up and process it
  - Note: if you dont have a running Message Queue, you will need to manually run them:
  - `bin/magento queue:consumers:start recruitment.queue.applications.process --max-messages=%however many applications you made%`
- Applications will be created in Magento's Admin (Employer -> Applications)

## Specifications

- API
    - Endpoint `https://%hostname%/rest/V1/employer-recruitment/apply`
    - Type: POST
    - Expected JSON:
    - ```
      {
          "name" : "Dan",
          "position" : "Dev"
      }
      ```

- Message Queue (Database)
    - Topic: recruitment.queue.applications.process



