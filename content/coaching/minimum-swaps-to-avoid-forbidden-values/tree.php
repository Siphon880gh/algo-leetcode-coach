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
            'message' => "Read the problem statement above.\nFirst?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check that each value fits outside its forbidden spots', 'next' => 's2'],
                ['label' => 'Skip the check', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → 1 instead of −1.\nStep back to when you skipped feasibility.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '⌈B / 2⌉', 'next' => 'wrong_b'],
                ['label' => 'max(⌈B / 2⌉, the largest bad count of one value)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): nums = [2, 1, 2, 3, 1], forbidden = [3, 1, 3, 2, 1] → 1 instead of 2.\nStep back to when you used ⌈B / 2⌉ alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 2, −1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
