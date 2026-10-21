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
                ['label' => 'DP over intervals, with extra state', 'next' => 's2'],
                ['label' => 'Greedy: remove the largest group first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Taking the biggest group first can block merges. In the example, removing 2,2,2 first lets three 3s meet.\nStep back to when you used greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "f(i, j) alone.\nIs that enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, interval DP f(i, j) is enough', 'next' => 'wrong_b'],
                ['label' => 'No: add k = boxes of boxes[j]\'s color attached after j', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The best inside depends on how many same-colored boxes will join from outside. f(i, j) cannot see them.\nStep back to when you used two indexes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Option 1: dfs(i, j − 1, 0) + (k + 1)². Option 2: for h with boxes[h] == boxes[j]: dfs(h + 1, j − 1, 0) + dfs(i, h, k + 1). Memoize. O(n⁴).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dfs(i, j, k) with (k + 1)² and merge options', 'next' => 'success'],
                ['label' => 'Score 1 point per removed box', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Points grow with the square; 3 + 3 is less than 9 for a group of 3.\nStep back to when you scored per box.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Interval DP with attached count, squared scores. → 23.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
