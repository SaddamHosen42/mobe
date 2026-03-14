# HSTU-OBE Team SOP (One Page)

## Document Control
- Title: HSTU-OBE Team Standard Operating Procedure
- Version: 1.0
- Effective Date: 2026-03-14
- Review Cycle: Monthly
- Owner: Project Lead

## Purpose
This SOP standardizes how the team operates the HSTU-OBE platform so academic data, grading workflows, and system updates remain accurate, secure, and on time.

## Scope
This SOP covers user and academic setup, daily operations, grading flow support, issue handling, release checks, and communication for Admin, Teacher Support, and Technical Team.

## Team Roles
1. Project Lead
Responsible for priorities, approvals, release decisions, and escalations.
2. Academic Admin
Responsible for user roles, faculty and course master data, and policy compliance.
3. Teacher Support
Responsible for syllabus and rubric guidance, class setup support, and grading assistance.
4. Technical Team
Responsible for application health, bug fixes, deployment, backup, and monitoring.

## Standard Operating Flow
1. Term Setup (Before Semester)
- Create and verify users by role: admin, teacher, student.
- Configure faculty, department, study program, and course data.
- Confirm teacher syllabus templates and class creation readiness.
- Run environment health check and smoke test.
2. Teaching Setup (Week 0 to Week 1)
- Teachers complete syllabus with PLO, CLO, LLO, learning plans, assignment plans, rubrics, criteria, and criteria levels.
- Teachers create classes and share class codes.
- Students complete profile and join classes.
3. Continuous Operations (Weekly)
- Teachers publish assignments and complete rubric-based grading.
- Support team checks unresolved grading blockers.
- Technical team verifies logs, queue, storage, and performance.
4. Review and Closeout (End of Term)
- Export and archive grade and portfolio outputs.
- Validate LLO/CLO/PLO achievement reports.
- Capture issues and improvements for next cycle.

## Daily Operations Checklist
1. Confirm backend and frontend services are running.
2. Review failed login, permission, and validation issues.
3. Check grading-related tickets first.
4. Verify database backup status.
5. Post daily status update in team channel before end of day.

## Change and Release Procedure
1. Create branch and implement approved change.
2. Run local smoke checks for auth, roles, classes, assignments, and grades.
3. Open PR and complete peer review.
4. Deploy only after Project Lead approval.
5. Run post-deploy smoke test and announce release.

## Incident Handling and SLA
1. Priority 1 (System down or grading blocked for many users)
- Acknowledge in 15 minutes.
- Start mitigation immediately.
- Update stakeholders every 30 minutes.
2. Priority 2 (Core feature degraded)
- Acknowledge in 1 hour.
- Fix target within 1 business day.
3. Priority 3 (Minor bug or UI issue)
- Add to sprint backlog.
- Fix by normal release cycle.

## Quality and Compliance Rules
1. No direct production data edits without approval.
2. Follow role-based access and least privilege.
3. Keep audit trail for user-role changes and grade-impacting operations.
4. Do not share credentials in chat or tickets.
5. Use standardized naming for courses, classes, and syllabus artifacts.

## Communication Cadence
1. Daily: 10-minute standup.
2. Weekly: operations and risk review.
3. Monthly: SOP review and KPI check.

## Definition of Done
A task is complete when feature behavior is validated, role access is correct, no blocker remains, documentation is updated, and stakeholders are informed.