# Simple Task Manager - Testing Strategy & Plan

**Author:** GitHub Copilot  
**Date:** 2024-09-19  
**Version:** 1.0

## 1. Purpose 🎯

**Goal:** This document outlines the testing strategy for the Simple Task Manager PHP application to ensure application stability, prevent regressions, and verify that new features meet requirements. Our commitment to quality includes comprehensive testing of all core functionality including task management, commenting system, tagging features, and data persistence through JSON storage.

## 2. Scope of Testing

### In Scope:
- **Task Management Core Features**
  - Task creation, editing, deletion
  - Task status transitions (To Do → In Progress → Done)
  - Task validation and data integrity
- **Comment System**
  - Adding comments to tasks
  - Comment storage and retrieval
  - Comment validation
- **Tagging System**
  - Tag creation and management
  - Task-tag associations
  - Tag filtering and search
- **Data Storage & Persistence**
  - JSON file storage operations
  - Data integrity and file locking
  - Error handling for storage operations
- **Security Features**
  - Input validation and sanitization
  - CSRF protection
  - XSS prevention
- **User Interface Components**
  - Task filtering and display
  - Form submissions and validations
  - JavaScript interactions

### Out of Scope:
- **Third-party Dependencies**
  - PHPDotEnv library functionality (we only test our usage of it)
  - PHP built-in functions and extensions
- **Web Server Configuration**
  - Apache/Nginx specific configurations
  - PHP runtime environment setup
- **Browser Compatibility Testing**
  - Cross-browser JavaScript compatibility (documented as supported: Chrome 60+, Firefox 55+, Safari 12+, Edge 79+)

## 3. Types of Testing

### Unit Tests:
- **Purpose:** To test individual functions, methods, and components in isolation
- **Tools:** PHPUnit 9.5
- **Location:** `tests/Unit/`
- **Coverage Includes:**
  - Model classes (Task, Comment, Tag)
  - Service layer methods (TaskService, CommentService, TagService)
  - Utility classes (Validator, Security)
  - Storage layer operations (JsonStorage, CommentStorage)

### Integration Tests:
- **Purpose:** To test how multiple components work together and data flows between layers
- **Tools:** PHPUnit with test data files
- **Location:** `tests/Integration/`
- **Coverage Includes:**
  - Controller-Service-Storage interactions
  - Model relationships and dependencies
  - End-to-end data persistence workflows
  - Configuration loading and environment setup

### Functional/Acceptance Tests:
- **Purpose:** To test complete user workflows and business logic from the user's perspective
- **Tools:** PHPUnit with HTTP testing capabilities
- **Location:** `tests/Functional/`
- **Coverage Includes:**
  - Complete task management workflows
  - Comment creation and display
  - Tag management and filtering
  - Error handling and user feedback

### Manual QA Testing:
- **Purpose:** To manually verify complex user workflows, check user experience, and perform exploratory testing
- **Process:** Manual testing checklist covering all user-facing features before releases
- **Focus Areas:**
  - User interface responsiveness
  - Error message clarity
  - Edge cases and boundary conditions
  - Performance under load

## 4. Tools & Environment 🛠️

### Testing Frameworks:
- **PHPUnit 9.5** - Primary testing framework for unit, integration, and functional tests
- **Composer** - Dependency management and test script execution

### Development Tools:
- **PHP 7.4+** - Minimum runtime requirement
- **JSON** - Data storage format for test fixtures
- **Built-in PHP Server** - Local development and testing environment

### Bug Tracking:
- **GitHub Issues** - Bug reporting and tracking
- **GitHub Pull Requests** - Code review and change management

### CI/CD (Automation):
- **GitHub Actions** - Automated test execution (when configured)
- **Composer Scripts** - Local test execution automation

### Test Environment:
Tests are run against isolated test data files to ensure reproducible results:
- Test database: Separate JSON files in `tests/fixtures/` directory
- Environment: Test-specific configuration with `APP_ENV=testing`
- Data Reset: Test data is reset before each test run
- File Permissions: Tests verify proper file access and locking mechanisms

## 5. Test Execution & Automation ⚙️

### When are tests run?
- **On Every Commit:** Unit and integration tests should be run via GitHub Actions on every push
- **Before Deployment:** Complete test suite including functional tests
- **During Development:** Developers run tests locally before committing changes
- **Nightly Builds:** Full regression testing with performance benchmarks

### How to run tests locally?

#### Install Dependencies:
```bash
# Install project dependencies
composer install
```

#### Run All Tests:
```bash
# Run all unit and integration tests
composer test

# Run PHPUnit directly with verbose output
./vendor/bin/phpunit --verbose

# Run tests with coverage report
./vendor/bin/phpunit --coverage-html coverage/
```

#### Run Specific Test Categories:
```bash
# Run only unit tests
./vendor/bin/phpunit tests/Unit/

# Run only integration tests  
./vendor/bin/phpunit tests/Integration/

# Run only functional tests
./vendor/bin/phpunit tests/Functional/

# Run specific test file
./vendor/bin/phpunit tests/Unit/Models/TaskTest.php
```

#### Development Server for Testing:
```bash
# Start development server for manual testing
composer serve
# Application available at http://localhost:8000
```

## 6. Bug & Defect Management 🐞

### Discovery:
Bugs are identified through:
- **Failed Automated Tests:** CI/CD pipeline failures or local test failures
- **Manual QA Testing:** Issues found during exploratory testing
- **User Reports:** Issues reported through GitHub Issues
- **Code Review:** Problems identified during pull request reviews

### Reporting:
1. **Create GitHub Issue** with clear title following format: `[Bug] Component: Brief Description`
2. **Include Required Information:**
   - Steps to reproduce the issue
   - Expected vs. actual behavior
   - Environment details (PHP version, OS)
   - Relevant error messages or logs
   - Screenshots if UI-related

### Prioritization:
Issues are prioritized using GitHub labels:
- **Critical:** Data loss, security vulnerabilities, application crashes
- **High:** Major feature broken, significant user impact
- **Medium:** Minor feature issues, UI problems
- **Low:** Cosmetic issues, enhancement requests

### Assignment & Resolution:
1. **Triage:** Product Owner or Team Lead assigns priority and developer
2. **Development:** 
   - Developer reproduces the issue
   - Implements fix with corresponding test case
   - Ensures no regression in existing functionality
3. **Verification:**
   - Code review by team member
   - Automated test validation
   - Manual verification if required
4. **Closure:** Issue marked as resolved with reference to fixing commit/PR

### Test Coverage Requirements:
- **New Bugs:** Must include test case that would have caught the bug
- **Regression Prevention:** All bug fixes require corresponding test
- **Documentation:** Update relevant documentation if bug reveals gaps

### Quality Gates:
- All tests must pass before merging to main branch
- Code coverage should not decrease with new changes
- Critical bugs require immediate hotfix process
- Security vulnerabilities follow responsible disclosure timeline

---

*This testing strategy is a living document and should be updated as the project evolves and new testing requirements emerge.*