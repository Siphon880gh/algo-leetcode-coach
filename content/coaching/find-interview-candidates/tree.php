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
            'message' => "Problem: A contests table lists, per contest, the user ids of the gold, silver and bronze medallists; a users table gives each user's name and mail. Report the users who either won a medal of any kind in at least three consecutive contests, or won gold in at least three contests (not necessarily consecutive), with the columns the statement specifies. For instance, a user with bronze, gold, silver in contests 190, 191, 192 qualifies; so does one with golds in 190, 193 and 196; one with medals only in 192 and 193 does not. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nMedal rows how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'UNION ALL of the three medal columns', 'next' => 's2'],
                ['label' => 'Only the gold column', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The streak rule counts any medal.\nStep back to when you used gold only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Three consecutive contests?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT ≥ 3 per user', 'next' => 'wrong_b'],
                ['label' => 'Self-join on contest + 1 and contest + 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That ignores consecutiveness.\nStep back to when you just counted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Users qualifying both ways?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Report once', 'next' => 'success'],
                ['label' => 'Report twice', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Combine the sets without duplicates.\nStep back to when you repeated them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → the two qualifying patterns only.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
