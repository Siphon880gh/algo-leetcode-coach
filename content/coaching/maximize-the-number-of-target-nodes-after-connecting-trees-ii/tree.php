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
            'message' => "Read the problem statement above.\nTree-1 part for i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Size of i’s own class', 'next' => 's2'],
                ['label' => 'The larger class', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [8, 8, 8, 8, 8] instead of [8, 7, 7, 8, 8].\nStep back to when you took the larger class.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tree-2 part?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The class of node 0', 'next' => 'wrong_b'],
                ['label' => 'The larger class', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [6, 5, 5, 6, 6].\nStep back to when you used node 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → [8, 7, 7, 8, 8], [3, 6, 6, 6, 6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
