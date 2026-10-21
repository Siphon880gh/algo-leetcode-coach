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
            'message' => "Read the problem statement above.\nWhen to take mod 10?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At every addition', 'next' => 's2'],
                ['label' => 'Only at the end', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Without it values grow like C(999, 499), far beyond 64-bit.\nStep back to when you delayed the mod.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Row length each round?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stays n', 'next' => 'wrong_b'],
                ['label' => 'One shorter', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. nums[i + 1] for the last i would be out of range or stale.\nStep back to when you kept the length.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "In-place order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left to right', 'next' => 'success'],
                ['label' => 'Right to left', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. nums[i + 1] is already updated; Example 1 → 2 instead of 8.\nStep back to when you went right to left.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 8, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
