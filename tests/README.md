# Tests Directory

This directory contains all automated tests for the Simple Task Manager application.

## Directory Structure

```
tests/
├── ExampleTest.php           # Basic setup verification tests
├── Unit/                     # Unit tests for individual components
│   └── Models/
│       └── TaskTest.php      # Task model unit tests
├── Integration/              # Integration tests for component interactions
├── Functional/               # Functional/acceptance tests for complete workflows
└── fixtures/                 # Test data and fixtures
    └── tasks.json           # Test task data
```

## Running Tests

See the main [TESTING.md](../TESTING.md) document for complete testing instructions.

### Quick Commands

```bash
# Run all tests
composer test

# Run specific test suites
./vendor/bin/phpunit tests/Unit/
./vendor/bin/phpunit tests/Integration/
./vendor/bin/phpunit tests/Functional/

# Run with coverage
./vendor/bin/phpunit --coverage-html coverage/
```

## Adding New Tests

- **Unit Tests**: Place in `tests/Unit/` matching the source structure (e.g., `tests/Unit/Models/` for `src/Models/`)
- **Integration Tests**: Place in `tests/Integration/` 
- **Functional Tests**: Place in `tests/Functional/`
- Follow the naming convention: `*Test.php`
- Extend `PHPUnit\Framework\TestCase`
- Use descriptive test method names starting with `test`

## Test Data

Test fixtures are stored in `tests/fixtures/` and should be used for consistent test data across integration and functional tests.