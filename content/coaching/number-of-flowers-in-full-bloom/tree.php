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
            'message' => "Read the problem statement above.\nPer person?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary search sorted starts and sorted ends', 'next' => 's2'],
                ['label' => 'Scan every flower', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 5 · 10^4 people times 5 · 10^4 flowers is far too slow.\nStep back to when you scanned every flower.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ends to subtract?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ends ≤ t: upper_bound', 'next' => 'wrong_b'],
                ['label' => 'Ends < t: lower_bound', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A flower ending at t is still in bloom; Example 1 → [1,2,1,2] instead of [1,2,2,2].\nStep back to when you used upper_bound on the ends.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Starts to count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Starts ≤ t: upper_bound', 'next' => 'success'],
                ['label' => 'Starts < t: lower_bound', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A flower starting at t is in bloom; Example 1 → [1,1,2,2] instead of [1,2,2,2].\nStep back to when you used lower_bound on the starts.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) log n). Examples → [1,2,2,2], [2,2,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
