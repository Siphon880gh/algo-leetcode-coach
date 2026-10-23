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
            'message' => "Read the problem statement above.\nThe \"xx\" cards?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Share them between both sides; try every split', 'next' => 's2'],
                ['label' => 'Leave them out', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 1 instead of 2.\nStep back to when you left them out.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pairs on one side?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '⌊T / 2⌋', 'next' => 'wrong_b'],
                ['label' => 'min(⌊T / 2⌋, T − M)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [\"ab\", \"ab\"], x = \"a\" → 1 instead of 0.\nStep back to when you ignored the largest class.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
