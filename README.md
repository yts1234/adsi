# ADSI - Automated Disbursement System Integration

This service is use for automate money withdrawal through every bank account for the online marketplace seller.

## Stack used:
1. PHP
2. Mysql
3. 3rd API Slightly-big FLIP

## Prologue
ADSI is invented to simplify disbursement process for merchant and Ops team. This service leverage Slightly-big Flip API for its 3rd party service. The user only need to input their Bank code, account number, amount to transfer, and the transaction notes. 

## Installation
**Note**: You can run this service on terminal either Windows power shell, Windows CMD, or Linux bash but you need to setup your terminal PATH variable for PHP.
1. Please clone this repository first
`git clone https://github.com/yts1234/adsi`
2. Give your database credential on configuration.php
3. run below code to create database and structure/scheme.
`php db-migrate.php`
It will create database and table structure.
4. Now you can start your first transaction.
### Disbursement
`php disbursement.php disbursement <bank_code> <account_number> <amount> <remark>`
>`php disbursement.php disbursement bni 1234 10000 "Test sample"`

### For checking your transaction status 
`php disbursement.php status <transaction code>` you will get your transaction code from disbursement process
> `php disbursement.php status 123456789`

## Transaction detail.
You can check your local database in **transaction** table, over there you will see the record of your transaction.
