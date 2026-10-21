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
            'message' => "Read the problem statement above.\nWhich indices interact?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only those with the same i mod k', 'next' => 's2'],
                ['label' => 'All of them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The condition compares arr[i − k] with arr[i], so the k chains are independent.\nStep back to when you mixed chains.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Kept subsequence must be?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strictly increasing (bisect_left)', 'next' => 'wrong_b'],
                ['label' => 'Non-decreasing (bisect_right)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1,1,1] with k = 1 needs 0 changes, but a strict version reports 2.\nStep back to when you used strict.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Changes per chain?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Length minus the kept subsequence', 'next' => 'success'],
                ['label' => 'Number of descents', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [4,5,6,1,2,3] with k = 1 has one descent but needs 3 changes.\nStep back to when you counted descents.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 4, 0, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
