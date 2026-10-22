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
            'message' => "Read the problem statement above.\nCount ones how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Once per row and column, before filling diff', 'next' => 's2'],
                ['label' => 'Recount the row and column for every cell', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That costs O(m · n · (m + n)); a 1 × 10^5 grid needs about 10^10 steps.\nStep back to when you recounted per cell.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "diff[i][j]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'onesRow[i] + onesCol[j] − m − n', 'next' => 'wrong_b'],
                ['label' => '2 · onesRow[i] + 2 · onesCol[j] − m − n', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The zeros are n − onesRow and m − onesCol, so the ones count twice; Example 2 → 0 instead of 5.\nStep back to when you added the ones once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → [[0,0,4],[0,0,4],[−2,−2,2]], [[5,5,5],[5,5,5]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
