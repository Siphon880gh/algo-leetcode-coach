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
            'message' => "Read the problem statement above.\nA zeroing needs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A later free second to mark it', 'next' => 's2'],
                ['label' => 'Nothing more', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 3 instead of 6.\nStep back to when you skipped the mark.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No later free second?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip this zeroing', 'next' => 'wrong_b'],
                ['label' => 'Drop the smallest zeroing (heap)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. nums = [1, 3, 1], changeIndices [1, 1, 1, 2, 3, 3, 1, 3] → 7 instead of 6.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m log n · log m). Examples → 6, 7, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
