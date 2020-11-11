# ICT1004_Project
The objective of the program is to allow users to find clinics and book an appointment.

# Set Up
Project set up steps:
clone project:
git clone https://github.com/bellesim/ICT1004_Project

checkout remote develop branch:
git checkout origin/develop

create and checkout feature branch:
git checkout -b feature/<featurename>

push your feature branch to GitHub:
git push -u origin feature/<featurename>

Basic workflow:
Create and checkout new feature branch
git checkout -b feature/<featurename>

Code and test your feature

Add your changes to the feature branch (best practice to add the files that you modified only)
git add <file name>

Commit your changes
git commit -m “<commit message>”
or
git commit Press enter and type the summary and description for the commit. Then press esc and type :wq

Push your changes to Github
git push

Once the feature is completed, merge it to develop branch:
Checkout develop branch
git checkout develop
Merge your feature branch to develop branch
git merge <featurename>
Delete local feature branch
git branch -d <featurename>
Delete remote feature branch
git push origin --delete <featurename>
Note: Best practice to commit your changes regularly
