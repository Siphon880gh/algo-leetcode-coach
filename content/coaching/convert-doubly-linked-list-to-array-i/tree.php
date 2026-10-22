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
            'message' => "Problem: Given the head of a doubly linked list, return its values in order as an array. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nFollow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'next', 'next' => 's2'],
                ['label' => 'prev', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 1 ↔ 2 ↔ 3 → [1].\nStep back to when you followed prev.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stop when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'node.next is null', 'next' => 'wrong_b'],
                ['label' => 'node is null', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last value is skipped: 1 ↔ 2 ↔ 3 → [1, 2].\nStep back to when you tested node.next.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The guide’s checks → [1, 2, 3], [5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
