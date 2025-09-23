# GitHub Copilot Comprehensive Training Exercises

Welcome to your comprehensive GitHub Copilot training journey! These exercises are designed to progressively learn GitHub Copilot's features starting with foundational concepts and building up to advanced techniques through hands-on practice with our PHP Task Manager project.

## Phase 1: Getting Started with Copilot Basics

### Exercise 1.1: Understanding Your Project with Chat Participants

**Welcome to the PHP Task Manager!** Before diving into code generation, let's use GitHub Copilot to understand the project you'll be working with.

1. **@workspace Participant - Project Overview**
   - Press `Ctrl+Shift+I` (or `Cmd+Shift+I`) to open Copilot Chat and select "Ask" mode
   - Ask: `@workspace Tell me about this project?`
   - Try: `@workspace /explain Give me a comprehensive overview of this PHP task manager application`
   - Request: `@workspace What are the main features and components I should know about?`

2. **@workspace Participant - Code Structure**
   - Ask: `@workspace How are the files and folders organized in this project?`
   - Try: `@workspace Show me all the validation patterns used`
   - Request: `@workspace How are dependencies managed across the codebase?`

3. **@vscode Participant - Development Setup**
   - Ask: `@vscode What extensions would help with PHP development in this project?`
   - Try: `@vscode How do I configure PHP debugging for this project?`
   - Request: `@vscode How to set up tasks for this project?`

4. **@terminal Participant - Running the Project**
   - Ask: `@terminal What's the best way to start a PHP development server for this project?`
   - Try: `@terminal Show me common Composer commands for this project`
   - Request: `@terminal How do I run PHP tests from command line?`

**Learning Goal:** Use different chat participants to get familiar with the project structure, setup, and workflow before starting development.

### Exercise 1.2: First Steps with Code Suggestions

1. **Explore Auto-Suggestions**
   - Open `src/Models/Task.php`
   - Position your cursor after line 50 and press Enter
   - Type `// Method to check if task is overdue` and press Enter
   - Watch Copilot suggest a method implementation
   - Try accepting the suggestion with `Tab`, or cycle through alternatives with `Alt+]` and `Alt+[`

2. **Practice with Comments**
   - Add this comment: `// Calculate the age of this task in days`
   - Let Copilot suggest the implementation
   - Notice how descriptive comments lead to better suggestions

3. **Experiment with Function Names**
   - Start typing `public function formatCreated` and see what Copilot suggests
   - Try `public function isComplete` and observe the different suggestion

**Learning Goal:** Understand how Copilot uses context and comments to generate relevant code suggestions.

### Exercise 1.3: Exploring the Suggestion Interface

1. **Navigation Practice**
   - Open `src/Utils/Validator.php`
   - Add a comment: `// Validate email format using regex`
   - Use `Alt+]` to cycle through different suggestions
   - Use `Ctrl+Enter` to open the suggestions panel for more options

2. **Partial Acceptance**
   - Start typing a function and accept only part of a suggestion using `Ctrl+→`
   - Try modifying the suggestion before accepting it

**Learning Goal:** Master the Copilot interface and keyboard shortcuts.

### Exercise 1.4: Introduction to Copilot Chat

1. **Opening Chat**
   - Press `Ctrl+Shift+I` (or `Cmd+Shift+I`) to open Copilot Chat
   - Select "Ask" mode from the dropdown
   - Open `index.php` in VS Code
   - Ask: "Explain what this file does"

2. **Basic Chat Questions**
   - Ask: "What are the main components of this PHP application?"
   - Try: "How is data persistence handled in this project?"
   - Notice how Copilot provides explanations and guidance

**Learning Goal:** Get comfortable with basic Copilot Chat interactions.

### Exercise 1.5: Understanding Interaction Modes

1. **Ask Mode Practice**
   - In Copilot Chat, ask questions about code without expecting changes
   - Try: "What design patterns are used in this codebase?"
   - Notice how Ask mode provides explanations and guidance

2. **Edit Mode Exploration**  
   - Select a function in `src/Models/Task.php`
   - In chat, switch to Edit mode (if available in your interface)
   - Request: "Add input validation to this method"
   - Observe how Edit mode focuses on direct code changes

3. **Agent Mode with /new**
   - Type: `/new Create a simple PHP utility class for date formatting`
   - Notice how Agent mode creates complete new implementations
   - Try: `/new Generate a configuration class for this project`

