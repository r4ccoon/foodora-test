# foodora-test
##To run the program.
###Main Screen
`> php index.php`

###List the vendors
`> php index.php ls`

###Show a vendor's schedules
`> php index.php show <vendor_id>`

example: 
`> php index.php show 1`

###To run the fix script
`> php index.php fix`

###To run the revert script
`> php index.php revert`

##Solution Description
index.php is a bootstrap script that calls a StateManager class. StateManager class handles the arguments 
from the command lines and route these arguments to the Controller. Controller class will act on what arguments that have been passed.

the namespace App\Model contain mostly the business logic of this application.

###Fix (Fix Up) Solution
As per the test instruction, I need to update the vendor_schedule table with the value from the vendor_special_day table.
Here I created a script to `ALTER TABLE` "temporarily" and add columns necessary to contain the original value for the revert script.
Once the temp columns are created, the script will copy the original value to these columns.  
Once they are all copied, the script will start merging the values from vendor_special_day to the values of the original column.

###Revert (Fix Down) Solution
The revert functionality start by copying back the original value in the temp column to the original columns. Once that done,
the script will just drop the temp columns. And the system is back as the way it is.



