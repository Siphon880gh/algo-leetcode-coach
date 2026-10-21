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
            'message' => "Read the problem statement above.\nWhich match to use?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The earliest one', 'next' => 's2'],
                ['label' => 'Any match', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A later match wastes room for later groups.\nStep back to when you picked any match.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After a match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Advance one index', 'next' => 'wrong_b'],
                ['label' => 'Jump past the whole group', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Groups must be disjoint.\nStep back to when you advanced by one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Group order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Must follow groups order', 'next' => 'success'],
                ['label' => 'Any order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 2 fails only because of order.\nStep back to when you reordered groups.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(len(nums) · total group length). Examples → true, false, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