**Learning Goal:** Understand when and how to use different Copilot interaction modes.

### Exercise 1.6: Setting Up Project Context with Copilot Instructions

**Why This Matters:** Creating a `copilot-instructions.md` file helps Copilot understand your project's specific patterns, conventions, and architecture, leading to more accurate and relevant suggestions throughout your development session.

1. **Generate Instructions Using VS Code**
   - Look for the **gear icon (⚙️)** in the VS Code interface (usually in the status bar or activity bar)
   - Click on the gear icon and select **"Generate Instructions for Copilot"**
   - VS Code will analyze your codebase and create a `.github/copilot-instructions.md` file
   - Wait for the generation process to complete

2. **Review the Generated Instructions**
   - Open the newly created `.github/copilot-instructions.md` file
   - Read through the generated content to understand what Copilot discovered about your project
   - Notice how it identifies:
     - Project architecture and patterns
     - Key conventions and coding styles
     - Important file structures and relationships
     - Development workflows and commands

3. **Test the Instructions with Copilot**
   - Open Copilot Chat (`Ctrl+Shift+I` or `Cmd+Shift+I`)
   - Ask: "Based on the project instructions, explain the main architecture of this application"
   - Try: "Following this project's patterns, how would I add a new field to the Task model?"
   - Request: "What are the key conventions I should follow when adding a new controller?"
   - Compare the responses to earlier interactions - they should be more specific and aligned with your project

4. **Refine the Instructions (Optional)**
   - If you notice any missing patterns or inaccurate information in the generated instructions
   - Edit the `.github/copilot-instructions.md` file to add project-specific details
   - Consider adding information about:
     - Specific coding conventions you follow
     - Common debugging approaches
     - Testing strategies used in the project

**Learning Goal:** Understand how to leverage VS Code's instruction generation feature to provide Copilot with better project context, resulting in more accurate and relevant code suggestions.

---

## Phase 2: Mastering Chat Commands

### Exercise 2.1: Basic Slash Commands

1. **Understanding Code with `/explain`**
   - Select the `getAllTasks()` method in `src/Services/TaskService.php`
   - Type: `/explain #selection`
   - Try: `/explain How do models interact with controllers?`
   - Compare explanations with different context levels

2. **Code Documentation with `/doc`**
   - Select the `Task` class constructor
   - Type: `/doc #selection`
   - Try: `/doc Generate comprehensive API documentation for this class`

3. **Quick Fixes with `/fix`**
   - Create intentional issues (missing semicolon, wrong variable name)
   - Use: `/fix` to address the issues
   - Try: `/fix Address all PSR-12 compliance issues in this file`

**Learning Goal:** Master basic slash commands for common development tasks.

### Exercise 2.2: Creative Generation with `/new`

1. **Simple Utility Creation**
   - Try: `/new Create a logging utility class for this project`
   - Experiment: `/new Generate a configuration manager that fits this architecture`
   - Advanced: `/new Create a middleware system for request handling`

**Learning Goal:** Learn to use `/new` for generating new code components.

### Exercise 2.3: Creating Project Structure with `/new`

1. **Folder and File Structure Creation**
   - Try: `/new Create a new folder structure for API endpoints with controllers and routes`
   - Experiment: `/new Generate a plugins directory with sample plugin architecture`
   - Advanced: `/new Create a complete testing structure with unit and integration test folders`

2. **Multi-file Component Generation**
   - Request: `/new Create a user management module with model, controller, service, and view files`
   - Try: `/new Generate a reporting system with data processors and output formatters`

**Learning Goal:** Learn to use `/new` for generating complete folder structures and multi-file components.

### Exercise 2.4: Generating Tests with `/tests`

1. **Unit Test Generation**
   - Open `src/Models/Task.php`
   - Select the `setStatus` method
   - In chat: `/tests #selection`
   - Examine the generated test structure

2. **Controller Testing**
   - Select a method from `TaskController.php`
   - Use `/tests` and observe how Copilot handles more complex scenarios
   - Ask follow-up questions like "How would I mock the dependencies?"

3. **Custom Test Scenarios**
   - Ask: "Generate edge case tests for the Task model validation"
   - Request: "Create integration tests for the TaskService class"

**Learning Goal:** Understand how to generate comprehensive tests and testing strategies.

---

## Phase 3: Chat Variables and Context Control

