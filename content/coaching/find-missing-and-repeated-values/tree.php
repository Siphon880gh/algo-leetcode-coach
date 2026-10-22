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
            'message' => "Read the problem statement above.\nSearch for the missing value in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 … n²', 'next' => 's2'],
                ['label' => '1 … n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 has n = 2 and is missing 4, so the scan finds nothing.\nStep back to when you scanned to n.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[missing, repeated]', 'next' => 'wrong_b'],
                ['label' => '[repeated, missing]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [4, 2] instead of [2, 4].\nStep back to when you put the missing value first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → [2, 4], [9, 5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
