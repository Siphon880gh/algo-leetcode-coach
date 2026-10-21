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
            'message' => "Read the problem statement above.\nDisqualified when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Some |x − y| ≤ d', 'next' => 's2'],
                ['label' => 'Some |x − y| < d', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Equality also disqualifies.\nStep back to when you used strict inequality.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Search for?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exact match of x', 'next' => 'wrong_b'],
                ['label' => 'Lower bound of x − d', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Any value in the window matters.\nStep back to when you searched for x.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Elements of arr1', 'next' => 'success'],
                ['label' => 'Elements of arr2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The distance value counts arr1 elements.\nStep back to when you counted arr2.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) log m). First example → 2. Second → 2. Third → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
