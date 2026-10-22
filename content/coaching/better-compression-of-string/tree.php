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
            'message' => "Problem: You are given a compressed string of letter–count pairs, in which a letter may appear in several pairs and counts can have several digits. Return the better compression the statement describes, with each letter appearing once alongside its total count. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nRead a count how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every digit after the letter', 'next' => 's2'],
                ['label' => 'One digit', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. c2b3a1b12 → a1b4c2 instead of a1b15c2.\nStep back to when you read one digit.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Repeated letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep each pair', 'next' => 'wrong_b'],
                ['label' => 'Add their counts', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. a3c9b2c1 would list c twice instead of a3b2c10.\nStep back to when you kept the pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The guide’s checks → a3b2c10, a1b15c2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
