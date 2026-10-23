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
            'message' => 'State:
nums = [3, 1, 5]
target = 6
sum = 0
path = []

First decision on 3?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try both: skip 3 and take 3 (explore two branches)', 'next' => 'after_branch'],
                ['label' => 'Must take 3 because it is first', 'next' => 'w_must'],
            ],
        ],
        'w_must' => [
            'message' => 'Wrong.

Subset sum explores include *and* exclude. Skipping 3 still finds {1,5}.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after_branch' => [
            'message' => 'State:
branch skip-3
sum = 0
next take 1 → sum = 1
next take 5 → sum = 6

Valid subset?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '{1, 5}', 'next' => 'ask_prune'],
                ['label' => '{3, 1} — sums to 4', 'next' => 'w_sub'],
            ],
        ],
        'w_sub' => [
            'message' => 'Wrong.

3+1=4, not 6. The skip-3 path that took 1 then 5 works.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'after_branch',
            'choices' => [],
        ],
        'ask_prune' => [
            'message' => 'State:
path sum already 7, target 6
more numbers left

What next?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prune — stop this branch; sum already too big', 'next' => 'success'],
                ['label' => 'Keep adding — maybe negatives appear later', 'next' => 'w_prune'],
            ],
        ],
        'w_prune' => [
            'message' => 'Wrong.

With non-negative nums, overshooting never recovers. Prune.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_prune',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- Start sum 0; include/exclude each number
- {1,5} hits 6
- Prune when sum exceeds target

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
