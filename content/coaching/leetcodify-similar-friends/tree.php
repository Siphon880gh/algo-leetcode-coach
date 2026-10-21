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
            'message' => "Problem: A listens table records which user listened to which song on which day; a friendship table lists pairs of friends. Report the friend pairs (as stored in the friendship table) who listened to at least three of the same songs on the same day, as the statement specifies, using the column names it gives. For instance, with friends 1–2, 1–4 and 3–5: if 1 and 2 hear songs 10, 11, 12 on one day, 4 shares only two of them, and 3 and 5 hear the same three songs on different days, only (1, 2) is reported. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nStart from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The friendship table', 'next' => 's2'],
                ['label' => 'All pairs of listeners', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only friend pairs can qualify.\nStep back to when you paired all listeners.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shared songs counted per?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pair only', 'next' => 'wrong_b'],
                ['label' => 'Pair and day', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Songs on different days do not combine.\nStep back to when you dropped day.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Repeated listens to one song?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(DISTINCT song)', 'next' => 'success'],
                ['label' => 'COUNT(*)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Replays would inflate the count.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → only (1, 2).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
