# pillar-webspace
Lists of webspaces hosted in pillar website, that contains its details and contacts

<h4>Version 1.1.0</h4>

<strong>Features</strong>

1. Allowed webspaces to include multiple websites
2. Allowed selection of the main owner of the webspace
3. Added custom artisan command
<pre>
php artisan db:refactor --class=ClassNameOfRefactorClass
</pre>

&emsp;ClassNameOfRefactorClass is a refactor class in database/refactors

&emsp;Add data refactoring migration script inside database/refactors

4. Converted all table list to use DataTables, allowed sorting of columns and search

<strong>Bug Fix</strong>

1. When an edit page loads, the page is focused in center
