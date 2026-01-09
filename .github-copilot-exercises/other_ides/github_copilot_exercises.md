# GitHub Copilot Comprehensive Training Exercises

Welcome to your comprehensive GitHub Copilot training journey! These exercises are designed to progressively learn GitHub Copilot's features starting with foundational concepts and building up to advanced techniques through hands-on practice with our PHP task management project.

## Phase 1: Getting Started with Copilot Basics

### Exercise 1.1: Understanding Your Project with Chat Participants

**Welcome to the PHP project!** Before diving into code generation, let's use GitHub Copilot to understand the PHP task management project you'll be working with.

1. **@project Participant - Project Overview**
   - Open Copilot Chat and select "Ask" mode
   - Ask: `@project Tell me about this PHP project?`
   - Try: `@project /explain Give me a comprehensive overview of this task management application`
   - Request: `@project What are the main features and components I should know about?`

2. **@project Participant - Code Structure**
   - Ask: `@project How are the files and folders organized in this project?`
   - Try: `@project Show me all the validation patterns used in the codebase`
   - Request: `@project How are dependencies managed with Composer?`

**Learning Goal:** Use chat participant to get familiar with the project structure, setup, and workflow before starting development.

### Exercise 1.2: First Steps with Code Suggestions

1. **Explore Auto-Suggestions**
   - Open `src/Models/Task.php`
   - Position your cursor after the last method and press Enter
   - Type `// Method to check if task is overdue` and press Enter
   - Watch Copilot suggest a method implementation
   - Try accepting the suggestion with `Tab`.

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
   - Add a comment: `// Validate email format using PHP regex`
   - Hover mouse over the suggestion to see alternative suggestions
   - Press `tab` to accept a suggestion
   - If no suggestions appear, try different comments or method names

2. **Partial Acceptance**
   - Start typing a function and accept only part of a suggestion using `Ctrl+→` or `Cmd+→`
   - Try modifying the suggestion before accepting it

**Learning Goal:** Master the Copilot interface and keyboard shortcuts.

### Exercise 1.4: Introduction to Copilot Chat

1. **Opening Chat**
   - Open Copilot Chat
   - Select "Ask" mode from the dropdown
   - Open `index.php` in VS Code
   - Ask: "Explain what this file does"

2. **Basic Chat Questions**
   - Ask: "What are the main components of this application?"
   - Try: "How is data persistence handled in this project?"
   - Notice how Copilot provides explanations and guidance

**Learning Goal:** Get comfortable with basic Copilot Chat interactions for development.

### Exercise 1.5: Understanding Interaction Modes

1. **Ask Mode Practice**
   - In Copilot Chat, ask questions about code without expecting changes
   - Try: "What design patterns are used in this codebase?"
   - Notice how Ask mode provides explanations and guidance

2. **Edit Mode Exploration**  
   - Open Copilot Chat in Edit mode
   - Provide file `src/Models/Task.php` as context
   - Request: `Add input validation to the setStatus method in Task.php`
   - Observe how Edit mode focuses on direct code changes

   - Alternatively, you can open the file, select the `setStatus` method, open inline chat and use `Add input validation to this method`.

3. **Agent Mode with new files**
   - Open Copilot Chat in Agent mode
   - Type: `@project Create a simple PHP utility class for date formatting`
   - Notice how Agent mode creates complete new implementations

**Learning Goal:** Understand when and how to use different Copilot interaction modes for development.

### Exercise 1.6: Setting Up Project Context with Copilot Instructions

**Why This Matters:** Creating a `copilot-instructions.md` file helps Copilot understand your PHP project's specific patterns, conventions, and architecture, leading to more accurate and relevant suggestions throughout your development session.

1. **Generate Instructions Using VS Code**
   - Create the `.github` folder if it doesn't exist
   - Open Copilot Chat in Agent mode
   - Add your project's README.md and main PHP configuration files as context
   - Request: `@project Based on the PHP project structure and README, create a comprehensive copilot-instructions.md file that defines our PHP coding standards, architectural patterns, and development practices`

2. **Review the Generated Instructions**
   - Open the newly created `.github/copilot-instructions.md` file
   - Read through the generated content to understand what Copilot discovered about your project
   - Notice how it identifies:
     - Project architecture and patterns
     - Key conventions and coding styles
     - Important file structures and relationships
     - Development workflows and Composer commands

