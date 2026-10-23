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
            'message' => "Problem: Each worker has a skill level, and each task has a required skill and a profit. A worker can do at most one task, and only one whose requirement equals their skill. One extra worker can do any single task. Return the largest total profit. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nExtra worker first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, last: the best leftover', 'next' => 's2'],
                ['label' => 'Yes: the most profitable task', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. workers = [1], tasks = [[1, 10], [1, 1], [2, 5]] → 11 instead of 15.\nStep back to when you served the extra worker first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Everyone matched?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The extra worker is idle', 'next' => 'wrong_b'],
                ['label' => 'The extra worker still takes a leftover', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. workers = [5], tasks = [[2, 8]] → 0 instead of 8.\nStep back to when you idled the extra worker.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) log m). Checks → 20, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
