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
            'message' => "Read the problem statement above.\nSubtract x when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only right after an added element', 'next' => 's2'],
                ['label' => 'Whenever it helps', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Two subtractions cannot be adjacent: [−2, −1, −3] → 2 instead of 0.\nStep back to when you chose signs freely.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Total type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '32-bit', 'next' => 'wrong_b'],
                ['label' => '64-bit', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Totals reach about 10^14.\nStep back to when you chose 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 10, 4, 0, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
