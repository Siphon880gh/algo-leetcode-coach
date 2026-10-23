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
            'message' => "Read the problem statement above.\nConvert how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'HH · 3600 + MM · 60 + SS', 'next' => 's2'],
                ['label' => 'Read HHMMSS as one number', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 6544 instead of 1504.\nStep back to when you subtracted the digits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Subtract which way?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'start − end', 'next' => 'wrong_b'],
                ['label' => 'end − start', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → −25 instead of 25.\nStep back to when you subtracted the end time.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 25, 1504.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
