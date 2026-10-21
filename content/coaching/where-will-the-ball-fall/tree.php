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
            'message' => "Read the problem statement above.\nNext column?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c + grid[r][c]', 'next' => 's2'],
                ['label' => 'c + grid[r + 1][c]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The board in the current cell redirects the ball.\nStep back to when you used the next row.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stuck when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only at walls', 'next' => 'wrong_b'],
                ['label' => 'Out of range, or grid[r][nc] ≠ grid[r][c]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A V shape traps it too.\nStep back to when you ignored V shapes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output for a stuck ball?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1', 'next' => 'success'],
                ['label' => 'Its last column', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Stuck balls report −1.\nStep back to when you returned a column.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → [1,-1,-1,-1,-1], [-1], [0,1,2,3,4,-1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
