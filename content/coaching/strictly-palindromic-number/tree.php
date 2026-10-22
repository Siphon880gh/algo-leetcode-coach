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
            'message' => "Read the problem statement above.\nn = 4 has only base 2. Strictly palindromic?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, 4 is 100 in base 2', 'next' => 's2'],
                ['label' => 'Yes, one base is easy to pass', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 100 is not a palindrome; Example 2 → true instead of false.\nStep back to when you accepted n = 4.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which base always fails for n ≥ 5?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − 1, where n is written 11', 'next' => 'wrong_b'],
                ['label' => 'n − 2, where n is written 12', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 11 is a palindrome, so base n − 1 never fails.\nStep back to when you chose n − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'false for every n', 'next' => 'success'],
                ['label' => 'true for odd n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 has n = 9 → true instead of false.\nStep back to when you returned true.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → false, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
