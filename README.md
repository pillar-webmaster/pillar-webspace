# pillar-webspace
Lists of webspaces hosted in pillar website, that contains its details and contacts

<h4>Version 1.1.0</h4>

<strong>Features</strong>

1. Allowed webspaces to include multiple websites

2. Added custom artisan command
<pre>
php artisan db:refactor --class=ClassNameOfRefactorClass
</pre>

&emsp;ClassNameOfRefactorClass is a refactor class in database/refactors

&emsp;Add data refactoring migration script inside database/refactors

3. Converted all table list to use DataTables, allowed sorting of columns and search

4. Ability to export records based on webspace, or websites.

5. Ability to indicate the access mode provided for webspace. The default is web access only.

6. Improved history auto-generation.

<strong>Bug Fix</strong>

1. When an edit page loads, the page is focused in center.

<strong>Update instructions</strong>

1. composer dump-autoload
2. php artisan migrate
