# Changelog

## v1.2.0 - 2026-03-29

- Added support for Laravel 12 and Laravel 13
- Added `name`, `webhookUrl`, `webhookEvents` parameters to `createInstance()`
- Added `name` parameter to `updateInstance()`
- Added `getRequestStatus()` for async request tracking
- `updateInstance()` now returns `Instance` instead of `InstanceClientStatus`
- Updated CI test matrix (PHP 8.2–8.5, Laravel 10–13)

## v1.0.3 - 2023-09-11

refactored doc blocks and removed unnecessary debug log

## v1.0.2 - 2023-09-06

Bugfix on empty webhook data

## v1.0.0 Release

Initial package release
