# Community Hall Booking System

Forked from https://github.com/yasinuddowla/HallBookingSystem

A significant number of changes/updates have been made to the original application.

Fixed/changed/added:

- fixed some HTML errors, including duplicate `id`s (not even sure if the `id`s are needed or used), and *some* misuse of `<br>` tags and non-breaking spaces (some `<br>` tags remain)
- converted from mysqli to PDO using SQLite
- removed inline JavaScript, and rewritten the single jQuery script in vanilla JS
- removed sequence number column on the 'view' pages as it seemed to serve no useful purpose and its removal leaves more room for other (useful) information
- removed ID column on most 'view' pages for the same reason as above (it has been left on view managers as the manager id is displayed on the view halls page)
- corrected the use of `$_POST` variables to check for form submission
- removed fontawesome
- the view bookings page is now ordered by date within hall
- to make the home page of some use, a button menu has been added, together with a simple logo
- added an option to list all future bookings; could form the basis of a public-facing page
- added an option to remove all past bookings
- added an option to backup the database
- added an 'Are you sure?' confirmation before deleting items
- the login system has been substantially rewritten; although it could still do with some improvements, it does now require users to log in to use the booking system
- added a field to the booking table for a description of the booking event
- in add booking, if there is only one hall it will not be prompted for but will be inserted automatically
- various other minor changes

Still to do:

- remove reliance on Boostrap and jQuery - probably not really feasible (jQuery seems to be an integral part of Bootstrap)
- change all `SELECT *` statements to select only the required fields, in accordance with best practice
- add a check when adding a booking that the slot is free (?)
- supply a public-facing bookings view (half done) without showing client name

Whilst booking slots can be changed (they have been changed from the original), there is no easy way to select multiple slots, and there is no way to add recurring bookings other that to add each one individually. This may reduce the usefulness of the application for halls that are rented out by the hour and/or for regular events.

The copyright statement seems to be meaningless as the Convention Hall Owners Association doesn't appear to exist any longer; however it has been left in for the heck of it.

A demo is available at https://gandalf458.co.uk/chbs/

## Installation

- install the software into a subfolder ideally named chbs
- run the SQL code from the SQL folder to create, in the main folder (chbs), a database named `chbs.sqlite` and all empty tables; alternatively copy the empty database from the SQL folder into the main chbs folder and rename it `chbs.sqlite`
- in your browser, navigate to the main folder chbs and run register.php and register a new user; it would be as well to delete the script register.php having done so as this could allow anyone to set themselves as a new user
- navigate to the main folder and log in
- first add a manager
- then add a hall
- now you can start adding clients and bookings

*Last modified 2022-08-02*
