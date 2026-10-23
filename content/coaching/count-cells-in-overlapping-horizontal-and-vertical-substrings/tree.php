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
            'message' => "Read the problem statement above.\nMatches may wrap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, flatten rows and columns into one string each', 'next' => 's2'],
                ['label' => 'No, search each row and column separately', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 0 instead of 1.\nStep back to when you stopped at line ends.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count which cells?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Covered by either', 'next' => 'wrong_b'],
                ['label' => 'Covered by both a horizontal and a vertical match', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 9 instead of 1.\nStep back to when you counted either.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n + |pattern|). Examples → 1, 4, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
