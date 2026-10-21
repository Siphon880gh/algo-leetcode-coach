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
            'message' => "Read the problem statement above.\nSort the window per query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, maintain buckets', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. O(m log m) per call is too slow for 10^5 calls.\nStep back to when you sorted per query.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Track the middle sum how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recompute at query time', 'next' => 'wrong_b'],
                ['label' => 'Update it on every move into or out of mid', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Recomputing is O(m).\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Fewer than m elements?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Average what you have', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement defines −1 for that case.\nStep back to when you averaged early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log m) per add. Example → −1, 3, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
