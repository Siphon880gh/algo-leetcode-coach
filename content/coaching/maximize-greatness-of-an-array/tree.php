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
            'message' => "Read the problem statement above.\nDoes x beat a[i] when equal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, it must be strictly greater', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. perm[i] > nums[i] is strict; Example 2 → 4 instead of 3.\nStep back to when you allowed ties.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When does the target pointer move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After every x', 'next' => 'wrong_b'],
                ['label' => 'Only when x beats a[i]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Then each value is compared with itself; Example 1 → 0 instead of 4.\nStep back to when you always advanced.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 4, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