3. **Test the Instructions with Copilot**
   - Open Copilot Chat
   - Ask: "Based on the project instructions, explain the main architecture of this application"
   - Try: "Following this project's patterns, how would I add a new field to the Task model?"
   - Request: "What are the key PHP conventions I should follow when adding a new controller?"
   - Compare the responses to earlier interactions - they should be more specific and aligned with your PHP project

4. **Refine the Instructions (Optional)**
   - If you notice any missing patterns or inaccurate information in the generated instructions
   - Edit the `.github/copilot-instructions.md` file to add PHP-specific details
   - Consider adding information about:
     - Specific PHP coding conventions you follow (PSR standards)
     - Common debugging approaches for PHP
     - PHPUnit testing strategies used in the project

**Learning Goal:** Understand how to leverage VS Code's instruction generation feature to provide Copilot with better PHP project context, resulting in more accurate and relevant code suggestions.

---

## Phase 2: Mastering Chat Commands

### Exercise 2.1: Basic Slash Commands

1. **Understanding Code with `/explain`**
   - Select the `getAllTasks()` method in `src/Services/TaskService.php`
   - Open inline chat
   - Type: `/explain`
   - Try: `/explain How do models interact with controllers?`
   - Compare explanations with different context levels

2. **Code Documentation with `/doc`**
   - Select the `Task` class constructor in `src/Models/Task.php`
   - Open inline chat
   - Type: `/doc`
   - Try: `/doc Generate comprehensive PHPDoc documentation for this class`

3. **Quick Fixes with `/fix`**
   - Create intentional issues (missing semicolon, wrong PHP variable name)
   - Use: `/fix` to address the issues
   - Try: `/fix Address all PSR-12 compliance issues in this PHP file`

**Learning Goal:** Master basic slash commands for common development tasks.

### Exercise 2.2: Creative Generation

1. **Simple Utility Creation**
   - Open Copilot Chat in Agent mode
   - Try: `Create a logging utility class for this project`
   - Experiment: `Generate a configuration manager that fits this architecture`
   - Advanced: `Create a middleware system for request handling`

**Learning Goal:** Learn to use agent mode for generating new code components.

### Exercise 2.3: Creating Project Structure

1. **Folder and File Structure Creation**
   - Open Copilot Chat in Agent mode
   - Try: `@project Create a new folder structure for API endpoints with PHP controllers and routes`
   - Experiment: `@project Generate a plugins directory with sample PHP plugin architecture`  
   - Advanced: `@project Create a complete testing structure with PHPUnit unit and integration test folders`

2. **Multi-file Component Generation**
   - Request: `@project Create a user management module with model, controller, service, and view files`
   - Try: `@project Generate a reporting system with data processors and output formatters`

**Learning Goal:** Learn to use agent mode for generating complete folder structures and multi-file components.

### Exercise 2.4: Generating Tests with `/tests`

1. **Unit Test Generation**
   - Open `src/Models/Task.php`
   - Select the `setStatus` method
   - Open inline chat
   - In chat: `/tests`
   - Examine the generated PHPUnit test structure

2. **Controller Testing**
   - Select a method from `src/Controllers/TaskController.php`
   - Use `/tests` and observe how Copilot handles more complex scenarios
   - Ask follow-up questions like "How would I mock the dependencies?"

3. **Custom Test Scenarios**
   - Ask: `Generate edge case PHPUnit tests for the Task model validation`
   - Request: `Create integration tests for the TaskService class`

**Learning Goal:** Understand how to generate comprehensive PHPUnit tests and testing strategies.

---

## Phase 3: Chat Variables and Context Control

> **💡 Context Setup Guide**  
> 
> **Using #file**: Start typing `#` and begin typing the filename you want to add as context.
> 
> **Using #get_errors**: Type `#get_errors` to identify any compile or lint errors in the current file.
> 
> **Using #get_terminal_output**: Type `#get_terminal_output` to include the visible output from your terminal window.
> 
> **Drag and Drop**: You can also drag files directly from the Explorer view into the chat window to add them as context.
> 

### Exercise 3.1: File referencing with chat variables

