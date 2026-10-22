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
            'message' => "Read the problem statement above.\nTies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First occurrence', 'next' => 's2'],
                ['label' => 'Last occurrence', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [4, 8, 6, 5, 6] instead of [8, 4, 6, 5, 6].\nStep back to when you took the last.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Per operation multiply?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every copy of the minimum', 'next' => 'wrong_b'],
                ['label' => 'One element', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [8, 8, 6, 10, 6] instead of [8, 4, 6, 5, 6].\nStep back to when you multiplied every copy.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k n). Examples → [8, 4, 6, 5, 6], [16, 8].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
