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
            'message' => "Read the problem statement above.\nStop when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The sum equals n', 'next' => 's2'],
                ['label' => 'n is prime', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 4 is not prime but maps to 2 + 2 = 4 forever.\nStep back to when you waited for a prime.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A prime dividing n several times?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add it once', 'next' => 'wrong_b'],
                ['label' => 'Add it each time', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 8 = 2 · 2 · 2 gives 6, not 2; Example 1 → 2 instead of 5.\nStep back to when you added it once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(√n · steps). Examples → 5, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
