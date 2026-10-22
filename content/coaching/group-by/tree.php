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
            'message' => "Read the problem statement above.\nHow to define groupBy?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A regular function on Array.prototype', 'next' => 's2'],
                ['label' => 'An arrow function', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. An arrow function does not bind this to the array; in Node Example 1 → a TypeError instead of the grouping.\nStep back to when you used an arrow.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "An item whose key already has a group?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Set the key to a new one-item array', 'next' => 'wrong_b'],
                ['label' => 'Push it onto that array', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That throws away earlier items; Example 1 → key 1 holds one item instead of two.\nStep back to when you replaced the array.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → the three groupings in the statement.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
