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
            'message' => "Read the problem statement above.\nCheck what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Row and column', 'next' => 's2'],
                ['label' => 'The row only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 3, buildings [[1, 1], [1, 2], [1, 3]] → 1 instead of 0.\nStep back to when you checked only the row.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Comparison?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Between, ends included', 'next' => 'wrong_b'],
                ['label' => 'Strictly between min and max', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 4 instead of 0.\nStep back to when you included the ends.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(b). Examples → 1, 0, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
