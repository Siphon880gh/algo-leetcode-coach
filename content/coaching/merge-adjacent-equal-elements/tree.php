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
            'message' => "Read the problem statement above.\nMerge how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stack, re-checking the top after each merge', 'next' => 's2'],
                ['label' => 'One left-to-right pass of pairs', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [4, 4] instead of [8].\nStep back to when you made one pass.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After a merge?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Merge once and move on', 'next' => 'wrong_b'],
                ['label' => 'Keep merging while the top two are equal', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): [4, 2, 2] → [4, 4] instead of [8].\nStep back to when you stopped after one merge.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) amortized. Examples → [3, 4], [8], [3, 7, 5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
