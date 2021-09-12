# Community Hall Booking System

Forked from https://github.com/yasinuddowla/HallBookingSystem

A number of changes/updates have been made to the original. Some problems still remain, and indeed some new issues may have been introduced.🙁

Fixed/changed:

- fixed some HTML errors, including duplicate `id`s (not even sure if the `id`s are needed), and some misuse of `br` tags and non-breaking spaces
- converted from mysqli to PDO using SQLite
- removed inline JavaScript, and rewritten the single jQuery script as vanilla JS
- removed sequence number column on 'view' pages as it seemed to serve no useful purpose and its removal leaves more room for other information
- ID column on 'view' pages now just headed ID to leave more room for other information
- corrected the use of `$_POST` variables to check for form submission
- removed fontawesome
- the view bookings page is now ordered by date within hall
- to make the home page of some use, a button menu has been added together with a simple logo - just because I could.😉
- various other changes

Still to do:

- remove reliance on boostrap and jQuery
- change all `SELECT *` to select only the required fields
- add data sanitisation/validation on inputs
- add a check when adding a booking that the slot is free
- add an 'Are you sure?' confirmation when deleting items
- supply a public-facing bookings view
- ensure the site is fully responsive

One other problem is that there no checks when deleting records that they are used elsewhere (eg. it is possible to delete a hall which still has bookings). This is likely caused by the foreign key constraints not working as expected.

Whilst booking slots can be changed (they have been) there is no way to select multiple slots, and there is no way to add recurring bookings. This may reduce the application of this system, for instance where halls are rented out by the hour and/or for regular events. A crude solution to the former issue might be to make the slots a free-form text field; more work would be required for the latter issue.

The login system is unfinished. As it stands the system doesn't require the user to log in, and worst of all the password is stored as plain text!😲 It works after a fashion but it will need rewriting. Using .htaccess / .htpasswd will work for now, but it will not provide user levels.

The copyright statement seems to be meaningless as the Convention Hall Owners Association doesn't appear to exist, but it has been left in for the heck of it.🤷

_Last modified 2021-09-12_
