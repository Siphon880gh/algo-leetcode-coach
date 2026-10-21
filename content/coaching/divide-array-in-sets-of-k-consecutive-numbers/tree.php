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
            'message' => "Read the problem statement above.\nn mod k ≠ 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return false at once', 'next' => 's2'],
                ['label' => 'Try anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Groups of k cannot cover n.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which value starts a group?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any value', 'next' => 'wrong_b'],
                ['label' => 'The smallest remaining', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only the minimum is forced to start a run.\nStep back to when you picked freely.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Remove copies how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c at once for each of the k values', 'next' => 'success'],
                ['label' => 'One group at a time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Large counts would make that slow.\nStep back to when you looped per group.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [1,2,3,3,4,4,5,6], 4 → true. [1,2,3,4], 3 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
