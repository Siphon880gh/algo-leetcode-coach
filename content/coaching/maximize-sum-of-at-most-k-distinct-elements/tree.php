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
            'message' => "Read the problem statement above.\nDuplicates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop them first', 'next' => 's2'],
                ['label' => 'Keep them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [100, 93, 93] instead of [100, 93, 84].\nStep back to when you kept duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which k values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest', 'next' => 'wrong_b'],
                ['label' => 'The largest, in descending order', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [77, 84, 90] instead of [100, 93, 90].\nStep back to when you took the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [100, 93, 90], [100, 93, 84], [2, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
