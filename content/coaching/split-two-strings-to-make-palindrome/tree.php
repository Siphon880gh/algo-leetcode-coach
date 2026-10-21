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
            'message' => "Read the problem statement above.\nTry every split index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: greedy outer match', 'next' => 's2'],
                ['label' => 'Yes, check each', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you tried every split.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Middle check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only in a', 'next' => 'wrong_b'],
                ['label' => 'Palindrome in a or in b', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The split may fall on either side of the middle.\nStep back to when you checked only a.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Order of strings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check (a, b) and (b, a)', 'next' => 'success'],
                ['label' => 'Only (a, b)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. b_prefix + a_suffix is also allowed.\nStep back to when you checked one order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
