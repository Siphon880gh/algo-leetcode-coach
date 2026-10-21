<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Problem: You are given a string s of lowercase English letters. In one operation you may change any character of s to any other character. Return true if s can be made a palindrome using exactly one or two operations, and false otherwise. For instance, abcdba → true; aa → true; abcdef → false. (Restated from memory; limits and examples may differ slightly.)\nCount what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Mismatched pairs (i, n − 1 − i)', 'next' => 's2'],
                ['label' => 'Mismatched positions', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Each bad pair is counted twice; abcd → false instead of true.\nStep back to when you counted positions.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Allowed mismatches?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most 1', 'next' => 'wrong_b'],
                ['label' => 'At most 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two operations fix two pairs; abcdea → false instead of true.\nStep back to when you allowed one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Already a palindrome?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'true', 'next' => 'success'],
                ['label' => 'false, since no operation is needed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Changing both characters of a pair keeps it a palindrome; aa → false instead of true.\nStep back to when you rejected palindromes.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed cases → true, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