1. **File Context Variables**
   - Select `src/Controllers/TaskController.php` in Explorer
   - Ask: `Analyze the code structure in #file`
   - Try with different files: `What security issues exist in #file?`

2. **Selection and Editor Variables**
   - Select a method in any PHP file
   - Open inline chat
   - Ask: `Optimize this code for better performance`

3. **Multiple file Contexts**
   - Compare validation approaches in TaskController.php vs CommentController.php
   - Request: `How does the validation logic in #file differ from #file?`
   - Note: You can also drag and drop files directly into chat

4. **Error Context Variables**
   - Use `#get_errors` to reference all errors in your file
   - Open a file with errors in VS Code
   - Ask: `#get_errors Explain these errors and how to fix them`
   - This automatically includes error messages from your Problems panel

5. **Terminal Output Variables**
   - Use `#get_terminal_output` to reference the output from your terminal
   - After running a command, ask: `#get_terminal_output What does this output mean?`
   - Try: `#get_terminal_output Are there any warnings I should address?`
   - This captures the visible terminal content for analysis

6. **Advanced Context Combinations**
   - Try: `@project What would be the impact of adding caching to #file:TaskService.php?`
   - Combine multiple contexts: `#file:TaskController.php #file:TaskService.php How do these classes interact?`
   - Mix error and file context: `#get_errors #file:TaskController.php Are these errors related to this file?`
   - Mix terminal output and project context: `#get_terminal_output @project Why is this PHP command failing?`

**Learning Goal:** Master chat variables for precise context control and analysis in development.

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
   - Request: "Show me the data flow from TaskController to Task model in PHP"

**Learning Goal:** Learn to leverage file context for deeper code understanding.

---

## Phase 5: Practical Development Scenarios

### Exercise 5.1: Feature Development Guidance

1. **Planning New Features**
   - Open Copilot Chat in Ask mode
   - `I want to add task priorities to this PHP application. How should I implement this feature?`
   - `Walk me through adding user authentication to this PHP application`
   - `How would I add task categories without breaking existing functionality?`

2. **Implementation Guidance**
   - Ask: `Show me step-by-step how to add task due dates to the models`
   - Request code examples for each step
   - Ask for migration strategies for existing JSON data

**Learning Goal:** Learn to use Copilot for feature planning and implementation guidance.

### Exercise 5.2: Debugging and Problem Solving

1. **Common Issues**
   - Open Copilot Chat in Ask mode
   - Ask: `What could cause task creation to fail silently?`
   - Request: `How should I debug JSON storage issues?`

2. **Debugging Terminal Output**
   - After running a failing command, ask: `#get_terminal_output Why did this command fail?`
   - Try: `#get_terminal_output How do I fix this PHP error?`
   - Request: `#get_terminal_output What does this error stack trace tell us?`

3. **Error Handling Improvements**
   - Ask: `How can I improve error handling throughout this application?`
   - Request: `Show me best practices for logging in PHP applications`

**Learning Goal:** Develop debugging skills with Copilot assistance and leverage context-aware error analysis.

---

## Phase 6: Specialized Agent Interactions

### Exercise 6.1: Security-Focused Reviews

1. **Security Agent Role**
   - Open Copilot Chat
   - `Act as a security expert and review the validation in src/Utils/Validator.php`
   - `As a security specialist, what vulnerabilities do you see in the PHP TaskController?`
   - `From a security perspective, how should I improve the PHP CommentController?`

2. **Security Best Practices**
   - `What OWASP top 10 issues should I check for in this application?`
   - `Provide specific security improvements for user input handling`

**Learning Goal:** Learn to use Copilot for security-focused code reviews.

### Exercise 6.2: Performance and Code Quality

1. **Performance Expert Role**
   - Open Copilot Chat
   - `As a performance expert, analyze the efficiency of TaskService.php`
   - `How can I optimize the data loading in the Controllers?`

2. **Code Quality Reviewer**
   - `Act as a senior developer and review the code quality in the models directory`
   - `What coding standards and best practices should I implement in this codebase?`

**Learning Goal:** Understand how different expert perspectives can improve your code.

### Exercise 6.3: Code Review Workflow

