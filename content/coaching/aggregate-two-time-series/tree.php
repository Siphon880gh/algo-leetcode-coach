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
            'message' => "Read the problem statement above.\nMissing value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Next value in that series, else 0', 'next' => 's2'],
                ['label' => 'Previous value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [[1, 3], [2, 5], [4, 3], [5, 3]].\nStep back to when you carried values forward.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which timestamps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only series1\'s', 'next' => 'wrong_b'],
                ['label' => 'Every timestamp in either series', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [[1, 5], [4, 3]].\nStep back to when you used one series.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n1 + n2). Examples → [[1, 5], [2, 3], [4, 3], [5, 2]], [[1, 7], [2, 3], [3, 1]], [[1, 7], [10^9, 2]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
