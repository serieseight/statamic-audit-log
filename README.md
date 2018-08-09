# Audit Log

**Log events into a DB.**

This addon logs CP content events that are fired by Statamic into a database as an audit trail.

Audit Log supports the following events:

*Statamic Data Events*
```
AddonSettingsSaved
AssetContainerDeleted
AssetContainerSaved
AssetDeleted
AssetFolderDeleted
AssetFolderSaved
AssetMoved
AssetReplaced
AssetUploaded
CollectionDeleted
CollectionSaved
EntryDeleted
EntrySaved
FieldsetDeleted
FieldsetSaved
FileUploaded
GlobalsDeleted
GlobalsSaved
PageDeleted
PageMoved
PageSaved
PagesMoved
RoleDeleted
RoleSaved
SettingsSaved
SubmissionDeleted
SubmissionSaved
TaxonomyDeleted
TaxonomySaved
TermDeleted
TermSaved
UserDeleted
UserGroupDeleted
UserGroupSaved
UserSaved
```

*Laravel Events*
```
auth.login
auth.logout
```
