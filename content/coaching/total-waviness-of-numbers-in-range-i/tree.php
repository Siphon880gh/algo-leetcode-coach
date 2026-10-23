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
            'message' => "Read the problem statement above.\nWhich digits can score?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Inner digits only', 'next' => 's2'],
                ['label' => 'End digits too, against their one neighbor', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 24 instead of 3.\nStep back to when you scored the ends.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What scores?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Peaks only', 'next' => 'wrong_b'],
                ['label' => 'Peaks and valleys', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 1 instead of 3.\nStep back to when you skipped valleys.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((num2 − num1 + 1) · log num2). Examples → 3, 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
