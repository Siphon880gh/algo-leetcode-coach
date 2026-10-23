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
            'message' => "Read the problem statement above.\nLetter at the first changed position?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest remaining letter > target[i]', 'next' => 's2'],
                ['label' => 'Smallest remaining letter ≥ target[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → \"bbaa\", which is not greater.\nStep back to when you allowed equal.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which prefix length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The shortest one (change position 0)', 'next' => 'wrong_b'],
                ['label' => 'The longest one that works', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → \"cab\" instead of \"bca\".\nStep back to when you changed position 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → \"bca\", \"eelt\", \"\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
