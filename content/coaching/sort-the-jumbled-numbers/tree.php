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
            'message' => "Read the problem statement above.\nEqual mapped values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep input order (stable sort)', 'next' => 's2'],
                ['label' => 'Order them any way', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 maps 338 and 38 both to 7 and needs 338 first.\nStep back to when you dropped stability.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Number 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stays 0', 'next' => 'wrong_b'],
                ['label' => 'Maps to mapping[0]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 0 is a digit like the rest and goes through the mapping.\nStep back to when you left 0 alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Return what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The original numbers, reordered', 'next' => 'success'],
                ['label' => 'The mapped values', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 would return [7,7,669] instead of [338,38,991].\nStep back to when you returned mapped values.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n · d). Examples → [338,38,991], [123,456,789].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
