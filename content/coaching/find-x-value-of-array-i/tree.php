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
            'message' => "Read the problem statement above.\nWhich subarrays to count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every subarray (any prefix and suffix removed)', 'next' => 's2'],
                ['label' => 'Only those starting at index 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [3, 1, 1] instead of [9, 2, 4].\nStep back to when you kept the prefix.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Extending a subarray with remainder r by x gives?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'r + x mod k', 'next' => 'wrong_b'],
                ['label' => 'r · x mod k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [7, 4, 4] instead of [9, 2, 4].\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · k). Examples → [9, 2, 4], [18, 1, 2, 0], [9, 6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
