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
            'message' => "Read the problem statement above.\nAdd a child’s down value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only when positive', 'next' => 's2'],
                ['label' => 'Always', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [1, 1, 1, 1, 1] instead of [2, 3, 2, 3, 3].\nStep back to when you kept negative children.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer for each node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'down[v] from root 0', 'next' => 'wrong_b'],
                ['label' => 'Reroot: add the parent side when it helps', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [1, 0, 1] instead of [1, 1, 1].\nStep back to when you skipped rerooting.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [1, 1, 1], [2, 3, 2, 3, 3], [−1, −1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
