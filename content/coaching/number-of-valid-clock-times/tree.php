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
            'message' => "Read the problem statement above.\nHours to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '00 … 23', 'next' => 's2'],
                ['label' => 'Any first digit 0 … 2 with any second digit', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That includes 24 … 29; Example 3 → 1800 instead of 1440.\nStep back to when you allowed every second digit.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine the counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'H + M', 'next' => 'wrong_b'],
                ['label' => 'H · M', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every hour pairs with every minute; Example 3 → 84 instead of 1440.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(24 + 60). Examples → 2, 100, 1440.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
