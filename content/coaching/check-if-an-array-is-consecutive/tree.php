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
            'message' => "Problem: An array nums of length n is consecutive if it contains every number in the range [x, x + n − 1], where x is its minimum. Return true if nums is consecutive. For instance, [1,3,4,2] → true; [1,3] → false; [3,5,4] → true. (Restated from memory; limits and examples may differ slightly.)\nDuplicates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Must be checked', 'next' => 's2'],
                ['label' => 'Ignore them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1,1,3] has max − min = 2 = n − 1 but misses 2.\nStep back to when you skipped the distinct check.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Range width?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max − min = n', 'next' => 'wrong_b'],
                ['label' => 'max − min = n − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1,3] would pass, though 2 is missing.\nStep back to when you used n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "One element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Consecutive: true', 'next' => 'success'],
                ['label' => 'Not enough values: false', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [5] contains everything in [5, 5].\nStep back to when you returned false.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed cases → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
