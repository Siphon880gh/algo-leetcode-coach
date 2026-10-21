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
            'message' => "Read the problem statement above.\nSearch space?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All integer points 0 … 50', 'next' => 's2'],
                ['label' => 'Only tower positions', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The best point may not hold a tower.\nStep back to when you used tower positions.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Floor applies to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The total', 'next' => 'wrong_b'],
                ['label' => 'Each tower\'s term', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement floors each signal.\nStep back to when you floored the sum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Tie-break?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest (x, y): scan x then y, update only on >', 'next' => 'success'],
                ['label' => 'Last found', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Lexicographically smallest wins.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(51² · T). Examples → [2,1], [23,11], [1,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
