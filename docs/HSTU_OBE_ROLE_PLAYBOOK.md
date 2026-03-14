# HSTU-OBE Role Playbook

## Purpose
This playbook defines who does what in HSTU-OBE and how each role should execute core academic and grading workflows.

## Role Matrix
| Activity | Admin | Teacher | Student |
|---|---|---|---|
| Manage users and roles | Yes | No | No |
| Manage faculties, departments, study programs | Yes | No | No |
| Manage courses | Yes | No | No |
| Create syllabus and outcomes | Yes, if owner | Yes, if owner | View only |
| Create classes | Yes, if owner | Yes, if owner | No |
| Join classes | No | No | Yes |
| Create assignments in class | Yes, if class owner | Yes, if class owner | No |
| Grade students | Teacher only | Teacher only | No |
| View own grades and achievements | No | No | Yes |
| View class portfolios | Yes, if class owner | Yes, if class owner | No |

## Admin Playbook
### Main Responsibilities
- User lifecycle management and role assignment.
- Academic master data setup and maintenance.
- Governance, quality checks, and escalation handling.

### Standard Steps
1. Create users and assign role: admin, teacher, student.
2. Setup faculties, departments, and study programs.
3. Create and validate courses for active terms.
4. Verify teacher access to syllabus and classes modules.
5. Verify student onboarding path and profile completion flow.
6. Monitor dashboard metrics and resolve data inconsistencies.

### Weekly Admin Checklist
- Audit newly created users and role accuracy.
- Review duplicate or inactive course records.
- Confirm no unresolved access-control issue remains.

## Teacher Playbook
### Main Responsibilities
- Build OBE artifacts and run assessment workflows.
- Manage classes, assignments, and grading.
- Track achievement outcomes and improve instruction.

### Standard Steps
1. Create syllabus for assigned course.
2. Define outcomes in order:
   - PLO
   - CLO mapped to PLO
   - LLO mapped to CLO
3. Create weekly learning plans tied to LLO.
4. Create assignment plans.
5. For each assignment plan:
   - Create rubric
   - Add criteria mapped to LLO
   - Add criteria levels with points
   - Add assignment plan tasks linked to criteria
6. Create class and share class code.
7. Set class threshold for LLO portfolio.
8. Create class assignments from assignment plans.
9. Grade each student with rubric levels.
10. Review class and student portfolio reports.

### Weekly Teacher Checklist
- Ensure all active assignments have rubric and task mapping.
- Complete pending grading before weekly reporting.
- Review low-achievement LLO and adjust teaching plan.

## Student Playbook
### Main Responsibilities
- Complete onboarding, join classes, track progress, and act on learning outcomes.

### Standard Steps
1. Register or login.
2. Complete profile with student ID.
3. Join classes with class code from teacher.
4. Open assignments and follow instructions.
5. Check assignment rubric results after grading.
6. Use My Grades to monitor:
   - Grading progress
   - Total and letter grade
   - LLO, CLO, and PLO achievements

### Weekly Student Checklist
- Confirm all current class enrollments are correct.
- Check newly graded assignments.
- Review weak outcomes and prioritize improvement.

## Cross-Team Escalation Rules
1. Priority 1: System down or grading blocked for multiple users
- Notify Project Lead immediately.
- Technical Team starts mitigation at once.
2. Priority 2: Core feature failure for one role
- Assign owner and provide workaround.
- Resolve within one business day.
3. Priority 3: Minor defect or UI issue
- Log in backlog and release in normal cycle.

## Quality Guardrails
- No direct production data edits without approval.
- No grade-impacting change without peer review.
- Keep clear audit trail for role and grade changes.
- Never share credentials in chat, ticket, or screenshots.

## Definition of Done
A role task is done when expected output is completed, role permissions are respected, no blocking issue remains, and stakeholders are informed.