-- Задача б

WITH total AS (SELECT fullname,balance, (CASE WHEN outcome IS NULL THEN 0 ELSE outcome end) as outcome, (CASE WHEN income IS NULL THEN 0 ELSE income end) as income  FROM persons
LEFT JOIN 
(SELECT from_person_id as id, sum(amount) as outcome FROM transactions GROUP BY id) as outcomes ON persons.id = outcomes.id
LEFT JOIN
(select to_person_id as id,  sum(amount) as income from transactions group by id) as incomes
ON persons.id = incomes.id)
SELECT fullname, (balance - outcome + income) as final_balance FROM total;

-- Задача в

WITH total AS
(SELECT fullname,
 (CASE WHEN count_from IS NULL THEN 0 ELSE count_from end) as count_from,
 (CASE WHEN count_to IS NULL THEN 0 ELSE count_to end) as count_to
 FROM persons
 LEFT JOIN 
 (SELECT from_person_id as id, count(from_person_id) as count_from FROM transactions GROUP BY id) as a
 ON persons.id = a.id
 LEFT JOIN  
 (SELECT to_person_id as id, count(to_person_id) as count_to from transactions GROUP BY id) as b
 ON persons.id = b.id
) SELECT SUBSTRING(fullname, 1, locate(' ', fullname) - 1 ) as name  FROM total
WHERE count_from + count_to = (SELECT MAX(count_from + count_to) from total);

-- Задача г

SELECT * FROM transactions WHERE (SELECT city_id FROM persons WHERE persons.id = transactions.from_person_id) = (SELECT city_id FROM persons WHERE persons.id = transactions.to_person_id);