> **💡 Context Setup Guide**  
> 
> **Using #file**: Start typing `#` and begin typing the filename you want to add as context. VS Code will show you a dropdown of available files to choose from. Select the file you want and it will appear as `#file` in your prompt.
> 

### Exercise 3.1: Chat Variables Deep Dive  

1. **File Context Variables**
   - Select `TaskController.php` in Explorer
   - Ask: `Analyze the code structure in #file`
   - Try with different files: `What security issues exist in #file?`

2. **Selection and Editor Variables**
   - Select a method in any PHP file
   - Ask: `Optimize this code #selection for better performance`
   - With cursor in editor: `What's the context around #editor position?`

3. **Codebase Structure Analysis**
   - Ask: `What design patterns are used in #codebase?`
   - Try: `How is error handling implemented across #codebase?`
   - Request: `Show me the data flow in #codebase`

4. **Advanced Variable Combinations**
   - Try: `@workspace #codebase What would be the impact of adding caching?`
   - Experiment: `#file #selection How does this relate to the overall architecture?`

**Learning Goal:** Master chat variables for precise context control and analysis.

---

## Phase 4: Advanced Context and File Analysis

### Exercise 4.1: Working with File Context

1. **File-Based Questions**
   - Open `src/Controllers/TaskController.php`
   - Ask: "What design patterns are used in #file?"
   - Try: "How can I improve error handling in #file?"
   - Request: "Explain the dependency injection pattern in #file"

2. **Cross-File Analysis**
   - Ask: "How does TaskController.php interact with TaskService.php?"
   - Request: "Show me the data flow from TaskController to Task model"

**Learning Goal:** Learn to leverage file context for deeper code understanding.

---

## Phase 5: Practical Development Scenarios

### Exercise 5.1: Feature Development Guidance

1. **Planning New Features**
   - "I want to add task priorities. How should I implement this feature?"
   - "Walk me through adding user authentication to this application"
   - "How would I add task categories without breaking existing functionality?"

2. **Implementation Guidance**
   - Ask: "Show me step-by-step how to add task due dates"
   - Request code examples for each step
   - Ask for migration strategies for existing data

**Learning Goal:** Learn to use Copilot for feature planning and implementation guidance.

### Exercise 5.2: Debugging and Problem Solving

1. **Common Issues**
   - Ask: "What could cause the task creation to fail silently?"
   - Request: "How should I debug JSON storage issues?"

2. **Error Handling Improvements**
   - Ask: "How can I improve error handling throughout this application?"
   - Request: "Show me best practices for logging in PHP applications"

**Learning Goal:** Develop debugging skills with Copilot assistance.

---

## Phase 6: Specialized Agent Interactions

### Exercise 6.1: Security-Focused Reviews

1. **Security Agent Role**
   - "Act as a security expert and review the validation in src/Utils/Validator.php"
   - "As a security specialist, what vulnerabilities do you see in the TaskController?"
   - "From a security perspective, how should I improve the CommentController?"

2. **Security Best Practices**
   - "What OWASP top 10 issues should I check for in this PHP application?"
   - "Provide specific security improvements for user input handling"

**Learning Goal:** Learn to use Copilot for security-focused code reviews.

### Exercise 6.2: Performance and Code Quality

1. **Performance Expert Role**
   - "As a performance expert, analyze the efficiency of TaskService.php"
   - "How can I optimize the data loading in the Controllers?"

2. **Code Quality Reviewer**
   - "Act as a senior PHP developer and review the code quality in src/Models/"
   - "What PSR standards should I implement in this codebase?"

**Learning Goal:** Understand how different expert perspectives can improve your code.

---

## Phase 7: Advanced Context Optimization

### Exercise 7.1: Strategic Context Building

1. **Minimal vs. Maximum Context**
   - Ask the same question with different context levels:
     - Minimal: "How do I add validation?"
     - Medium: "How do I add validation to #file?"  
     - Maximum: "@workspace #codebase How do I add consistent validation across all controllers following the existing patterns?"
   - Compare response quality and relevance

2. **Context Layering Technique**
   - Start broad: "@workspace What's the validation strategy?"
   - Layer specific: "#file How does this controller handle validation?"
   - Drill down: "#selection Improve this validation logic"
   - Notice how each layer builds understanding

