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
            'message' => "Problem: You get the root of a binary tree whose values can be negative. The tree is stable when every parent and child differ by at most 1. One operation adds or subtracts 1 at any node. Return the fewest operations that make the tree stable. Example: root = [5, 8, 3] needs 3 (8 down to 6 and 3 up to 4). There are up to 5 × 10^4 nodes with values in [−10^5, 10^5].\nExample 2, root = [2, −1, −4]. Keep the root at 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, the root may move too', 'next' => 's2'],
                ['label' => 'Yes, fix the children only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Moving the root to −2 costs 4 and leaves 1 for −4, total 5. Keeping the root gives 7.\nStep back to when you froze the root.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A child's cost is a convex function g(y). The parent at x allows y in [x − 1, x + 1]. What happens to g?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It shifts right by 1', 'next' => 'wrong_b'],
                ['label' => 'Its flat bottom widens by 1 on each side', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The parent may pick y one below or one above, so both sides of the minimum move outward.\nStep back to when you shifted one way.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Slope trick with two heaps, lazy shifts and small-into-large merges. O(n log² n). Examples give 3, 5 and 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
