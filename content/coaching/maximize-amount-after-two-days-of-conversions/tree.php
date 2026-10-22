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
            'message' => "Read the problem statement above.\nGraph edges?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both directions (rate and 1 / rate)', 'next' => 's2'],
                ['label' => 'Given direction only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 1 instead of 1.5.\nStep back to when you dropped the reverse.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Day-2 trip back from c?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a[c] · b[c]', 'next' => 'wrong_b'],
                ['label' => 'a[c] / b[c]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 54 instead of 1.5.\nStep back to when you multiplied.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → 720, 1.5, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
