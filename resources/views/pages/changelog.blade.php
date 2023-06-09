@extends('layouts.app', ['activePage' => 'changelog', 'titlePage' => __('Changelog')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Changelog</h4>
            <p class="card-category">List of features and development changes for the system</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">
                @if(session()->get('success'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span><b> Success - </b> {{ session()->get('success') }}</span>
                  </div>
                @endif
                @if(session()->get('error'))
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span><b> Error - </b> {{ session()->get('error') }}</span>
                </div>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="row">
                  <div class="col-sm-12 text-right">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-primary">
                      <i class="material-icons">chevron_left</i>&nbsp;{{ __('Back to Dashboard') }}
                    </a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="content">
                      <h4>Description</h4>
                      <p>
                        WARMS stands for Web Asset Record Management System. It is a system to store up data of webspaces, servers, owners and platforms used by the Pillar System.
                        This system is utilized by the Pillar Web Team to organize the data for reference on all web assets for the Pillar system.
                      </p>
                      <p>
                        The system allows authenticated user to view webspaces and export it on a CSV or Excel (on development) file. This allows an easy
                        reference to the details of the webspaces that the Pillar system is hosting.
                      </p>
                      <p>Users, depending on their system privilege are able to create, read, update and delete (CRUD) details about the owners, departments, designations, platforms and webspaces.
                        They are also able to import batch of webspaces data from a CSV file.
                      </p>
                      <div class="content">
                        <h4>Changelog</h4>
                        <strong>v-1.1.0 Major updates</strong>
                        <ul>
                          <li>Allowed webspaces to include multiple websites</li>
                          <li>Added custom artisan command for migrating current database schema to new schema.</li>
                          <li>Converted all table list to use DataTables, allowed sorting of columns and search.</li>
                          <li>Ability to export records based on webspace, or websites.</li>
                          <li>Ability to indicate the access mode provided for webspace. The default is web access only.</li>
                          <li>Improved history auto-generation.</li>
                          <li>Minor fixes for sorting select items.</li>
                        </ul>
                        <strong>v-1.0.1 Minor updates</strong>
                        <ul>
                          <li>Fixed error in creation and import of webspaces having tilde(~) in URI</li>
                          <li>Updates the dashboard Platforms chart to display platform only without versions</li>
                        </ul>
                        <strong>v-1.0.0 Initial release</strong>
                        <ul>
                          <li>CRUD for Webspace, Owner, Designation, Department and Platform</li>
                          <li>Ability to add history, and media to an existing webspace</li>
                          <li>Dashboard widgets displaying statistics in details and in charts</li>
                          <li>Ability to export webspace data</li>
                          <li>Ability to import webspace from a templated CSV file</li>
                        </ul>
                      </div>
                      <div class="content">
                        <h4>Development</h4>
                        <ul>
                          <li>Ability to add server details and to link webspaces to servers that hosted it</li>
                          <li>Ability to add CHROOT environment and link webspaces to it</li>
                          <li>Ability to export webspaces to Excel file</li>
                          <li>Ability for super-administrator to change settings of the site, eg, main login photo, system color, labels, etc</li>
                          <li>Ability for admin and super administrator to publish announcement, and blogs</li>
                          <li>Ability for super administrator to define and manage user roles and groups</li>
                          <li><strong>PARTIAL</strong>Revisions to add automatically in webspace history</li>
                          <li><strike>Search, filtering and reordering of list per object</strike></li>
                          <li>Create, management of categorization and linking with webspaces [Pillar, Centers, People, Group, Department, Lab]</li>
                          <li><strike>Create a separate entity for websites that is linked to webspaces. A webspace can contain multiple websites.</strike></li>
                          <li>Ability to set reminders for each webspace, and the system to send notification to the admin and owner via email</li>
                          <li>Ability to auto-update the platform used by the websites in a webspace</a>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <nav aria-label="Server pages">
                  <div class="pull-right">
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection