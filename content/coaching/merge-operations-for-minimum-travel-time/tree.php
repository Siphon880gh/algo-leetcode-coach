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
            'message' => "Read the problem statement above.\nRate after kept sign c?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sum of time from the previous kept sign + 1 to c', 'next' => 's2'],
                ['label' => 'time[c] alone', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 46 instead of 62.\nStep back to when you ignored merged times.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Merges used?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most k', 'next' => 'wrong_b'],
                ['label' => 'Exactly k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 61 instead of 62.\nStep back to when you allowed fewer merges.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³ · k). Examples → 62, 34.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
