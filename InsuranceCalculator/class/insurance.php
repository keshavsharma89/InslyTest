<?php
 /*    
    1. Create HTML form with fields:
        • Estimated value of the car (100 - 100 000 EUR)
        • Tax percentage (0 - 100%)
        • Number of instalments (count of payments in which client wants to pay for the policy (1 – 12))
        • Calculate button
        
    2. Build calculator logic in PHP using OOP:
        • Base price of policy is 11% from entered car value, except every Friday 15-20 o’clock (user time) when it is 13%
        • Commission is added to base price (17%)
        • Tax is added to base price (user entered)
        • Calculate different payments separately (if number of payments is larger than 1)
        • Output is rounded to two decimal places
        
    3. Final output (price matrix):
        • Base price
        • Price with commission and tax (every instalment separately)
        • Tax amount (separately with every instalment)
        • Grand totals (sum of all instalments): Price with commission and tax, total tax sum
 
 * 
 * insurance is the class which will do all the math and return all the data.
 * @carcost is the estimated cost of car, form field
 * @tax tax percentage, form field
 * @installments will be the number of installments, form field
 * 
 * @basicpercentage will represent Base price of policy
 * @basicprice is the base price
 * @commission is the commision amoount out of base price
 * @taxamount is the amount after calculating tax
 * @totalcost will be uses for total cost of insurence
 * */
class insurance
{
    public $carcost;
    public $tax;
    public $installments;
    
    public $basicpercentage;
    public $basicprice;
    public $commission;
    public $taxamount;
    public $totalcost;
    
    // this function will do all the math and return the data as per form data
    public function calculate(array $data){
        $this->carcost=$data['carcost'];
        $this->tax=$data['tax'];
        $this->installments=$data['installments'];
        
        $timestamp = time();
        $hour=date('H', $timestamp);
        $day=date('D', $timestamp);
        
        //Base price of policy is 11% from entered car value, except every Friday 15-20 o’clock (user time) when it is 13%
        if($day=='Fri' && $hour>14 && $hour<21 ){
            $this->basicpercentage=13;
        }else{
            $this->basicpercentage=11;
        }
        
        // calculating the base price, commission, tax and total cost
        $this->basicprice=round(($this->carcost*$this->basicpercentage)/100, 2);
        $this->commission=round(($this->basicprice*17)/100, 2);
        $this->taxamount=round(($this->basicprice*$this->tax)/100, 2);
        $this->totalcost=round(($this->taxamount+$this->commission+$this->basicprice), 2);
    }
}
?>
