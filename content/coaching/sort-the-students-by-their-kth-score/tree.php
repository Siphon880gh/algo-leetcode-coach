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
            'message' => "Read the problem statement above.\nWhat do you sort?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whole rows by column k', 'next' => 's2'],
                ['label' => 'Column k on its own', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Scores move away from their students; Example 2 → [[5,4],[3,6]] instead of [[5,6],[3,4]].\nStep back to when you sorted the column alone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lowest first', 'next' => 'wrong_b'],
                ['label' => 'Highest first', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The best score comes first; Example 2 → [[3,4],[5,6]] instead of [[5,6],[3,4]].\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m log m + m · n). Examples → [[7,5,11,2],[10,6,9,1],[4,8,3,15]], [[5,6],[3,4]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
