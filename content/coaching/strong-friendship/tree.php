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
            'message' => "Problem: A friendship table lists pairs of friends, each stored once (typically with the smaller id first). A friendship is strong if the two users have at least three common friends, as the statement specifies. Report each strong friendship with its number of common friends, using the column names the statement gives. For instance, with friendships 1–2, 1–3, 1–4, 1–5, 2–3, 2–4, 2–5, 1–6, 3–6, 6–7, only 1–2 is strong, with 3 common friends. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nFriend lists from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both stored directions', 'next' => 's2'],
                ['label' => 'Only user1 → user2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Friends stored on the other side would be missed.\nStep back to when you used one direction.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pairs to report?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any two users with common friends', 'next' => 'wrong_b'],
                ['label' => 'Actual friendships only', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only friendships can be strong.\nStep back to when you paired everyone.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Threshold?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At least three common friends', 'next' => 'success'],
                ['label' => 'More than three', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Exactly three qualifies.\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → (1, 2, 3).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
