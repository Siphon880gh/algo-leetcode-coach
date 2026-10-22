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
            'message' => "Read the problem statement above.\nLook for the reverse where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Among earlier words', 'next' => 's2'],
                ['label' => 'In the whole set, then halve', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A palindrome matches itself; [aa, bb] → 1 instead of 0.\nStep back to when you used the whole set.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Add the word to seen when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before checking it', 'next' => 'wrong_b'],
                ['label' => 'After checking it', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. zz then finds itself; example 1 → 3 instead of 2.\nStep back to when you added first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
