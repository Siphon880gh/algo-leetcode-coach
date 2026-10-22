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
            'message' => "Read the problem statement above.\nA query matches a word when the mismatches are?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '≤ 2', 'next' => 's2'],
                ['label' => '< 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Two edits are allowed; Example 1 → [word, wood] instead of [word, note, wood].\nStep back to when you made it strict.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After a query matches?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep checking and add it for every match', 'next' => 'wrong_b'],
                ['label' => 'Add it once and move to the next query', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. queries = [wood], dictionary = [wood, good] → [wood, wood] instead of [wood].\nStep back to when you kept adding.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(q · d · n). Examples → [word, note, wood], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
