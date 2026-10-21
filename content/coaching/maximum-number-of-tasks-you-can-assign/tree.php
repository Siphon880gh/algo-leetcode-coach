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
            'message' => "Read the problem statement above.\nFor a fixed k, which tasks and workers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The k easiest tasks, the k strongest workers', 'next' => 's2'],
                ['label' => 'The k hardest tasks', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. If any k tasks can be done, the k easiest can.\nStep back to when you took the hardest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A worker who needs a pill takes which task?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The easiest open task', 'next' => 'wrong_b'],
                ['label' => 'The hardest task within w + strength', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. tasks [1,3], workers [0,1], 1 pill of strength 3: the answer is 2, but giving the pill holder task 1 leaves task 3 for nobody.\nStep back to when you chose the easiest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Find the best k how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary search: fewer tasks are never harder', 'next' => 'success'],
                ['label' => 'Try only k = min(n, m)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 3 → 2 although 3 tasks and 5 workers exist.\nStep back to when you fixed k.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) log). Examples → 3, 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
