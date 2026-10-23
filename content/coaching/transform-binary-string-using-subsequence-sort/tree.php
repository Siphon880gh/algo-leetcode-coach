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
            'message' => "Read the problem statement above.\nFill the '?' slots how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Needed ones in the last slots', 'next' => 's2'],
                ['label' => 'Needed ones in the first slots', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): s = \"01\", pattern \"??\" → false instead of true.\nStep back to when you used the first slots.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ones move which way?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left: t\'s prefixes have at least s\'s ones', 'next' => 'wrong_b'],
                ['label' => 'Right: t\'s prefixes have at most s\'s ones', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → [false, false, false] instead of [true, false, true].\nStep back to when you moved ones left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · |strs|). Examples → [true, true, false], [true, false, true], [true].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
