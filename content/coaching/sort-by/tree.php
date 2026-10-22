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
            'message' => "Read the problem statement above.\nCall sort how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'With (a, b) => fn(a) − fn(b)', 'next' => 's2'],
                ['label' => 'With no comparator', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The default sort compares strings; in Node example 3 → [[10, 1], [3, 4], [5, 2]] instead of [[10, 1], [5, 2], [3, 4]].\nStep back to when you left out the comparator.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The comparator returns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'fn(a) > fn(b), a boolean', 'next' => 'wrong_b'],
                ['label' => 'fn(a) − fn(b), a number', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. true and false are not negative; in Node [2, 1] stays [2, 1].\nStep back to when you returned a boolean.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [1, 2, 3, 4, 5], [{x: −1}, {x: 0}, {x: 1}], [[10, 1], [5, 2], [3, 4]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
