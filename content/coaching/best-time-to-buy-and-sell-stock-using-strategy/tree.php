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
            'message' => "Read the problem statement above.\nInside the window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First half holds, second half sells', 'next' => 's2'],
                ['label' => 'First half sells, second half holds', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 12 instead of 10.\nStep back to when you swapped the halves.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Must you change?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, always apply the best window', 'next' => 'wrong_b'],
                ['label' => 'No, keep the best of 0 and the best gain', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 8 instead of 9.\nStep back to when you always changed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 10, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