1. **Setting Up for Code Review**
   - Open a PHP file you want to review (e.g., `src/Controllers/TaskController.php`)
   - Add it as context to Copilot Chat
   - Ask: `Act as a code reviewer and analyze this file for quality, performance, and best practices`

2. **Conducting the Review**
   - Request specific feedback: `What potential bugs or edge cases exist in this code?`
   - Ask: `Are there any design pattern violations or anti-patterns here?`
   - Try: `How does this code compare to PHP best practices and PSR standards?`
   - Request: `What security vulnerabilities should I address?`

3. **Implementing Feedback**
   - Switch to Edit mode in Copilot Chat
   - Provide the original file and the review feedback
   - Request: `Based on the code review feedback, implement the recommended improvements`
   - Review the changes and accept them into your workflow

**Learning Goal:** Develop a structured code review process using Copilot to catch issues and improve code quality before committing.

---

## Phase 7: Advanced Context Optimization

### Exercise 7.1: Strategic Context Building

> **For JetBrains IDE users:** The `@project` command is replaced by `@project`. #selection is not supported.
> Instead, open the file, select the method you want to analyze, open inline chat and use your prompt.

1. **Minimal vs. Maximum Context**
   - Ask the same question with different context levels:
     - Minimal: `How do I add validation?`
     - Medium: `How do I add validation to #file?`
     - Maximum: `@project How do I add consistent validation across all controllers following the existing patterns?`
   - Compare response quality and relevance

2. **Context Layering Technique**
   - Start broad: `@project What's the validation strategy in this project?`
   - Layer specific: `#file How does this controller handle validation?`
   - Notice how each layer builds understanding

3. **Cross-Reference Optimization**
   - Use multiple file references: `Compare validation approaches in TaskController.php vs CommentController.php`
   - Combine selection with file context: `How does #selection relate to patterns in #file?`
   - Mix variables effectively: `#codebase #selection Where else is this pattern used?`

### Exercise 7.2: Context Quality Assessment  
1. **Response Quality Testing**
   - Ask the same question 3 different ways with varying context
   - Rate responses on: accuracy, completeness, actionability
   - Document which context combinations work best for different question types

2. **Context Efficiency**
   - Time how long different context levels take to process
   - Find the sweet spot between comprehensive context and response speed
   - Learn when minimal context is sufficient vs. when maximum context is necessary

**Learning Goal:** Master the art of providing optimal context for different development scenarios.

### Exercise 7.3: Leveraging Multiple LLMs for Specialized Tasks

1. **Scenario: Adding Task Priority Feature - A Multi-Model Workflow**
   
   **Step 1: Analysis with oX**
   - Switch to oX model and ask: `Looking at the current task management structure in this project, what would be the architectural implications of adding task priorities? What potential issues should I consider?`
   - Follow up with: `Based on the existing TaskController and Task model, what's the most logical way to integrate priority without breaking current functionality?`

   **Step 2: Implementation with Sonnet 4**
   - Switch to Sonnet 4 and say: `Based on the analysis above, generate the code changes needed to add a priority field to the Task model. Include validation and getter/setter methods.`
   - Then: `Now generate the corresponding controller changes to handle priority in task creation and updates.`

   **Step 3: Documentation and Git Summary with GPT-4.1/5-mini**
   - Switch to GPT-4.1/5-mini and request: `Get the current git status and create a summary of what files would be changed for this priority feature.`
   - Follow with: `Generate a concise commit message and brief documentation for these priority changes.`

   **Step 4: Validation Back to oX**
   - Return to oX and ask: `Review the generated code changes. Are there any logical flaws or edge cases I should address before implementing?`

2. **Reflect on the Multi-Model Experience**
   - Compare how each model approached their specialized task
   - Note the differences in reasoning depth, code quality, and task execution efficiency
   - Consider how this workflow could be applied to other feature development scenarios

**Learning Goal:** Master a practical multi-model workflow that leverages each LLM's strengths for analysis, implementation, and project management tasks.

---

## Phase 8: Advanced Prompt Engineering and Agent Workflows

### Exercise 8.1: Understanding Custom Agents

You can create **custom agents** (`.agent.md` files) that define specialized personas with specific tools, instructions, and behaviors. This repository may include custom agents in `.github/agents/`.

