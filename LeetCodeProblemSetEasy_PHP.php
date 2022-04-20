// ARRAYS --------------------------------------------------------------------------------------------------

// Remove Duplicates from Sorted Array
class Solution {
    function removeDuplicates(&$nums) {
        $slow = 0;

        for($fast = 1; $fast < count($nums); $fast++){
            if($nums[$slow] != $nums[$fast]){
                $slow++;
                $nums[$slow] = $nums[$fast];
            }
        }

        return $slow+1;
    }
}

// Best Time to Buy and Sell Stock II
class Solution {
    function maxProfit($prices) {
        $profit = 0;
        
        for($i = 1; $i < count($prices); $i++){
            if($prices[$i] > $prices[$i-1])
                $profit += $prices[$i] - $prices[$i-1];
        }
        
        return $profit;
    }
}

// Rotate Array
class Solution {
    function rotate(&$nums, $k) {
        $k = $k%count($nums);
        $nums = array_reverse($nums);
        $this -> rev($nums, 0, $k-1);
        $this -> rev($nums, $k, count($nums)-1);
    }
    
    function rev(&$nums, $start, $end){
        while($start < $end){
            $temp = $nums[$start];
            $nums[$start] = $nums[$end];
            $nums[$end] = $temp;
            $start++;
            $end--;
        }
    }
}

// Contains Duplicate
class Solution {
    function containsDuplicate($nums) {
        $map = array();
        for($i=0; $i<count($nums); $i++){
            if(array_key_exists($nums[$i], $map))
                return true;
            else
                $map += [$nums[$i] => 1];
        }
        return false;
    }
}

// Single Number
class Solution {
    function singleNumber($nums) {
        // BITWISE SOLUTION
        $result = 0;
        foreach($nums as $num)
            $result ^= $num;
        return $result;
    }
}

/* MAP SOLUTION
$map = array();

for($i=0; $i<count($nums); $i++){
    if(array_key_exists($nums[$i], $map))
        $map[$nums[$i]]+=1;
    else
        $map += [$nums[$i] => 1];
}

foreach($map as $key => $value)
    if($value == 1)
        return $key;

return 0;
*/

// Intersection of Two Arrays II
class Solution {
    function intersect($nums1, $nums2) {
        $intList = [];
        $jIndex = [];
        
        for($i=0; $i<count($nums1); $i++){
            for($j=0; $j<count($nums2); $j++){
                if(in_array($j, $jIndex))
                    continue;
                if($nums1[$i] == $nums2[$j]){
                    array_push($intList, $nums1[$i]);
                    array_push($jIndex, $j);
                    break;
                }
            }
        }
        
        return $intList;
    }
}

// Plus One
class Solution {
    function plusOne($digits) {
        for($i=count($digits)-1; $i>=0; $i--){
            if($digits[$i] != 9){
                $digits[$i] += 1;
                return $digits;
            }else
                $digits[$i] = 0;
        }
        array_unshift($digits, 1);
        return $digits;
    }
}

// Move Zeroes
class Solution {
    function moveZeroes(&$nums) {
        $zeroCount = 0;
        for($i=0; $i<count($nums); $i++){
            $zeroCount += ($nums[$i] == 0);
        }
        
        $arr = [];
        for($i=0; $i<count($nums); $i++){
            if($nums[$i] != 0)
                array_push($arr, $nums[$i]);
        }
        
        while($zeroCount--)
            array_push($arr, 0);
        
        $nums = $arr;
    }
}

// Two Sum
class Solution {
    function twoSum($nums, $target) {
        $map = [];
        $result = [];
        for($i=0; $i<count($nums); $i++){
            if(array_key_exists($target-$nums[$i], $map)){
                $result[0] = $map[$target-$nums[$i]];
                $result[1] = $i;
                break;
            }else
                $map += [$nums[$i]=>$i];
        }
        return $result;
    }
}

// Rotate Image
class Solution {
    function rotate(&$matrix) {
        $rowCount = count($matrix);
        $indexAdder = [];
        
        $temp = $rowCount-1;
        for($i=0; $i<$rowCount; $i++)
            $indexAdder[$i] = $temp--;
        
        $listMap = [];
        $indexCounter = 0;
        for($i=0; $i<$rowCount; $i++){
            for($j=0; $j<$rowCount; $j++){
                $newIndex = ((($indexCounter++)%$rowCount)*$rowCount)+$indexAdder[$i];
                array_push($listMap, array($matrix[$i][$j], $newIndex));
            }
        }
        
        $indexCounter = 0;
        for($i=0; $i<$rowCount; $i++){
            for($j=0; $j<$rowCount; $j++){
                $matrix[$i][$j] = $this -> getKey($listMap, $indexCounter);
            }
        }
    }

