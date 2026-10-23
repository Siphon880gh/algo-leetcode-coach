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
            'message' => "Read the problem statement above.\nWhat to count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Zero-free numbers in [1, n]', 'next' => 's2'],
                ['label' => 'All zero-free numbers with up to L digits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 90 instead of 9.\nStep back to when you ignored n.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shortcut n − ⌊n / 10⌋?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, drop multiples of 10', 'next' => 'wrong_b'],
                ['label' => 'No: count digit by digit', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): n = 101 → 91 instead of 90.\nStep back to when you used the shortcut.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). Examples → 9, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
