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
nums = [1, 2]
path = []
goal = list all subsets

After choosing take 1, path is?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[1] — then recurse on element 2', 'next' => 'undo'],
                ['label' => '[1, 2] immediately — no recursion', 'next' => 'w_jump'],
            ],
        ],
        'w_jump' => [
            'message' => 'Wrong.

One element per decision. After taking 1, recurse for 2.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'undo' => [
            'message' => 'State:
path = [1]
done exploring under take-1

Before the skip-1 branch?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Undo — pop 1 so path is []', 'next' => 'prune'],
                ['label' => 'Leave [1] — later branches ignore it', 'next' => 'w_leave'],
            ],
        ],
        'w_leave' => [
            'message' => 'Wrong.

Leftover choices pollute siblings. Always undo.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'undo',
            'choices' => [],
        ],
        'prune' => [
            'message' => 'State:
partial sum already 10, target 7
more numbers left (all positive)

Action?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prune — return without deeper recursion', 'next' => 'success'],
                ['label' => 'Keep going — pruning is optional', 'next' => 'w_prune'],
            ],
        ],
        'w_prune' => [
            'message' => 'Wrong.

Dead partial paths waste the whole subtree. Cut them early.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'prune',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- Choose → explore → undo
- Pop before siblings
- Prune illegal partials

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
