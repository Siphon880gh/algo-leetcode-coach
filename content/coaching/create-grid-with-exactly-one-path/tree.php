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
            'message' => "Read the problem statement above.\nBlock anything?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Everything except the top row and last column', 'next' => 's2'],
                ['label' => 'Nothing', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): 2 × 3 all free → 3 paths instead of 1.\nStep back to when you left every cell free.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which column stays free below row 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first column', 'next' => 'wrong_b'],
                ['label' => 'The last column', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): 2 × 3 → 0 paths instead of 1, since the end cell is blocked.\nStep back to when you freed the first column.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Every size up to 25 × 25 → exactly 1 path.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
