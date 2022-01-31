# For All Developers:
- Do note violate the camel case naming convention for directories and files.

# For Back-End Developers:

## Design Notes:
- Each plot on the map should be associated with an owner.
- Plots can have no burried individuals.
- Admins should be the only users who have access to owner information.

# For Front-End Developers:

## Design Notes:
- JS and CSS files should be included inside of each module.
- Make sure that your JS and CSS files are named the same name as the php file.


# UI structure:
## Home page:
- includes the top navigation bar with:
    1. A logo of KUC
    2. Navigation to Home, ContactUs, and Controls page
    3. User dropdown with Login if not in session and logout if in session.
        - User dropdown includes update user info and add user
- Includes a carousel with images of the cemetery
- Includes text info about the cemetery, etc. This text can be copied from the
previous group's project.

## Contact Us Page:
- includes the top navigation bar with:
    1. A logo of KUC
    2. Navigation to Home, ContactUs, and Controls page
    3. User dropdown with Login if not in session and logout if in session.
        - User dropdown includes update user info and add user
- Includes information about employees to contact from the cemetery. This can be
copied from the previous group's project

## Controls page:
- includes the top navigation bar with:
    1. A logo of KUC
    2. Navigation to Home, ContactUs, and Controls page
    3. User dropdown with Login if not in session and logout if in session.
        - User dropdown includes update user info and add user
- This page will include navigation cards with a nice design instead of using
regular buttons.
- Cards will include:
    1. Tomb Search
    2. Add Tomb
    3. Columbarium Search
    4. Add Columbarium

## Tomb/Columbarium Search page:
- includes the top navigation bar with:
    1. A logo of KUC
    2. Navigation to Home, ContactUs, and Controls page
    3. User dropdown with Login if not in session and logout if in session.
        - User dropdown includes update user info and add user
- Will include a search bar in the moddle of the page with an attached button
named "Filter"
- Will include cards that have images associated with every saved tomb/columbarium.
- Card will include:
    1. Main image.
    2. Dead Individual's name
    3. Tomb owner's name.
    4. DOB - DOD
    5. View button (green)
    6. Edit Button (blue)

## Tomb/Columbarium page:
- includes the top navigation bar with:
    1. A logo of KUC
    2. Navigation to Home, ContactUs, and Controls page
    3. User dropdown with Login if not in session and logout if in session.
        - User dropdown includes update user info and add user
- This page will include information either from a columbarium or a tomb.
- Info is divided into sections:
    1. Plot Info
    2. Dead Individual Info:
    3. Owner Info:
    4. Plot (if it is a tomb):
    5. Deed ( will have a download button )
    6. Attached images section.
- At the buttom of the page there should be an edit button that can take the
user to the edit page.

## Tomb/Columbarium Edit page:
- includes the top navigation bar with:
    1. A logo of KUC
    2. Navigation to Home, ContactUs, and Controls page
    3. User dropdown with Login if not in session and logout if in session.
        - User dropdown includes update user info and add user
- This page will have all of the data from "Tomb/Columbarium" page populated in
text boxes or appropriate input forms
- Should look fairly similar to the "Tomb/Columbarium" page.
- Attached images section will have an option to either add 
images or delete images." This should be a plus for add and an "x" on top of
preexisting images to delete.
- Plots on the map can be adjusted in this page for tombs.

## Tomb/Columbarium Add page:
- includes the top navigation bar with:
    1. A logo of KUC
    2. Navigation to Home, ContactUs, and Controls page
    3. User dropdown with Login if not in session and logout if in session.
        - User dropdown includes update user info and add user
- This page should include plot info (required) in the top of the page.
- Attach images section should be in the top of the page as well.
- There should be switch button for whether this is an open spot or occupied.
- if switch button is switched to occupied, the rest of the data entry spots can
appear.
- The rest of the data entry spots will include:
    1. Plot Owner (required for tomb and columbarium)
    2. Dead Individual Info section to fill.
    3. Plot map (if it is a tomb)
    4. Add deed section.

## login page:
- Simple login page with username and password
- Something fancy will be nice for UI

## Add user page:
- includes the top navigation bar with:
    1. A logo of KUC
    2. Navigation to Home, ContactUs, and Controls page
    3. User dropdown with Login if not in session and logout if in session.
        - User dropdown includes update user info and add user
- Ask for:
    - Current user password
    - New user's first name
    - New user's last name
    - New user's username
    - New user's password

## Edit Account page:
- includes the top navigation bar with:
    1. A logo of KUC
    2. Navigation to Home, ContactUs, and Controls page
    3. User dropdown with Login if not in session and logout if in session.
        - User dropdown includes update user info and add user
- populate boxes for:
    1. User's first name
    2. User's lastname
    3. User's username
    4. user's current password (if user is updating his/her password)
    5. user's new password.


## DB:
- Please refer to the db folder for the most updated version of the database.

- Admins:
    1. username --> String
    2. Password --> sha1 hash
    3. First name --> String
    4. Last name --> String
- Tomb:
    1. Open --> Boolean (required)
    3. section letter --> String (required)
    4. lot number --> Int (required)
    5. plot number --> Int
    6. longitude --> Decimal
    7. Latitude --> Decimal
    8. Deed --> location in server
    9. Main Image --> location in server
    10. Owner_Id --> Int (required if not open) --> Association
    11. Dead Individual Id --> Int (if not open) --> association
- tomb Images:
    1. Tomb Id
    2. Image
- Columbarium: 
    1. Open --> Boolean (required)
    2. section letter --> String (required)
    3. section number --> Int (required)
    4. Main Image
    5. Owner_Id --> Int (required if not open) --> Association
    6. Dead Individual Id --> Int (if not open) --> association
- Columbarium Images:
    1. Columbarium Id
    2. image
- Owners:
    1. first name --> String (required)
    2. Last Name --> String (required)
    3. purchase date --> yyyy-mm-dd
    4. purchase amount --> Decimal
    5. Address --> long text
    6. Phone number --> Int
    7. Email --> String
Buried Individuals:
    1. first name --> String (required)
    2. Last name --> String (required)
    3. DOB --> yyyy-mm-dd
    4. DOD --> yyyy-mm-dd
    5. Veteran status --> Boolean
    6. Obituary --> Long text

