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
            'message' => "Read the problem statement above.\nCount descents how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Including the wrap from last to first', 'next' => 's2'],
                ['label' => 'Only inside the block', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [1, 3, 2] → 3 instead of 0.\nStep back to when you skipped the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Between blocks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No check', 'next' => 'wrong_b'],
                ['label' => 'Previous max ≤ next min', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 1 instead of 0.\nStep back to when you skipped the block order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · d(n)). Examples → 3, 0, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