3. **Cross-Reference Optimization**
   - Use multiple file references: "Compare validation approaches in TaskController.php vs CommentController.php"
   - Combine selection with file context: "How does #selection relate to patterns in #file?"
   - Mix variables effectively: "#codebase #selection Where else is this pattern used?"

### Exercise 7.2: Context Quality Assessment  
1. **Response Quality Testing**
   - Ask the same question 3 different ways with varying context
   - Rate responses on: accuracy, completeness, actionability
   - Document which context combinations work best for different question types

2. **Context Efficiency**
   - Time how long different context levels take to process
   - Find the sweet spot between comprehensive context and response speed
   - Learn when minimal context is sufficient vs. when maximum context is necessary

**Learning Goal:** Master the art of providing optimal context for different scenarios.

### Exercise 7.3: Leveraging Multiple LLMs for Specialized Tasks

1. **Scenario: Adding Task Priority Feature - A Multi-Model Workflow**
   
   **Step 1: Analysis with oX**
   - Switch to oX model and ask: "Looking at the current task management structure in this PHP project, what would be the architectural implications of adding task priorities? What potential issues should I consider?"
   - Follow up with: "Based on the existing TaskController and Task model, what's the most logical way to integrate priority without breaking current functionality?"
   
   **Step 2: Implementation with Sonnet 4**
   - Switch to Sonnet 4 and say: "Based on the analysis above, generate the code changes needed to add a priority field to the Task model. Include validation and getter/setter methods."
   - Then: "Now generate the corresponding controller changes to handle priority in task creation and updates."
   
   **Step 3: Documentation and Git Summary with GPT-4.1/5-mini**
   - Switch to GPT-4.1/5-mini and request: "Get the current git status and create a summary of what files would be changed for this priority feature."
   - Follow with: "Generate a concise commit message and brief documentation for these priority changes."
   
   **Step 4: Validation Back to oX**
   - Return to oX and ask: "Review the generated code changes. Are there any logical flaws or edge cases I should address before implementing?"

2. **Reflect on the Multi-Model Experience**
   - Compare how each model approached their specialized task
   - Note the differences in reasoning depth, code quality, and task execution efficiency
   - Consider how this workflow could be applied to other feature development scenarios

**Learning Goal:** Master a practical multi-model workflow that leverages each LLM's strengths for analysis, implementation, and project management tasks.

---

## Phase 8: Advanced Prompt Engineering

### Exercise 8.1: Foundational Chat Modes & Prompt Strategies

1. **Explore and Apply Chat Modes According to Their Guides**
    - Open any file in the repo (e.g., `index.php` or `src/Models/Task.php`).
    - Use each chat mode in `.github/chatmodes/` for its intended workflow:
       - **Implement Mode**: Use this mode to execute step-by-step implementation tasks, focusing on direct code changes and practical solutions.
       - **Plan Mode**: Collaborate to transform research or requirements into a clear, actionable implementation plan, breaking work into discrete, reviewable tasks.
       - **Research Mode**: Investigate and gather information relevant to your coding goals, ensuring you have the necessary context before starting implementation.
       - **Translator Mode**: Convert code, comments, or documentation between languages or formats as needed for your project.
       - **InstructionMaker Mode**: Generate precise instructions or repository rules, ensuring clarity and enforceability for all contributors.
    - For each mode, perform a representative task (e.g., implement a feature, create a plan, conduct research, translate a code snippet, or define a rule) and reflect on how the workflow and output differ between modes.

**Learning Goal:** Understand which chat mode is best suited for different coding scenarios and how to leverage custom modes.

### Exercise 8.2: Instructor Chat Mode for Repo Rules

1. **Create and Enforce Repository Rules Using Instructor Chatmode and Prompts**
   - Switch to Instructor chat mode by following the protocol in `InstructionMaker.chatmode.md`.
   - Use the prompt template in `.github/prompts/create-rule.prompt.md` exactly as described to generate a new repository rule (e.g., "All controllers must validate input before processing.").
   - Ensure you follow the step-by-step process in the prompt: define the rule, confirm its clarity, and document it as instructed.
   - Repeat the process for additional rules (e.g., error handling, coding standards), always adhering to the prompt's review and approval steps.
   - Document the finalized rules in a markdown file or as code comments, as specified in the prompt and chatmode guide.

**Learning Goal:** Learn to use Instructor mode and prompt templates to define and enforce repository-wide rules and standards.

### Exercise 8.3: Reusable Prompts

