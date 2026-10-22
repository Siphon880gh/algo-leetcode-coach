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
            'message' => "Read the problem statement above.\nDistances from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every pair of fences', 'next' => 's2'],
                ['label' => 'Adjacent fences only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Removing fences joins gaps; example 1 → 1 instead of 4.\nStep back to when you used adjacent fences.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Field borders?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use only the given fences', 'next' => 'wrong_b'],
                ['label' => 'Add 1 and m (or n) as fences', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The borders bound the square too; example 1 → −1 instead of 4.\nStep back to when you left the borders out.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(h² + v²). Examples → 4, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
