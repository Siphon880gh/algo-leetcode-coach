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
            'message' => "Read the problem statement above.\nUse k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, allow k heavy edges', 'next' => 's2'],
                ['label' => 'No, take the bottleneck path', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 5 instead of 4.\nStep back to when you ignored k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Heavy means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'w ≥ threshold', 'next' => 'wrong_b'],
                ['label' => 'w > threshold', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 5 instead of 4.\nStep back to when you counted equal weights as heavy.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) log m). Examples → 4, −1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