    function getKey(&$list, $value){
        for($i=0; $i<count($list); $i++){
            if($list[$i][1] == $value)
                return $list[$i][0];
        }
        return 0;
    }
}

// STRINGS --------------------------------------------------------------------------------------------------

// Reverse String
class Solution {
    function reverseString(&$s) {
        $s = array_reverse($s);
    }
}

// Reverse Integer
class Solution {
    function reverse($x) {
        $sum = 0;
        $sign = 1;
        
        if($x<0)
            $sign = -1;
        
        $x = abs($x);
        
        while($x > 0){
            $rem = $x%10;
            $x = floor($x / 10);
            $sum = $sum * 10 + $rem;
            if($sum < pow(-2, 31) || $sum > pow(2, 31)-1) return 0;
        }
        
        return $sum*$sign;
    }
}

// First Unique Character in a String
class Solution {
    function firstUniqChar($s) {
        $map = [];
        $index = -1;
        
        for($i=0; $i<strlen($s); $i++){
            if(array_key_exists($s[$i], $map))
                $map[$s[$i]] += 1;
            else
                $map += [$s[$i] => 1];
        }
        
        foreach($map as $key => $value){
            if($value == 1)
                return strpos($s, $key);
        }
        
        return -1;
    }
}

// Valid Anagram
class Solution {
    function isAnagram($s, $t) {
        return count_chars($s,1) == count_chars($t,1);
    }
}

// Valid Palindrome
class Solution {
    function isPalindrome($s) {
        $s = preg_replace("/[^A-Za-z0-9]/", '', $s);
        $s = strtolower($s);
        $start = 0;
        $end = strlen($s)-1;
        while($start < $end){
            if($s[$start] != $s[$end])
                return false;
            $start++;
            $end--;
        }
        return true;
    }
}

// Implement strStr()
class Solution {
    function strStr($haystack, $needle) {
        $needleLen = strlen($needle);
        $hayLen = strlen($haystack);
        
        if($needleLen > $hayLen)
            return -1;
        if($haystack == null || $needle == null || $needleLen == 0)
            return 0;
        
        for($i=0; $i<=$hayLen-$needleLen; $i++){
            $temp = substr($haystack, $i, $needleLen);
            if($temp == $needle)
                return $i;
        }
        
        return -1;
    }
}

// Longest Common Prefix
class Solution {
    function longestCommonPrefix($strs) {
        $result = "";
        $prefix = "";
        
        for($i=0; $i<strlen($strs[0]); $i++){
            $prefix = $strs[0][$i];
            for($j=1; $j<count($strs); $j++){
                if($i == strlen($strs[$j]))
                    return $result;
                if($strs[$j][$i] != $prefix){
                    if(strlen($result)>0)
                        return $result;
                    else
                        return "";
                }
            }
            $result.=$prefix;
        }
        
        return $result;
    }
}

// LINKED LIST --------------------------------------------------------------------------------------------------

// Delete Node in a Linked List
class Solution {
    function deleteNode($node) {
        $node->val = $node->next->val;
        $node->next = $node->next->next;
    }
}

// Remove Nth Node From the end of a List
class Solution {
    function removeNthFromEnd($head, $n) {
        $prev = null;
        $curr = $head;
        $length = 1;
        
        if($head == null || $head->next == null)
            return null;
        
        while($curr->next != null){
            $prev = $curr;
            $curr = $curr->next;
            $length++;
        }
        
        $curr = $head;
        
        for($i=0; $i<$length-$n; $i++)
            $curr = $curr->next;
        
        if($curr->next == null){
            $prev->next = null;
            return $head;
        }
        
        $curr->val = $curr->next->val;
        $curr->next = $curr->next->next;
        
        return $head;
    }
}

// Reverse Linked List
class Solution {
    function reverseList($head) {
        $curr = $head;
        $prev = null;
        
        if($head == null)
            return null;
        
        if($head->next == null)
            return $head;
        
        $deque = [];
        while($curr->next != null){
            $prev = $curr;
            array_push($deque, $curr);
            $curr = $curr->next;
            $prev->next = null;
        }
        array_push($deque, $curr);
        
        $newHead = array_pop($deque);
        while(count($deque) > 0){
            $curr->next = array_pop($deque);
            $curr = $curr->next;
        }
        
        return $newHead;
    }
}

