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
            'message' => "Problem: You get a lowercase string that may contain the English words for digits, zero to nine, run together. Read it left to right: when a digit word starts at the current position, write its digit and jump past the word; otherwise skip one character. Return the digits written, or an empty string if none. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nAfter a match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Jump past the word', 'next' => 's2'],
                ['label' => 'Keep scanning from the next character', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Made-up \"eightwo\" → \"82\" instead of \"8\".\nStep back to when you allowed overlaps.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No words found?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return "0"', 'next' => 'wrong_b'],
                ['label' => 'Return ""', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Made-up \"xyz\" → \"0\" instead of \"\".\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → \"29\", \"8\", \"6\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
