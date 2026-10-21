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
            'message' => "Problem: A teams table gives team ids and names; a matches table records the home and away team ids and each side's goals. Report per team the matches played, points (as the statement defines them, typically 3 for a win, 1 for a draw, 0 for a loss), goals for, goals against and goal difference, ordered as the statement specifies (typically by points, then goal difference, then name). For instance, with Ajax losing 0–1 to Dortmund, drawing 3–3 with Arsenal, losing 2–5 at Dortmund and drawing 0–0 at Arsenal, Ajax has 4 games, 2 points, 5 for, 9 against. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCombine home and away rows with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'UNION ALL', 'next' => 's2'],
                ['label' => 'UNION', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. UNION drops identical rows, such as two 0–0 draws.\nStep back to when you used UNION.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Away-side goals for?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The home goals column', 'next' => 'wrong_b'],
                ['label' => 'The away goals column', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Swap sides for the away view.\nStep back to when you kept the home goals.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Points?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'CASE on gf vs ga, using the statement\'s values', 'next' => 'success'],
                ['label' => 'COUNT of wins only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Draws also score.\nStep back to when you counted wins.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → Dortmund 6, Arsenal 2, Ajax 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
