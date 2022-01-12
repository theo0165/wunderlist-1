INSERT MANDATORY GIF

# Project Title

Text about the project and why it exists. This would also be a great place to link the project online.

# Installation

Add the installation instructions.

# Code Review

Code review written by [Theo Sandell](https://github.com/theo0165).

1. `AuthUserController.php:16-17` - These fields should be validated as strings.
2. `EditUserController.php:19-22` - Here you could use `request()->store()` for less code and more readability.
3. `EditUserController.php:23` - This could be updated to use Eloquent.
4. `EditUserController.php:40` - This could be updated to use Eloquent.
5. `RegisterUserController.php:32` - Here you could use the "unique" validation rule instead.
6. `RegisterUserController.php:37` - Use redirect instead to move on from the post request.
7. `RegisterUserController.php:47` - Before redirecting you should login the user using `Auth::loginById()` or similar.
8. `TaskController.php:19` - Here you could use `TaskList::all()->get()` instead.
9. `TaskController.php:25` - Always setting `$listId` to `$l['id']`, this if statement won´t work.
10. `TaskController.php:41` - This value should be set in the model by default.
11. `TaskController.php:40-45` - Not validating fields.
12. `TaskController.php:46-50` - Could be refactored to shorthand if.
13. `TaskController.php:57-60` - Could be refactored to shorthand if.
14. `TaskController.php:61-68` - Unsecure, can be used to update other users tasks. You should check if the current user owns the task.
15. `TaskController.php:74` - Unsecure, can be used to delete other users tasks. You should check if the current user owns the task.
16. `TaskController.php:82` - Not validating input.
17. `TaskController.php:83,86` - This could be updated to use Eloquent.
18. `TaskController.php:92` - Fetching all users tasks, not only current user.
19. `TaskController.php:100, 101` - This could be updated to use Eloquent.
20. `TaskController.php:111, 112` - This could be updated to use Eloquent. Not validating inputs.
21. `TaskController.php:121` - This could be updated to use Eloquent.
22. `TaskController.php:122-131` - Here you should get check the deadline in the SQL query.
23. `TaskListController.php:14` - This could be updated to use Eloquent.
24. `TaskListController.php:21` - This value should be set in the model by default.
25. `TaskListController.php:22` - Not validating input.
26. `TaskListController.php:27-33` - Not validating input. Could be used to delete other users lists.
27. `Task.php:27-33` - Empty model?
28. `TaskList.php:27-33` - Empty model?
29. `All models` - Could implement eloquent relations.
30. `2014_10_12_000000_create_users_table.php` - Profile picture not nullable but no default value in model.
31. `2021_12_18_153312_create_tasks_table.php` - `user_id` should not be nullable. A task must belong to a user.
32. `2021_12_18_153324_create_task_lists_table.php` - `user_id` should not be nullable. A list must belong to a user.

# Testers

Tested by the following people:

1. Jane Doe
2. John Doe