// Merge Two Sorted Lists
class Solution {
    function mergeTwoLists($list1, $list2) {
        $head = null;
        $curr = null;
        
        if($list1 == null)
            return $list2;
        if($list2 == null)
            return $list1;
        if($list1 == null && $list2 == null)
            return null;
        
        if($list1->val <= $list2->val)
            $head = new ListNode($list1->val);
        else
            $head = new ListNode($list2->val);
        
        $curr = $head;
        
        while($list1 != null && $list2 != null){
            if($list1->val <= $list2->val){
                $curr->next = new ListNode($list1->val);
                $curr = $curr->next;
                if($list1->next != null)
                    $list1 = $list1->next;
                else{
                    $curr->next = $list2;
                    return $head->next;
                }
            }else{
                $curr->next = new ListNode($list2->val);
                $curr = $curr->next;
                if($list2->next != null)
                    $list2 = $list2->next;
                else{
                    $curr->next = $list1;
                    return $head->next;
                }
            }
        }
        
        return $head->next;
    }
}

// Palindrome Linked List
class Solution {
    function isPalindrome($head) {
        $result = "";
        
        while($head != null){
            $result .= $head->val;
            $head = $head->next;
        }
        
        return $this->ispalin($result);
    }

    function ispalin($s) {
        if($s == "")
            return true;

        $s = preg_replace("/[^A-Za-z0-9]/", '', $s);
        $s = strtolower($s);
        $start = 0;
        $end = strlen($s)-1;
        while($start < $end){
            if($s[$start] != $s[$end])
                return false;
            $start++;
            $end--;
        }

        return true;
    }
}

// Linked List Cycle
class Solution {
    function hasCycle($head) {
        $map = [];
        
        if($head == null || $head->next == null)
            return false;
        
        while($head != null){
            if($head->next == null)
                return false;
            // inside the "in_array()" function, I had to set the optional parameter "strict" to "true"
            // https://stackoverflow.com/questions/3834791/fatal-error-nesting-level-too-deep-recursive-dependency
            if(in_array($head, $map, true))
                return true;
            array_push($map, $head);
            $head = $head->next;
        }
        
        return false;
    }
}

// TREES --------------------------------------------------------------------------------------------------

// Maximum Depth of Binary Tree
class Solution {
    function maxDepth($root) {
        
        if($root == null)
            return 0;
        
        $leftDepth = $this->maxDepth($root->left);
        $rightDepth = $this->maxDepth($root->right);
        
        if($leftDepth >= $rightDepth)
            return $leftDepth+1;
        else
            return $rightDepth+1;
    }
}

// Validate Binary Search Tree
class Solution {
    function isValidBST($root) {
        return $this->valid($root, PHP_INT_MIN, PHP_INT_MAX);
    }

    function valid($root, $lower, $upper){
        if($root == null)
            return true;
        
        if($root->val <= $lower || $root->val >= $upper)
            return false;
        
        return $this->valid($root->left, $lower, $root->val) && $this->valid($root->right, $root->val, $upper);
    }
}

// Symmetric Tree
class Solution {
    function isSymmetric($root) {
        return $this->isMirror($root->left, $root->right);
    }

    function isMirror($left, $right){
        if($left == null && $right == null)
            return true;
        else if($left == null || $right == null)
            return false;
        else
            return $left->val == $right->val &&
                    $this->isMirror($left->left, $right->right) &&
                    $this->isMirror($left->right, $right->left);
    }
}

// Binary Tree Level Order Traversal
class Solution {
    function levelOrder($root) {
        $nodeList = [];
        $nodeValues = [];
        $currentQ = [];
        $nextQ = [];
        
        if($root == null)
            return $nodeList;
        
        array_push($currentQ, $root);
        
        while(count($currentQ) > 0){
            $node = array_shift($currentQ);
            if($node->left != null)
                array_push($nextQ, $node->left);
            if($node->right != null)
                array_push($nextQ, $node->right);
            
            array_push($nodeValues, $node->val);
            
            if(count($currentQ) == 0){
                $currentQ = $nextQ;
                $nextQ = [];
                array_push($nodeList, $nodeValues);
                $nodeValues = [];
            }
        }
        
        return $nodeList;
    }
}

