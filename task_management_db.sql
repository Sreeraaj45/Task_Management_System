Dummy Data

INSERT INTO `notifications` (`message`, `recipient`, `type`, `date`, `is_read`) VALUES
('\'Review quarterly sales performance\' has been assigned to you. Please check the data and provide insights.', 2, 'New Task Assigned', CURRENT_DATE, 0),
('\'Organize team-building event\' has been assigned to you. Plan and coordinate the activities.', 7, 'New Task Assigned', CURRENT_DATE, 0),
('\'Update security protocols\' has been assigned to you. Please review and implement the latest security measures.', 8, 'New Task Assigned', CURRENT_DATE, 0),
('\'Develop new client proposal\' has been assigned to you. Draft and refine the proposal for the upcoming client meeting.', 2, 'New Task Assigned', CURRENT_DATE, 0),
('\'Audit project expenses\' has been assigned to you. Ensure all expenditures are documented and within budget.', 7, 'New Task Assigned', CURRENT_DATE, 0);



INSERT INTO tasks (title, description, assigned_to, due_date, status, created_at) 
VALUES 
('Review quarterly sales performance', 'Analyze sales trends and generate insights for leadership.', 2, DATE_ADD(CURRENT_DATE, INTERVAL 3 DAY), 'pending', CURRENT_TIMESTAMP),
('Organize team-building event', 'Plan activities to enhance team collaboration and morale.', 2, DATE_ADD(CURRENT_DATE, INTERVAL 5 DAY), 'pending', CURRENT_TIMESTAMP),
('Update security protocols', 'Review and implement updated cybersecurity measures.', 2, DATE_ADD(CURRENT_DATE, INTERVAL 4 DAY), 'pending', CURRENT_TIMESTAMP),
('Develop new client proposal', 'Create a strategic proposal for a potential client.', 2, DATE_ADD(CURRENT_DATE, INTERVAL 6 DAY), 'pending', CURRENT_TIMESTAMP),
('Audit project expenses', 'Ensure all financial records are accurate and up-to-date.', 2, DATE_ADD(CURRENT_DATE, INTERVAL 7 DAY), 'pending', CURRENT_TIMESTAMP);
