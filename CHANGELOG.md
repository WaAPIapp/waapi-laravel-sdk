# Changelog

## v2.0.0 - 2026-09-04

### Breaking

- Requires PHP 8.2, up from ^8.1.
- Requires `waapi/waapi-php-sdk` 2.0.

### Added

- Typed methods for the remaining 101 client actions. The package named 25 of the API's 122; everything else reached users only through the generic `executeAction()`. The 25 hand-written methods are unchanged.
- `WaAPI::__construct()` takes an optional pre-built SDK as its second argument, so the client can be replaced in tests.
- A test suite that needs no network: 121 tests, 499 assertions.

### Fixed

- The webhook subscription wrappers called three SDK methods that the pinned v1.1.0 did not have, so installing this package produced three methods that fatal on call.
- The test workflow listened on a branch this repository does not have and had therefore never run. It also called `pest`, which this package does not depend on, and a fully passing suite exited non-zero.
- PHPStan ran on PHP 8.1 and could no longer install dependencies.
- `pinMessage()`'s nullable parameter is written `?int` rather than `int|null`.

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
