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
            'message' => "Read the problem statement above.\nTry removing each element per prefix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: test shapes with freq of counts', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you tried each removal.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "All values occur once?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Invalid', 'next' => 'wrong_b'],
                ['label' => 'Valid: remove any one', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Removing one leaves all counts at 1.\nStep back to when you rejected it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "One value occurs mx times, the rest mx − 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Valid: freq[mx − 1] · (mx − 1) + mx == L', 'next' => 'success'],
                ['label' => 'Invalid', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Remove one copy of that value.\nStep back to when you rejected it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [2,2,1,1,5,3,3,5] → 7. [1,1,1,2,2,2,3,3,3,4,4,4,5] → 13.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
