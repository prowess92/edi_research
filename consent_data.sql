USE edi;

SELECT DISTINCT
arv_number,	
(SELECT due_date FROM appointments b WHERE b.client_id = a.id ORDER BY due_date DESC LIMIT 1) next_appointment 
FROM clients a;