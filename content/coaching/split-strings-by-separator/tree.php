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
            'message' => "Read the problem statement above.\nSplit with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A literal split on the character', 'next' => 's2'],
                ['label' => 'A regular expression built from it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. . | \$ are regex symbols; in Python, re.split on . turns example 1 into [].\nStep back to when you used a regex.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keep which pieces?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All of them', 'next' => 'wrong_b'],
                ['label' => 'Nonempty ones', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Edge separators leave empties; example 2 → ['', easy, '', '', problem, ''].\nStep back to when you kept empties.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Examples → [one, two, three, four, five, six], [easy, problem], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
