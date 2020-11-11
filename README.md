# ICT1004_Project
The objective of the program is to allow users to find clinics and book an appointment.

## Development Guide
### Project set up steps:
1. clone project:  
```git clone hhttps://github.com/bellesim/ICT1004_Project```

2. checkout remote develop branch:  
```git checkout origin/develop```

3. create and checkout feature branch:  
```git checkout -b feature/<featurename>```

4. push your feature branch to GitHub:  
```git push -u origin feature/<featurename>```

### Basic workflow:
1. Create and checkout new feature branch  
```git checkout -b feature/<featurename>```

2. Code and test your feature  

3. Add your changes to the feature branch (best practice to add the files that you modified only)  
```git add <file name>```

4. Commit your changes  
```git commit -m “<commit message>”```  
or  
```git commit``` Press enter and type the summary and description for the commit. Then press esc and type :wq  

5. Push your changes to Github  
```git push```

### Once the feature is completed, merge it to develop branch:  
1. Checkout develop branch  
```git checkout develop```  
2. Merge your feature branch to develop branch  
```git merge <featurename>```  
3. Delete local feature branch   
```git branch -d <featurename>```  
4. Delete remote feature branch  
```git push origin --delete <featurename>```  

**Note: Best practice to commit your changes regularly**
