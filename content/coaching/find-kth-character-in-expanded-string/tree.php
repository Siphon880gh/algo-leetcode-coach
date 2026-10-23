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
            'message' => "Problem: You get a string of lowercase words separated by single spaces. Each word is expanded by writing its first letter once, its second letter twice, its third three times, and so on; the single spaces stay. Given a valid index k into the expanded string, return the character there, which may be a space. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nSkip a word when k > m?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k −= m + 1 (word and space)', 'next' => 's2'],
                ['label' => 'k −= m', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Made-up \"ab cd\", k = 4 → \"d\" instead of \"c\".\nStep back to when you dropped the space.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When k = m?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move on to the next word', 'next' => 'wrong_b'],
                ['label' => 'Return the space', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Made-up \"ab cd\", k = 3 → \"c\" instead of \" \".\nStep back to when you skipped the space.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|s|). Constructed checks → \"c\", \" \", \"z\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
