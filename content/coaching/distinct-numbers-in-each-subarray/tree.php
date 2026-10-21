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
            'message' => "Problem: Given an array nums and an integer k, return for every window of k consecutive elements the number of distinct values in it. For instance, [1,2,3,2,2,1,3] with k = 3 → [3,2,2,2,3], and [1,1,1,1,2,3,4] with k = 4 → [1,2,3,4]. (Restated from memory; limits and examples may differ slightly.)\nPer window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Update one in, one out', 'next' => 's2'],
                ['label' => 'Rebuild a set', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n · k).\nStep back to when you rebuilt.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count hits 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave it', 'next' => 'wrong_b'],
                ['label' => 'Delete the key', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The map size would overcount.\nStep back to when you left zero keys.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Number of outputs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − k + 1', 'next' => 'success'],
                ['label' => 'n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only full windows count.\nStep back to when you produced n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check → [3,2,2,2,3], [1,2,3,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
