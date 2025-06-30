# AI Agent Development Guidelines

This document provides guidelines for AI coding agents working on this project. Please adhere to these rules to ensure code quality, consistency, and stability.

## General Rules

- Before starting any task, make sure you understand the requirements completely.
- After finishing a task, review your changes and ensure they align with the project's standards.
- Keep your communication clear and concise.

## Backend Development (Laravel)

### 1. API Endpoints and Tests

- **Mandatory Testing:** For every new API endpoint you create, it is **mandatory** to write a corresponding feature or unit test.
- The goal is to ensure that every part of the API is tested and works as expected.

### 2. Running Tests

- At the end of any development task (e.g., adding a feature, fixing a bug), you **must** run the entire test suite to ensure your changes haven't broken existing functionality.
- Use the following command from the `backend` directory:
  ```bash
  php artisan test
  ```

### 3. Routing

- Whenever you add or modify a route in `routes/api.php` or `routes/web.php`, you must regenerate the route cache and check for conflicts or errors.
- Use the following command from the `backend` directory to check the routes:
  ```bash
  php artisan route:list
  ```
- After confirming there are no issues, you can clear the cache for production, but `route:list` is sufficient for development checks.
  ```bash
  php artisan route:cache
  ```

## Frontend Development (React)

### 1. Linting

- To ensure code quality and consistency, run the linter before committing your changes. This helps to find and fix problems in the code automatically.
- Use the following command from the `frontend` directory:
  ```bash
  npm run lint
  ```
- Fix any errors or warnings that the linter reports.

### 2. Testing

- Run the automated test suite to ensure your changes haven't broken existing functionality.
- To run tests once (e.g., for CI/CD or final checks), use:
  ```bash
  npm test
  ```

## Workflow Summary

1.  **Implement Feature/Fix:** Write the necessary code for the backend and/or frontend.
2.  **Write Backend Tests:** If you added a new API endpoint, create tests for it.
3.  **Check Routes:** If you changed routes, run `php artisan route:list`.
4.  **Run All Backend Tests:** Execute `php artisan test`.
5.  **Run Frontend Linting:** Execute `npm run lint`.
6.  **Run All Frontend Tests:** Execute `npm test`.
7.  **Commit:** Once all checks pass, commit your changes.

By following these guidelines, you contribute to a more stable and reliable codebase.
