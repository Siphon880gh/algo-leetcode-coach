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
            'message' => "Problem: In an m × n grid, entering cell (i, j) costs (i + 1) · (j + 1), and the path starts by entering (0, 0). Odd-numbered moves must go right or down; even-numbered moves must go left or up. Return the minimum total cost to reach (m − 1, n − 1), or −1 if it cannot be reached. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nCan you always reach the corner?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, only when i + j ≤ 1 there', 'next' => 's2'],
                ['label' => 'Yes, along a right-or-down path', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. (2, 2) → 7 instead of −1.\nStep back to when you assumed it was reachable.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cost on a 1 × 2 grid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 (only the target)', 'next' => 'wrong_b'],
                ['label' => '1 + 2 = 3 (the start is paid too)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. (1, 2) → 2 instead of 3.\nStep back to when you skipped the start.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Checks → 1, 3, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
