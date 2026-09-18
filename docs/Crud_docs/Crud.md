# School

Request hits GET /admin/schools
        ↓
auth : isAdmin 
        ↓
Route matches → SchoolController@index
        ↓
     schoolService: invludes index method, returns view (bladefile,copmact(the data))
        ↓
Fetch all schools from DB
        ↓
Pass to admin/schools/index.blade.php
        ↓


