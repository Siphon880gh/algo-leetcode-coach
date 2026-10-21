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
            'message' => "Problem: Given a list of words, find the longest word such that every one of its prefixes is also in the list; on ties return the lexicographically smallest, and return an empty string if there is none. For instance, [k, ki, kir, kira, kiran] → \"kiran\"; [a, banana, app, appl, ap, apply, apple] → \"apple\"; [abc, bc, ab, qwe] → \"\". (Restated from memory; limits and examples may differ slightly.)\nWhich prefixes must exist?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every proper prefix', 'next' => 's2'],
                ['label' => 'Only the one-letter prefix', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each intermediate prefix must be a word.\nStep back to when you checked one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tie on length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First seen wins', 'next' => 'wrong_b'],
                ['label' => 'Lexicographically smaller wins', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Input order is not the tie-break.\nStep back to when you kept the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No word qualifies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return ""', 'next' => 'success'],
                ['label' => 'Return the shortest word', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer is empty then.\nStep back to when you returned a word.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → \"kiran\", \"apple\", \"\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
