# UK Equine Sports Medicine
## Clinical Assessment Database Application (Fall 2019)
Produced for CS405G-001 (Final Group Project)
### Group Members:
- Darren Powers
- Michael Probst
- Nicholas Poe
- Jake Hayden

### Database Initialization
To initialize this database, run /equine/utilities/initialize_database.sh to create the database in mysql. Then, run /equine/utilities/upload.sh to upload all files in the project to the /var/www/html/ directory. Anytime a change is made to the website, the upload.sh script can be used to push those changes to the website. Also, to change the ip address to which the website is hosted, change the ip address in the file: /equine/assets/php/redirect_helper.php  

### Outside Resourses:
- Plotly.ly : a JavaScript open source graphing library. We use Plotly to produce graphs displaying pathology data.
- Bootstrap 4 : an open source toolkit for developing with HTML, CSS, and JS. We use Bootstrap to improve the general asthetic of our website.  

### Completed Functionality & Pages
### Current Goals
- Homepage & Login/logout functionality
    - Add clinical data to registration
- Horse Viewer with all assessments
- Edit own assessments (own clinic assessments?)
### Stretch Goals
- User activity logging table
- Admin access to edit pathologies & sites from application
- Limit role management to your own clinic


### Milestone 4 Report:
Approximately 55-65% of final, core functionality present.
- URL: http://172.31.147.164/equine
    - Username: cs405
    - Password: cs405
    - NOTE: Once you log in, you will get a cookie valid for 24 hours. You may log out if you would like to register a new user.
- Complete:
    - Note: these are functionalities and pages that lack only minimal appearance improvements
    - Functionalities:
        - Login
        - Logout
        - Create Horse (Clinical and Racedata)
        - Manage User Role
        - View Horse (Horse data)
    - Pages:
        - Index (login) (from Milestone 3)
- Incomplete:
    - Note: much of the functionality and many of the pages listed here are partially done, but require more than minimal appearance or efficiency improvements prior to submission of the final project.
    - Functionalities
        - View Horse (assessment data)
        - Edit Horse
        - View Assessment
        - Edit Assessment
        - Create Assessment
        - Reporting
    - Pages
        - Home (homepage) (need to split "homepage.php" into other pages)
        - Horse Viewer
        - Assessment Viewer
        - Report Home
        - Report Viewer
### Milestone 3 (URL SUBMISSION)
- http://172.31.147.164/milestone3
