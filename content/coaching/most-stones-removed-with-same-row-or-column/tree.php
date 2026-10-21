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
            'message' => "Read the problem statement above.\nHow many stones can a connected group of k lose?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k − 1', 'next' => 's2'],
                ['label' => 'k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The last stone has no partner left to share a line with.\nStep back to when you removed all k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you build the groups efficiently?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare every pair of stones', 'next' => 'wrong_b'],
                ['label' => 'Union each stone\'s row with its column', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is O(n²); uniting lines is near linear.\nStep back to when you compared pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Row 3 and column 3 share an id?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: give columns their own id range', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. They are different lines.\nStep back to when you merged the ids.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n α(n)). [[0,0],[0,1],[1,0],[1,2],[2,1],[2,2]] → 5. [[0,0],[0,2],[1,1],[2,0],[2,2]] → 3. [[0,0]] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
