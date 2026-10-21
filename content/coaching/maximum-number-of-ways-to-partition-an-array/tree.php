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
            'message' => "Read the problem statement above.\nChange nums[i] by d. Pivots after i (i in the prefix)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'prefix − suffix grows by d', 'next' => 's2'],
                ['label' => 'Unchanged', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. nums[i] sits in the prefix for those pivots, so their difference moves.\nStep back to when you left them unchanged.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pivots at or before i (i in the suffix)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Grows by d', 'next' => 'wrong_b'],
                ['label' => 'prefix − suffix shrinks by d', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Increasing a suffix element lowers prefix − suffix.\nStep back to when you added d.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Leaving the array unchanged?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Also a candidate: count diffs equal to 0', 'next' => 'success'],
                ['label' => 'Always change one element', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 2 [0,0,0] → 2 comes from not changing anything.\nStep back to when you forced a change.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
