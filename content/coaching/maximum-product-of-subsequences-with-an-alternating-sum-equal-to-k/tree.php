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
            'message' => "Read the problem statement above.\nProduct above limit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep it as one over state', 'next' => 's2'],
                ['label' => 'Drop it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [3, 4, 0], k = −1, limit = 5 → −1 instead of 0.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "First element’s sign?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Minus', 'next' => 'wrong_b'],
                ['label' => 'Plus', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 3 instead of 6.\nStep back to when you started with minus.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 6, −1, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
