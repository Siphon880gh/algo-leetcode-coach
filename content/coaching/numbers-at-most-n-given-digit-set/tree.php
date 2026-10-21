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
            'message' => "Read the problem statement above.\nHow many numbers have fewer digits than n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'd + d² + … + d^(L − 1)', 'next' => 's2'],
                ['label' => 'd^(L − 1)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every shorter length counts, not just L − 1.\nStep back to when you used one length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At position i, an allowed digit smaller than n[i] adds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'wrong_b'],
                ['label' => 'd^(L − 1 − i): any digits may follow', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The remaining positions are free.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "n[i] is not an allowed digit. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop: no same-length number can match further', 'next' => 'success'],
                ['label' => 'Skip to the next position', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A number cannot equal n at that position, so the prefix ends there.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(L · d). [\"1\",\"3\",\"5\",\"7\"], 100 → 20. [\"1\",\"4\",\"9\"], 1000000000 → 29523. [\"7\"], 8 → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
