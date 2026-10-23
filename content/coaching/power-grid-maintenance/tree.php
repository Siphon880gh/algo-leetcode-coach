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
            'message' => "Read the problem statement above.\nCheck on an offline station?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest online id in its grid', 'next' => 's2'],
                ['label' => 'The station itself anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [3, 1, 2] instead of [3, 2, 3].\nStep back to when you ignored offline.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One heap per?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whole network', 'next' => 'wrong_b'],
                ['label' => 'Grid', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → [1, 2] instead of [1, −1].\nStep back to when you shared one heap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((c + n) α(c) + q log c). Examples → [3, 2, 3], [1, −1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
