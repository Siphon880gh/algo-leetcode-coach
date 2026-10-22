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
            'message' => "Read the problem statement above.\nComparison?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strictly greater', 'next' => 's2'],
                ['label' => 'Greater or equal', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [1] instead of [].\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "First and last elements?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Peaks if above their one neighbour', 'next' => 'wrong_b'],
                ['label' => 'Never peaks', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [3, 1, 2] → [0, 2] instead of [].\nStep back to when you included the ends.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [], [1, 3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
