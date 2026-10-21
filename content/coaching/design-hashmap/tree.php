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
            'message' => "Read the problem statement above.\nWhat does each bucket store?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A list of [key, value] pairs', 'next' => 's2'],
                ['label' => 'Only values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Different keys share a bucket, so you need the key to tell them apart.\nStep back to when you stored only values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "put(k, v) and k exists. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append a new pair', 'next' => 'wrong_b'],
                ['label' => 'Overwrite its value', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. get would find the stale pair first.\nStep back to when you appended.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "get(k) and k is missing. Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '-1', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem specifies -1 for a missing key.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) average. put(1,1), put(2,2), get(1) → 1, get(3) → -1, put(2,1), get(2) → 1, remove(2), get(2) → -1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
