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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Mine: X and stop. Empty: count adjacent mines', 'next' => 's2'],
                ['label' => 'Always flood fill from the click', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Clicking a mine ends the game: mark it X and stop.\nStep back to when you expanded from a mine.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "E with c adjacent mines.\nc > 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Write str(c) and keep expanding', 'next' => 'wrong_b'],
                ['label' => 'Write str(c) and stop', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Numbered cells stop the spread. Expanding them reveals too much.\nStep back to when you kept expanding.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "c == 0: write B and reveal every adjacent E. Writing B or a digit marks it visited. O(m n).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'X on mine; digit stops; B spreads; 8 neighbors', 'next' => 'success'],
                ['label' => 'Count and spread in 4 directions', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Neighbors include diagonals. With 4 directions, counts and spreading are wrong.\nStep back to when you used 4 directions.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Three rules, 8 neighbors, digits stop the spread.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
