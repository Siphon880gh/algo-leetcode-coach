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
            'message' => "Read the problem statement above.\nFill each shelf as full as possible?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a tall book may be better on the next shelf', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Greedy filling can raise the total height.\nStep back to when you filled greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "dp[i] means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Height of the shelf holding book i', 'next' => 'wrong_b'],
                ['label' => 'Least height for the first i books', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The state covers all shelves so far.\nStep back to when you used one shelf.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Growing the last shelf leftward, the width exceeds shelfWidth. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop extending', 'next' => 'success'],
                ['label' => 'Skip that book', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Books stay in order; you cannot skip one.\nStep back to when you skipped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [[1,1],[2,3],[2,3],[1,1],[1,1],[1,1],[1,2]], width 4 → 6. [[1,3],[2,4],[3,2]], width 6 → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