1. **Explore Custom Agents (if available)**
   - Check if `.github/agents/` folder exists in your project
   - If available, open files like `Implementer.agent.md` or `Lead Developer.agent.md` and review their structure:
     - Agent description and purpose
     - Allowed tools and capabilities
     - Behavioral instructions and protocols
     - Execution phases and workflows

2. **Using Custom Agents**
   - Custom agents can be referenced in your Copilot conversations
   - You can ask Copilot to act according to agent personas: `Act as the Implementer agent and execute this task following strict implementation protocols`
   - Or reference agent guidelines: `Following the Lead Developer agent guidelines, review this architecture`

3. **Practice with Agent Personas**
   - Try using different agent personas for different tasks:
     - **Implementer persona**: Focused on strict, single-task execution
     - **Lead Developer persona**: Strategic planning and decomposition
   - Notice how different personas affect the type of responses you get

4. **Creating Your Own Agent Guidelines (Optional)**
   - Create a `.github/agents/` folder if it doesn't exist
   - Define agent personas for your team:
     - Code Reviewer Agent
     - Documentation Agent
     - Testing Agent
     - Security Analyst Agent
   - Document their responsibilities, tools, and workflows

**Learning Goal:** Understand how custom agent personas extend Copilot's capabilities with specialized workflows.

### Exercise 8.2: Role-Based Collaboration with Agent Personas

1. **Simulate a Lead Developer / Implementer Workflow**
   
   **Thread 1: Lead Developer Persona**
   - Open Copilot Chat
   - Establish the persona: `Act as a Lead Developer. Your role is to analyze requirements, plan architecture, and decompose features into tasks. You do NOT write production code - you create plans for implementers.`
   - Request: `I need to add user roles and permissions to this PHP application. Analyze the requirements and create a detailed implementation plan.`
   - Follow up: `Break down this feature into discrete, actionable tasks for an implementer.`
   - Save the plan for the next step

   **Thread 2: Implementer Persona**
   - Open a new Copilot Chat thread or window
   - Establish the persona: `Act as an Implementer. Your role is to execute specific, well-defined tasks by writing code. You follow instructions precisely and focus on one task at a time.`
   - Share Task 1 from the Lead Developer plan: `Implement this task: [paste task description]. Focus only on this specific implementation.`
   - Request: `Generate the code for this task following PHP best practices.`
   
   **Back to Lead Developer**
   - Return to Thread 1 with the implementation
   - Ask: `Review this implementation. Does it meet the requirements? Are there any issues?`
   - Get feedback and return to Implementer for refinements
   - Continue until the feature is complete

2. **Understanding Agent Boundaries**
   - Notice how Lead Developer refuses to write production code
   - Observe how Implementer stays focused on single tasks
   - This separation prevents scope creep and maintains quality

**Learning Goal:** Master role-based collaboration using agent personas that mirror real team dynamics.

### Exercise 8.3: Reusable Prompt File Files

GitHub Copilot supports **prompt files** (`.prompt.md`) that define reusable prompt templates. This repository may include prompts in `.github/prompts/`.

1. **Explore Available Prompt Files**
   - Check if `.github/prompts/` folder exists in your project
   - Review available prompts (if any) such as:
     - Session summaries for capturing outcomes
     - Thread dumps for context handoff
     - Implementation templates
     - Review checklists

2. **Using Prompt Files**
   - In VS Code, you can reference prompts from the `.github/prompts/` folder
   - Copy prompt templates and customize them for your needs
   - Use them consistently across your team for standardized workflows

3. **Session Summaries Example**
   - If `summarize-session.prompt.md` exists, explore its structure
   - Try creating a session summary following its format:
     - Key outcomes and decisions
     - Completed tasks
     - Next steps
     - Blockers or issues
   - Use this at the end of work sessions for continuity

4. **Thread Dump Example: Critical Context Handoff**
   - If `thread-dump.prompt.md` exists, review its protocol
   - Simulate a scenario where your chat context is at maximum capacity
   - Generate a briefing message that includes:
     - Primary objective of the session
     - Mission log (completed steps, current status)
     - Essential assets (files, data, URLs)
     - Immediate directives (next actions)
     - Constraints & pitfalls (instructions, limitations)
   - Practice formatting as a precise handoff message

