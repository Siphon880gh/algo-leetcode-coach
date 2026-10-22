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
            'message' => "Read the problem statement above.\nA character matches when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It equals the letter or its next letter does', 'next' => 's2'],
                ['label' => 'Only when it equals the letter', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Increments are ignored; example 1 → false instead of true.\nStep back to when you required equality.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The letter after z is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The character after z in ASCII', 'next' => 'wrong_b'],
                ['label' => 'a', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The cycle breaks; example 2 → false instead of true.\nStep back to when you skipped the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → true, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
