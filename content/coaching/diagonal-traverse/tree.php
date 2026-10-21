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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Group cells by k = i + j, from 0 to m + n − 2', 'next' => 's2'],
                ['label' => 'Walk the borders in rings like Spiral Matrix', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Spiral (54) walks rings around the border. This walks anti-diagonals.\nStep back to when you used the spiral walk.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Diagonal k ≥ n.\nWhere does it start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always at (0, k)', 'next' => 'wrong_b'],
                ['label' => '(k − n + 1, n − 1): on the last column', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Row 0 only has columns up to n − 1. Once k ≥ n, (0, k) is outside the grid.\nStep back to when you started at row 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Walk i += 1, j −= 1 inside the grid; that lists top-right to bottom-left. Reverse it for even k. O(m n).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Group by i + j, correct start, reverse even k. Not 54', 'next' => 'success'],
                ['label' => 'Reverse the odd diagonals', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. k = 2 in the sample goes 7, 5, 3: upward. Even diagonals go up-right, so those get reversed.\nStep back to when you reversed the odd ones.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Anti-diagonals by i + j, starting on the right column when needed, even ones reversed. → [1,2,4,7,5,3,6,8,9].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
