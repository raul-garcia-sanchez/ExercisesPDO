select * from productlines;
select * from products;
/*products && productlines se juntan por productLine*/

select * from employees;
select * from offices;
/*employees && offices se juntan por officeCode*/

select * from employees;
select * from customers;
/*employees && customers se juntan por employeeNumber*/

select * from customers;
select * from payments;
/*customers && payments se juntan por customerNumber*/

select * from customers;
select * from orders;
/*customers && orders se juntan por customerNUmber*/

select * from orders;
select * from orderdetails;
/*orders && orderdetails se juntan con orderNumber*/

select * from orderdetails;
select * from products;
/*orderdetails && products se juntan por productCode*/