// Convert Sorted Array to Binary Search Tree
class Solution {
    function sortedArrayToBST($nums) {
        /* 
        If you do a recursive solution and don't have enough information in the given function call's parameters, sortedArrayToBST($nums), 
        you need to create a helper function that does have the parameters needed to make a call with enough information
        */
        return $this->insert($nums, 0, count($nums)-1);
    }

    function insert($nums, $low, $high){
        if($low > $high)
            return null;
        
        $mid = floor($low + ($high-$low)/2);
        
        $root = new TreeNode($nums[$mid]);
        
        $root->left = $this->insert($nums, $low, $mid-1);
        $root->right = $this->insert($nums, $mid+1, $high);
        
        return $root;
    }
}

// SORTING AND SEARCHING --------------------------------------------------------------------------------------------------

// Merge Sorted Array
class Solution {
    function merge(&$nums1, $m, $nums2, $n) {
        while($m>0 && $n>0){
            if($nums1[$m-1] > $nums2[$n-1]){
                $nums1[$m+$n-1] = $nums1[$m-1];
                $m--;
            }else{
                $nums1[$m+$n-1] = $nums2[$n-1];
                $n--;
            }
        }
        
        while($n > 0){
            $nums1[$m+$n-1] = $nums2[$n-1];
            $n--;
        }
    }
}

// First Bad Version
class Solution extends VersionControl {
    function firstBadVersion($n) {
        $x = -1;
        for($i=$n; $i>=1; $i/=2){
            $i = floor($i);
            while(!$this->isBadVersion($x+$i))
                $x+=$i;
        }
        return $x+1;
    }
}

// DYNAMINC PROGRAMMING --------------------------------------------------------------------------------------------------

// Climbing Stairs
class Solution {

public $map = [];

function climbStairs($n) {
    if($n == 0 || $n == 1)
        return 1;
    
    if(array_key_exists($n, $this->map))
        return $this->map[$n];
    
    $result = $this->climbStairs($n-1) + $this->climbStairs($n-2);
    
    $this->map += [$n => $result];
    
    return $result;
}
}

// Best Time to Buy and Sell Stock
class Solution {
    function maxProfit($prices) {
        $profit = 0;
        $buyPrice = 10001; // 10^4+1
        for($i=0; $i<count($prices); $i++){
            if($prices[$i] < $buyPrice)
                $buyPrice = $prices[$i];
            else if($prices[$i] - $buyPrice > $profit)
                $profit = $prices[$i] - $buyPrice;
        }
        return $profit;
    }
}

// Maximum Subarray
class Solution {
    function maxSubArray($nums) {
        $curSum = $nums[0];
        $maxSum = $nums[0];
        
        for($i=1; $i<count($nums); $i++){
            $curSum = max($nums[$i], $curSum+$nums[$i]);
            $maxSum = max($maxSum, $curSum);
        }
        
        return $maxSum;
    }
}

// House Robber
class Solution {
    function rob($nums) {
        if($nums == null || count($nums) == 0)
            return 0;
        if(count($nums) == 1)
            return $nums[0];
        if(count($nums) == 2)
            return max($nums[0], $nums[1]);
        
        $dp = [];
        $dp[0] = 0;
        $dp[1] = $nums[0];
        
        for($i=1; $i<count($nums); $i++){
            $dp[$i+1] = max($dp[$i], $dp[$i-1] + $nums[$i]);
        }
        
        return $dp[count($nums)];
    }
}

// DESIGN --------------------------------------------------------------------------------------------------

// Shuffle an Array
class Solution {
    public $nums = [];
    
    function __construct($nums) {
        $this->nums = $nums;
    }
  
    function reset() {
        return $this->nums;
    }
  
    function shuffle() {
        $copy = $this->nums;
        $m = count($copy);
        $i = $temp = 0;
        
        while($m > 0){
            $i = floor(rand(0, 10)/10 * $m--);
            $temp = $copy[$m];
            $copy[$m] = $copy[$i];
            $copy[$i] = $temp;
        }
        array_filter($copy, fn($value) => $value != '' && $value == null);
        return $copy;
    }
}

/**
 * Your Solution object will be instantiated and called as such:
 * $obj = Solution($nums);
 * $ret_1 = $obj->reset();
 * $ret_2 = $obj->shuffle();
 */

// Min Stack
class MinStack {    
    private $elements;
    private $size;

    function __construct() {
        $this->elements = [];
        $this->size = 0;
    }

