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
            'message' => "Problem: A cinema table lists seats by consecutive id, with a flag saying whether each seat is free. Return every free seat that is next to another free seat, ordered by seat id. For instance, if seats 1, 3, 4, 5 are free, the answer is 3, 4, 5. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhich seats qualify?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Free seats with at least one free neighbor, on the left or the right', 'next' => 's2'],
                ['label' => 'Free seats whose right neighbor is free', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The last seat of a run (5 in the example) has its free neighbor on the left.\nStep back to when you looked only right.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What do you self-join on?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a.seat_id = b.seat_id, with both free', 'next' => 'wrong_b'],
                ['label' => 'ABS(a.seat_id − b.seat_id) = 1, with both seats free', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That pairs each seat with itself, so every free seat would qualify.\nStep back to when you joined on equal ids.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A middle seat matches both neighbors. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SELECT DISTINCT, ordered by seat_id', 'next' => 'success'],
                ['label' => 'Keep the duplicate rows', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each seat must appear once in the output.\nStep back to when you kept duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Self-join on neighbors, both free, DISTINCT and ordered: O(n) with an index.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
