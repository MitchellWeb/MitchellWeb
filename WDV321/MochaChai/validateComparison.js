/*
WDV321 Advanced JavaScript

UNIT-8 TDD Using Mocha/Chai Automated Testing

Assignment: 8-1 Develop and test the attached test plan.

Create a function that will accept two numbers. Compare those numbers and display
the larger of the two numbers.

Implement the following tests into Mocha. Refactor the code of your function as needed to 
meet the expectations of the test plan and pass all required tests. 

Test Plan - input two numbers, compare them and display the larger of the two
	
	Value1		value2		Expected Result
	5			6		6
	4			3		4
	3			3		"The amounts are equal"		They entered numbers, same numbers they are equal
	a			5		"Please enter a number in Value 1"
	5			a		"Please enter a number in Value 2"
	""			5		"Please enter a number in Value 1"
	5			""		"Please enter a number in Value 2"
	-1			5		5
	+34			-30		34
	-5			-6		-5
	5			-1		5
	1.5			2		2
	2			1.5		2
	3/4			1		"Please enter a number in Value 1"	Fractions are not integers or decimal numbers
	5b			3		"Please enter a number in Value 1"
	3			5b		"Please enter a number in Value 2"
	""			5		"Please enter a number in Value 1"
	5			""		"Please enter a number in Value 2"
*/
//Mitchell Nesheim
var assert = require('chai').assert;

describe('compare', function()
{
    it('6 should be greater than 5', function()
    {
        var a = 5;
        var b = 6;
        assert.isAbove(b,a, b + " is not greater than " + a);
    })
	
	it('4 should be greater than 3', function()
    {
        var a = 4;
        var b = 3;
        assert.isAbove(a,b, b + " is not greater than " + a);
    })
	
	it('3 should be equal to 3', function()
    {
        var a = 3;
        var b = 3;
        assert.equal(a,b, a + " is not equal to " + b);
    })
	it('a  is not a number', function()
    {
        var a = 'a';
		var b = 5

		if(isNaN(a) || isNaN(b))
		{
			assert.isNotNaN(a, "a is not a number");
		}
		

		
    })
	it('a input is not a number', function()
    {
        var a = 5;
		var b = 'a';

		assert.isNotNaN(b, 'b is not a number');

		
    })
	it('1st input is not a number', function()
    {
        var a = '';
		var b = 5

		assert.isNotNaN(a, '1st input is not a number');

		
    })
	it('2nd input is not a number', function()
    {
        var a = 5;
		var b = '';

		assert.isNotNaN(b, '2nd input is not a number');

		
    })
	it('5 should be greater than -1', function()
    {
        var a = -1;
		var b = 5;

		assert.isAbove(b,a, b + ' is not greater than ' + a);

		
    })
	it('+34 should be greater than -30', function()
    {
        var a = +34;
		var b = -30;

		assert.isAbove(a,b, a + ' is not greater than ' + b);

		
    })
	it('-5 should be greater than -6', function()
    {
        var a = -5;
		var b = -6;

		assert.isAbove(a,b, a + ' is not greater than '  + b);

		
    })
	it('5 should be greater than -1', function()
    {
        var a = +34;
		var b = -30;

		assert.isAbove(a,b, a + ' is not greater than ' + b);

		
    })
	it('2 should be greater than 1.5', function()
    {
        var a = 2;
		var b = 1.5;

		assert.isAbove(a,b, b+ ' is not greater than ' + a);

		
    })
	it('2 should be greater than 1.5', function()
    {
        var a = 1.5;
		var b = 2;

		assert.isAbove(b,a, a+ ' is not greater than ' + b);

		
    })
	it('3/4  is not an integer or decimal number', function()
    {
        var a = '3/4';
		var b = 1;

		assert.isNotNaN(a, a+ ' is not an interger or decimal number');

		
    })
	it('5b is not a valid input', function()
    {
        var a = '5b';
		var b = 3;

		assert.isNotNaN(a, a+ ' is not valid input');

		
    })
	it('5b is not a valid input', function()
    {
        var a = 3;
		var b = '5b';

		assert.isNotNaN(b, b+ ' is not valid input');

		
    })

	

})