    /**
        * @param Integer $val
        * @return NULL
        */
    function push($val) {
        array_push($this->elements, $val);
        $this->size++;
    }

    /**
        * @return NULL
        */
    function pop() {
        array_pop($this->elements);
        $this->size--;
    }

    /**
        * @return Integer
        */
    function top() {
        return $this->elements[$this->size-1];
    }

    /**
        * @return Integer
        */
    function getMin() {
        return min($this->elements);
    }
}

/**
 * Your MinStack object will be instantiated and called as such:
 * $obj = MinStack();
 * $obj->push($val);
 * $obj->pop();
 * $ret_3 = $obj->top();
 * $ret_4 = $obj->getMin();
 */

// MATH --------------------------------------------------------------------------------------------------

// Fizz Buzz
class Solution {
    function fizzBuzz($n) {
        $result = [];
        for($i=1; $i<=$n; $i++){
            if($i%3==0 && $i%5==0)
                array_push($result, "FizzBuzz");
            else if($i%3==0)
                array_push($result, "Fizz");
            else if($i%5==0)
                array_push($result, "Buzz");
            else
                array_push($result, strval($i));
        }
        return $result;
    }
}

// Count Primes
class Solution {
    function countPrimes($n) {
        $isPrime = [];
        $isPrime = array_fill(0, $n, true);
        
        for($i=2; $i*$i<$n; $i++){
            if(!$isPrime[$i])
                continue;
            for($j=$i*$i; $j<$n; $j+=$i)
                $isPrime[$j] = false;
        }
        
        $count = 0;
        for($i=2; $i<$n; $i++)
            if($isPrime[$i]) $count++;
        
        return $count;
    }
}

// Power of Three
class Solution {
    function isPowerOfThree($n) {
        $result = floor(log($n) / log(3) + 1e-10);
        return $n==0 ? false : pow(3, $result) == $n;
    }
}

// OTHER --------------------------------------------------------------------------------------------------

// Number of 1 Bits
class Solution {
    function hammingWeight($n) {
        // Brian Kernighan
        $result = 0;
        while($n!=0){
            $n = $n & ($n-1);
            $result++;
        }
        return $result;
    }
}

// Hamming Distance
class Solution {=
    function hammingDistance($x, $y) {
        
        /*
        When you XOR x and y, you get the hamming result
        ie. 0110 ^ 1000 = 1110 => 3 1's
        Then you count the 1's ad return that amount
        */
        $mask = $x ^ $y; // XOR - 0^0=0 | 0^1=1 | 1^0=1 | 1^1=0
        $count = 0;
        
        while($mask > 0){
            $count += $mask & 1; // return 1 or 0 depending on if the right-most bit in mask is 1
            $mask >>= 1; // right bitshift 
        }
        
        return $count;
    }
}

// Reverse Bits
class Solution {
    function reverseBits($n) {
        $result = 0;
        for($i=0; $i<32; $i++){
            $result <<= 1;
            if(($n&1) > 0)
                $result++;
            $n >>= 1;
        }
        return $result;
    }
}

// Pascal's Triangle
class Solution {
    function generate($numRows) {
        $returnList = [];
        
        for($i=0; $i<$numRows; $i++){
            array_push($returnList, []);
            for($j=0; $j<=$i; $j++){
                if($j==0 || $i==$j)
                    $returnList[$i][$j] = 1;
                else
                    $returnList[$i][$j] = $returnList[$i-1][$j-1] + $returnList[$i-1][$j];
            }
        }
        
        return $returnList;
    }
}

// Valid Paranthesis
class Solution {
    function isValid($s) {
        $stack  = [];
        $length = strlen($s);
        array_push($stack, $s[0]);
        
        for($i=1; $i<$length; $i++){
            $temp = $stack[count($stack)-1];
            
            if($temp == "(" && $s[$i] == ")" ||
            $temp == "{" && $s[$i] == "}" ||
            $temp == "[" && $s[$i] == "]"){
                array_pop($stack);
                if(count($stack) == 0 & $i != $length-1){
                    array_push($stack, $s[$i+1]);
                    $i++;
                }
            }else
                array_push($stack, $s[$i]);
        }
        
        return count($stack) == 0;
    }
}

// Missing Number
class Solution {
    function missingNumber($nums) {
        sort($nums);
        for($i=0; $i<count($nums); $i++){
            if($i == $nums[$i])
                continue;
            else
                return $i;
        }
        return count($nums);
    }
}