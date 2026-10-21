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
            'message' => "Read the problem statement above.\nTry k = 0, 1, 2, … in order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, binary search', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Linear tries make it O(n · r).\nStep back to when you scanned k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Check for a given k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rebuild the string by deleting', 'next' => 'wrong_b'],
                ['label' => 'Mark the first k indices, two-pointer scan', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Deleting repeatedly is slow.\nStep back to when you rebuilt the string.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Middle with lo = mid on success?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Upper mid', 'next' => 'success'],
                ['label' => 'Lower mid', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The lower mid can stall.\nStep back to when you used it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log r). Examples → 2, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
