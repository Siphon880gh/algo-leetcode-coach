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
            'message' => "Read the problem statement above.\nWhich date matters for each player?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Their first login: MIN(event_date)', 'next' => 's2'],
                ['label' => 'Any two logins on consecutive days', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only the day right after the first login counts; later back-to-back logins do not.\nStep back to when you used any consecutive pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you test the next day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'INNER JOIN on DATEDIFF = 1, then count the rows', 'next' => 'wrong_b'],
                ['label' => 'LEFT JOIN Activity on DATEDIFF(b.event_date, a.event_date) = 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An inner join drops the players who did not come back, so you lose the denominator.\nStep back to when you used an inner join.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Now the fraction.",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROUND(AVG(b.event_date IS NOT NULL), 2)', 'next' => 'success'],
                ['label' => 'Divide by COUNT(*) over all of Activity', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Activity has one row per player per day; the denominator is the number of players.\nStep back to when you divided by all rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. First date per player, left join one day later, average the hits. One row per player keeps the denominator right.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
