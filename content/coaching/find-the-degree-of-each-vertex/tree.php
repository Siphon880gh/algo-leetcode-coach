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
            'message' => "Read the problem statement above.\nSum what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Row i', 'next' => 's2'],
                ['label' => 'Row i and column i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [4, 4, 4] instead of [2, 2, 2].\nStep back to when you added the column.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Per vertex?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Total edges, the same for all', 'next' => 'wrong_b'],
                ['label' => 'Its own row', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → [1, 1, 1] instead of [1, 1, 0].\nStep back to when you used one total.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → [2, 2, 2], [1, 1, 0], [0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
