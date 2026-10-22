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
            'message' => "Read the problem statement above.\nCompare pattern[k] with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The sign of nums[i + k + 1] − nums[i + k]', 'next' => 's2'],
                ['label' => 'The difference itself', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 0 instead of 2.\nStep back to when you used raw differences.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Number of starts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − m + 1', 'next' => 'wrong_b'],
                ['label' => 'n − m', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A window has m + 1 numbers; the last start would read past the end of nums.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n m). Examples → 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
