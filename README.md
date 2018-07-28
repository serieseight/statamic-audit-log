# Audit Log

**Log events into a DB.**

This addon logs CP content events that are fired by Statamic into a database as an audit trail.

## Setup

1) Firstly, copy `AuditLog` into `site/addons/`.

2) Next, in your `.env` file, add the following variables to hook Statamic up to a database:

```
DB_HOST=localhost
DB_DATABASE=database-name
DB_USERNAME=username
DB_PASSWORD=password
```

3) Finally, from the command line run `php please auditlog:migration`, followed by `php please migrate`. You should now see a new `audit_log` table in the configured database.

From this point on, any CP content events that are fired by Statamic will be logged in the database.