1. **Apply Reusable Prompts According to Their Protocols**
    - Explore the `.github/prompts/` folder and, for each prompt, read its guide to understand its intended workflow and protocol.
       - For implementation tasks, use `implement-prompt.prompt.md` and follow its step-by-step instructions for generating and reviewing code changes.
       - For planning, use `create-plan.prompt.md` and strictly follow its collaborative planning protocol: ingest research, propose strategy, seek approval, break down tasks, and finalize the plan as described.
       - For session summaries, use `summarize-session.prompt.md` and follow its format for capturing key outcomes and next steps.
    - Practice saving and reusing these prompts, always adhering to their review, approval, and output formatting requirements.

2. **Thread Dump Example: Critical Context Handoff**
   - Open `.github/prompts/thread-dump.prompt.md` and review its protocol for context handoff.
   - Simulate a scenario where your chat context is at maximum capacity and you need to hand off work to a new agent instance.
   - Use the prompt to generate a final briefing message that includes:
     - Primary objective of the session
     - Mission log (completed steps, current status)
     - Essential assets (files, data, URLs)
     - Immediate directives (next actions)
     - Constraints & pitfalls (instructions, limitations)
   - Practice formatting your output as a single, precise text message (not a file or code block), following the template in the prompt.
   - Discuss how this protocol ensures seamless continuation of work and why it is important for collaborative or multi-agent workflows.

**Learning Goal:** Develop and apply reusable prompt patterns for common tasks, leveraging provided prompt files for consistency and efficiency.

---

## Phase 9: Creative and Exploratory Exercises

### Exercise 9.1: Code Refactoring Challenges

1. **Refactoring Scenarios**
   - "How would you refactor the TaskController to use dependency injection container?"
   - "Show me how to implement the Repository pattern for data access"

2. **Design Pattern Implementation**
   - "How could I implement the Observer pattern for task status changes?"
   - "Show me how to add a Factory pattern for creating different task types"

**Learning Goal:** Explore advanced programming concepts with Copilot's guidance.

### Exercise 9.2: Alternative Implementations

1. **Different Approaches**
   - "Show me 3 different ways to implement task filtering"
   - "What are alternative approaches to JSON file storage?"

2. **Technology Comparisons**
   - "How would this application look if built with Laravel framework?"
   - "Compare this implementation with a database-driven approach"

**Learning Goal:** Understand different implementation strategies and trade-offs.

### Exercise 9.3: Multi-Thread Task Management with Role-Based Agents

1. **Scenario: Implementing User Authentication - Collaborative Development**
   
   **Setup: Create Two Separate Chat Threads**
   - Open two separate Copilot chat windows/threads for this exercise
   
   **Thread 1: Lead Developer Role**
   - In the first chat, establish the role: "Act as a Lead Developer. You are responsible for architectural decisions, code reviews, and ensuring best practices."
   - Ask: "I need to add user authentication to this PHP task manager. What's the overall architecture and implementation strategy you recommend?"
   - Follow up: "Create a detailed implementation plan with security considerations and database schema changes."
   - Use the planning chatmode and prompts from `.github/chatmodes/Plan.chatmode.md` if available.
   
   **Thread 2: Tester/Implementer Role**
   - In the second chat, establish the role: "Act as a Tester/Implementer. You focus on writing code, creating tests, and ensuring implementation quality."
   - Share the plan from Thread 1 and ask: "Based on this authentication plan, implement the User model and basic login functionality."
   - Request: "Generate comprehensive unit tests for the authentication system."
   - Use implementation chatmode from `.github/chatmodes/Implement.chatmode.md` if available.

2. **Cross-Thread Collaboration**
   - Take the implementation from Thread 2 back to Thread 1 (Lead Developer) for code review
   - Ask the Lead Developer: "Review this authentication implementation. What improvements or security concerns do you see?"
   - Bring the feedback back to Thread 2 (Tester/Implementer) to refine the code
   - Continue this back-and-forth until both roles approve the solution

3. **Leverage Pre-made Agents**
   - Use specialized agents from your chatmodes for specific tasks:
     - Research agent for investigating best practices
     - Security-focused agent for vulnerability assessment
     - Documentation agent for creating user guides

**Learning Goal:** Master collaborative development using multiple chat threads with distinct roles, simulating real-world team dynamics and leveraging specialized agents for comprehensive project management.

---

Happy coding with GitHub Copilot!