5. **Creating Your Own Prompt Files (Optional)**
   - Create a `.github/prompts/` folder if it doesn't exist
   - Define reusable prompts for common tasks:
     - Code review checklists
     - Bug report templates
     - Feature implementation guides
     - Testing protocols
   - Share these with your team for consistency

**Learning Goal:** Leverage reusable prompt files to standardize workflows and ensure consistency across your team.

### Exercise 8.4: Effective Context Management

1. **Context Window Awareness**
   - Be aware that each chat thread has a limited context window
   - When a conversation gets long, Copilot may lose earlier context
   - Monitor your thread length and consider starting fresh when needed

2. **Creating Handoff Documents**
   - Before closing a complex thread, ask: `Summarize our discussion, decisions, and implementation steps in a format I can use to continue in a new thread`
   - Save these summaries in your project docs or as comments
   - Use them to restart conversations with full context

3. **Thread Hygiene Best Practices**
   - Name or label your chat threads descriptively (if your IDE supports it)
   - Keep threads focused on single features or problems
   - Don't mix different concerns in the same thread
   - Start a new thread when switching to a different task
   - Use @project at the beginning of new threads for fresh context

4. **Context Refresh Strategies**
   - When Copilot seems to forget earlier decisions:
     - Remind it: `Earlier in this thread, we decided to use X pattern`
     - Reference files: `As shown in #file:TaskController.php, we're using this approach`
     - Start fresh with a summary: Open new thread with context from previous

**Learning Goal:** Master the art of managing chat context effectively for complex, multi-step development tasks.

---

## Phase 9: Creative and Exploratory Exercises

### Exercise 9.1: Code Refactoring Challenges

1. **Refactoring Scenarios**
   - Open Copilot Chat
   - `How would you refactor the TaskController to use a PHP dependency injection container?`
   - `Show me how to implement the Repository pattern for data access`

2. **Design Pattern Implementation**
   - `How could I implement the Observer pattern for task status changes?`
   - `Show me how to add a Factory pattern for creating different task types.`

**Learning Goal:** Explore advanced programming concepts with Copilot's guidance.

### Exercise 9.2: Alternative Implementations

1. **Different Approaches**
   - `Show me 3 different ways to implement task filtering.`
   - `What are alternative approaches to JSON file storage?`

2. **Technology Comparisons**
   - `How would this application look if built with Laravel framework?`
   - `Compare this implementation with a database-driven approach using PDO.`

**Learning Goal:** Understand different implementation strategies and trade-offs.

### Exercise 9.3: Multi-Thread Task Management with Role-Based Agents

1. **Scenario: Implementing User Authentication - Collaborative Development**

> **Tips:** You can find old chat histories in the Copilot tool window by pressing the clock icon.
   
   **Setup: Create Two Separate Chat Threads**
   - Open two separate Copilot chat windows/threads for this exercise
   
   **Thread 1: Lead Developer Role**
   - In the first chat, establish the role: `Act as a Lead PHP Developer. You are responsible for architectural decisions, code reviews, and ensuring PHP best practices.`
   - Ask: `I need to add user authentication to this PHP task manager. What's the overall architecture and implementation strategy you recommend?`
   - Follow up: `Create a detailed implementation plan with security considerations and database schema changes for PHP.`

   **Thread 2: Tester/Implementer Role**
   - Open a new chat window for the second thread
   - In the second chat, establish the role: `Act as a Tester/Implementer. You focus on writing PHP code, creating PHPUnit tests, and ensuring implementation quality.`
   - Share the plan from Thread 1 and ask: `Based on this authentication plan, implement the PHP User model and basic login functionality.`
   - Request: `Generate comprehensive PHPUnit tests for the authentication system.`

2. **Cross-Thread Collaboration**
   - Take the PHP implementation from Thread 2 back to Thread 1 (Lead Developer) for code review
   - Ask the Lead Developer: `Review this PHP authentication implementation. What improvements or security concerns do you see?`
   - Bring the feedback back to Thread 2 (Tester/Implementer) to refine the code
   - Continue this back-and-forth until both roles approve the solution

**Learning Goal:** Master collaborative development using multiple chat threads with distinct roles, simulating real-world team dynamics and leveraging specialized agents for comprehensive project management.

---

Happy coding with GitHub Copilot!