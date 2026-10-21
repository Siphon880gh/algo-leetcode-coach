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
            'message' => "Problem: A candidates table gives each candidate's years of experience and an interview id; a rounds table gives the score of each round of each interview. Report the ids of candidates who have at least the years of experience the statement requires and whose total score over all rounds of their interview is above the threshold it gives. For instance, with sample thresholds of 2 years and a total above 15: a candidate with 3 years and rounds 9 + 8 is accepted, one with 1 year and 10 + 10 is not, and one with 4 years and 7 + 8 is not. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin candidates to rounds on?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The interview id', 'next' => 's2'],
                ['label' => 'The candidate id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Rounds are recorded per interview, not per candidate.\nStep back to when you joined on the candidate.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A candidate's score?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The best single round', 'next' => 'wrong_b'],
                ['label' => 'SUM over all rounds of the interview', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The total over rounds is compared with the threshold.\nStep back to when you took the maximum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Where does the score test go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'HAVING, after GROUP BY', 'next' => 'success'],
                ['label' => 'WHERE', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. WHERE runs before grouping and cannot see SUM.\nStep back to when you put it in WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → the first candidate only.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
