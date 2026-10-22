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
            'message' => "Problem: Same game as part I: split word into numFriends non-empty pieces in every possible way and return the lexicographically largest piece that ever appears. This version allows a much longer word. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nCut what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest suffix', 'next' => 's2'],
                ['label' => 'The word itself', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. bcad, numFriends = 2 → bca instead of d.\nStep back to when you cut the word.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One friend?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same rule', 'next' => 'wrong_b'],
                ['label' => 'Return the whole word', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. abz, numFriends = 1 → z instead of abz.\nStep back to when you used the rule.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The guide’s checks → dbc, g.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
