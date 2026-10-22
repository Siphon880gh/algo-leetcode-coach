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
            'message' => "Read the problem statement above.\nBefore counting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Split where adjacent letters differ by more than 2', 'next' => 's2'],
                ['label' => 'Use the whole word', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. aaxx with k = 2 → 3 instead of 2.\nStep back to when you skipped the split.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Window counts when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every letter at most k times', 'next' => 'wrong_b'],
                ['label' => 'Every present letter exactly k times', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 9 instead of 3.\nStep back to when you allowed fewer than k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 · 26 · n). Examples → 3, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
