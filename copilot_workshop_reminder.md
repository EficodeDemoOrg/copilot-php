# GitHub Copilot Workshop Quick Reference

This document summarizes the key concepts and best practices from the workshop session. Use it as a handy reminder before starting the hands-on exercises!

## Getting Started with GitHub Copilot

Before you begin, make sure you have:
- An active GitHub Copilot subscription
- VS Code with the GitHub Copilot extension installed
- Signed into your GitHub account in VS Code
- Copilot Chat extension installed (for chat features)
- Familiarized yourself with the different Copilot modes

### Where Can You Use Copilot?
- **VS Code & IDEs**: Code completions, chat, inline editing
- **GitHub.com**: Code suggestions in web editor, PR descriptions, commit messages
- **GitHub CLI**: Command suggestions and explanations
- **GitHub Mobile**: Code review assistance

## Copilot Interaction Modes & Best Practices

### The Three Core Modes
- **Ask Mode**: General questions, explanations, and guidance (e.g., "How does this authentication system work?")
- **Edit Mode**: Direct code modifications and refactoring (e.g., "Convert this function to use async/await")
- **Agent Mode** (`/new`): Creating new files, features, or components (e.g., "/new Create a user registration system")

### Key Interaction Points
- **Chat Participants** (`@workspace`, `@vscode`, `@terminal`)
  - Only one participant per prompt
- **Chat Variables** (`#file`, `#selection`, `#codebase`, `#editor`)
  - Variables can be combined with participants
- **Slash Commands** (`/explain`, `/fix`, `/tests`, `/new`, `/help`)

### Context Optimization Strategies
1. **Be Specific**: Include relevant file paths, function names, and context
2. **Use Examples**: Provide sample inputs/outputs when relevant
3. **Set Constraints**: Specify frameworks, patterns, or style preferences
4. **Iterate**: Build on previous responses with follow-up questions
5. **Combine Tools**: Use multiple variables and references for rich context

**Note:**
- `@workspace` and `#codebase` both provide project-wide context, but `@workspace` is a participant (one per prompt), while `#codebase` is a variable (can be combined).

## Prompt Engineering Best Practices

### The CLEAR Framework
- **C**ontext: Provide relevant background information
- **L**anguage/Framework: Specify the technology stack
- **E**xamples: Include sample inputs or desired outputs
- **A**ction: Be clear about what you want Copilot to do
- **R**equirements: Specify constraints, patterns, or standards

### Examples of Good vs. Poor Prompts
- Poor: "Make this better"
- Good: "Refactor this PHP function to use dependency injection and follow PSR-12 coding standards. The function should validate user input and handle errors gracefully."

- Poor: "Add tests"
- Good: "Generate PHPUnit tests for the TaskController create method. Include tests for valid input, invalid input, and edge cases like duplicate task names."

### Advanced Prompting Techniques
1. **Role-Based Prompting**: "Act as a senior PHP developer reviewing this code for security vulnerabilities..."
2. **Constraint Setting**: "Using only vanilla PHP without external libraries..."
3. **Output Format Specification**: "Provide the response as a numbered list with code examples..."
4. **Iterative Refinement**: "Improve the previous solution by adding error handling..."

## Prerequisites
- VS Code with GitHub Copilot extension installed
- Basic understanding of PHP (helpful but not required)
- GitHub Copilot subscription active
- Curiosity and willingness to experiment!
