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
            'message' => "Read the problem statement above.\nTest which height?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'height[i − 1]', 'next' => 's2'],
                ['label' => 'height[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [2, 3, 4] instead of [3, 4].\nStep back to when you tested the mountain itself.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Greater or equal', 'next' => 'wrong_b'],
                ['label' => 'Strictly greater', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → [1, 3] instead of [].\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [3, 4], [1, 3], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
