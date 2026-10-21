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
            'message' => "Problem: Two sensors record the same sequence of readings. One of them may be faulty: it skipped exactly one reading, so its later values shift left by one and its last value is something else (as the statement describes). Return which sensor (1 or 2) is faulty, or −1 if it cannot be determined or neither is. For instance, [2,3,4,5] and [2,1,3,4] → 1, [2,3,2,2,3,2] and [2,3,2,3,2,7] → 2, and [2,2,2,2,2] and [2,2,2,2,5] → −1. (Restated from memory; limits and examples may differ slightly.)\nWhere can the drop be?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At or after the first difference', 'next' => 's2'],
                ['label' => 'Anywhere', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Before it the sensors agree.\nStep back to when you searched everywhere.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sensor 1 faulty test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 's1[i + 1 …] == s2[i + 1 …]', 'next' => 'wrong_b'],
                ['label' => 's1[i … n − 2] == s2[i + 1 … n − 1]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A drop shifts the faulty sensor left by one.\nStep back to when you compared unshifted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Both hypotheses fit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The data cannot tell them apart.\nStep back to when you picked one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check → 1, 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
