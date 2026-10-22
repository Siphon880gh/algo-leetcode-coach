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
            'message' => "Read the problem statement above.\nNeutralize?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most 2 robbers', 'next' => 's2'],
                ['label' => 'Every robber', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [[1, −5, −5, −5]] → 1 instead of −4.\nStep back to when you skipped every robber.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Initial values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Clamp at 0', 'next' => 'wrong_b'],
                ['label' => '−∞', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [[−1, −2, −3, −4]] → 0 instead of −3.\nStep back to when you clamped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(mn). Examples → 8, 40.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
