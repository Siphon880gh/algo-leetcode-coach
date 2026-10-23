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
            'message' => "Problem: You get a list of email addresses. Two addresses are in the same group when they match after normalizing: in the local part (before @), dots are ignored and everything from the first + on is dropped, and letter case does not matter. Return the number of groups. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nLetter case?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 's2'],
                ['label' => 'Keep it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [\"A.b+x@Mail.com\", \"ab@mail.com\", \"ab@mail.org\"] → 3 instead of 2.\nStep back to when you compared case-sensitively.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Join the parts how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'local + domain', 'next' => 'wrong_b'],
                ['label' => 'local + "@" + domain', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): [\"x.y@a.io\", \"xy+1@a.io\", \"x@ya.io\"] → 1 instead of 2.\nStep back to when you dropped the @.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Constructed checks → 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
