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
            'message' => "Read the problem statement above.\nA value with a repeated digit, like 11?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never usable', 'next' => 's2'],
                ['label' => 'Usable, with its digits as a set', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. vals = [11] → 11 instead of 0.\nStep back to when you used it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pick values how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest usable values first', 'next' => 'wrong_b'],
                ['label' => 'Knapsack over digit masks', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. vals = [36, 6, 31], par = [−1, 0, 1] → 104 instead of 105.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · 3^10). Examples → 8, 15, 42, 18.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
