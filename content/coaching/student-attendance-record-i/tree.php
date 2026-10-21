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
            'message' => "Read the problem statement above.\nHow many rules must hold?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two: total A count, and a run of L', 'next' => 's2'],
                ['label' => 'One: count A and L together', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Absences and lates follow different rules: A is counted over the whole record, L only in a row.\nStep back to when you merged the rules.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Absences: what is allowed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Up to 2 absences', 'next' => 'wrong_b'],
                ['label' => 'Fewer than 2: at most one A', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Exactly 2 absences already fails; strictly fewer than 2 is required.\nStep back to when you allowed two.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Lates: how do you check them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '\'LLL\' not in s, or a streak counter reset on any other letter', 'next' => 'success'],
                ['label' => 'Count all L letters and fail at 3', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. LPLPL has three lates but never 3 in a row, so it passes.\nStep back to when you counted every L.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. s.count('A') < 2 and 'LLL' not in s: O(n) time, O(1) space.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
