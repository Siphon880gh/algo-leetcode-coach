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
            'message' => "Problem: A binary string s is given with two positive integers num1 and num2 that share no common factor. A substring is a ratio substring when its numbers of 0s and 1s are in the ratio num1 : num2. Count the non-empty ratio substrings. For instance, s = 0110 with num1 = num2 = 1 → 3 (01, 10 and 0110); s = 001 with num1 = 2 and num2 = 1 → 1. (Restated from memory; limits and examples may differ slightly.)\nPrefix key changes by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '+num2 for a 0, −num1 for a 1', 'next' => 's2'],
                ['label' => '+num1 for a 0, −num2 for a 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That tests the ratio num2 : num1 instead; s = 001, num1 = 2, num2 = 1 → 0 instead of 1.\nStep back to when you swapped the weights.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Before the first character, cnt holds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing', 'next' => 'wrong_b'],
                ['label' => '{0: 1} for the empty prefix', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Substrings starting at index 0 are lost; s = 0110, num1 = num2 = 1 → 1 instead of 3.\nStep back to when you started empty.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
