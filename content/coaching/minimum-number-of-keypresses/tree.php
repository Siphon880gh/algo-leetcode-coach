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
            'message' => "Problem: A keypad has 9 buttons. You map all 26 lowercase letters to the buttons, each letter to exactly one button and at most 3 letters per button. Typing a letter costs its position on its button: 1 press for the first, 2 for the second, 3 for the third. Given a string s, return the minimum total number of keypresses needed to type it with the best mapping. For instance, apple → 5; abcdefghijkl → 15. (Restated from memory; limits and examples may differ slightly.)\nWhich letters get one press?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The 9 most frequent', 'next' => 's2'],
                ['label' => 'The first 9 of the alphabet', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. apple → 8 instead of 5, since p and l land in two-press slots.\nStep back to when you mapped alphabetically.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cost of the letter ranked i (from 0)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i / 3 + 1', 'next' => 'wrong_b'],
                ['label' => 'i / 9 + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. There are 9 buttons, so 9 slots per cost; abcdefghijkl → 30 instead of 15.\nStep back to when you used groups of 3.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Multiply the cost by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'How often the letter occurs', 'next' => 'success'],
                ['label' => '1 per distinct letter', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. apple → 4 instead of 5, missing the second p.\nStep back to when you counted distinct letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed cases → 5, 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
