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
            'message' => "Read the problem statement above.\nRemove which values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Least frequent first', 'next' => 's2'],
                ['label' => 'Most frequent first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Big groups cost more per unique removed.\nStep back to when you chose frequent ones.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Partial removal of a value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counts as removed', 'next' => 'wrong_b'],
                ['label' => 'Never reduces the count: stop', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The value remains.\nStep back to when you counted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Faster than sorting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Bucket by count', 'next' => 'success'],
                ['label' => 'Not possible', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Counts are ≤ n.\nStep back to when you gave up.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [5,5,4], 1 → 1. [4,3,1,1,3,3,2], 3 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
