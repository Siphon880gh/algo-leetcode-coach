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
            'message' => "Read the problem statement above.\nKelvin?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'celsius + 273.15', 'next' => 's2'],
                ['label' => 'celsius + 273', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The 0.15 is far above the 10^-5 tolerance; Example 1 → 309.5 instead of 309.65.\nStep back to when you dropped the decimals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Fahrenheit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(celsius + 32.00) · 1.80', 'next' => 'wrong_b'],
                ['label' => 'celsius · 1.80 + 32.00', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Multiply first, then add; Example 1 → 123.3 instead of 97.7.\nStep back to when you added 32 first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → [309.65, 97.7], [395.26, 251.798].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
