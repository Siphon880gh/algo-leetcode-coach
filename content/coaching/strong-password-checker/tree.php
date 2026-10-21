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
                ['label' => 'Fix each rule on its own and add the counts, or BFS over all edits', 'next' => 'wrong_a'],
                ['label' => 'Split by length: under 6, 6 to 20, over 20. Let one edit fix several rules', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. BFS over edits explodes, and fixing rules one at a time double counts: one replace can break a run and add a missing type at once.\nStep back to when you fixed each rule separately or searched all edits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Let types = how many of lower, upper, digit already appear. A run of length L needs floor(L / 3) replaces. Under 6: max(6 − n, 3 − types). 6 to 20: max(total replaces, 3 − types).\nWhat changes when n > 20?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − 20 deletes are forced. Spend them on runs with L % 3 == 0 first, then L % 3 == 1, then 3 at a time', 'next' => 's3'],
                ['label' => 'Delete from any run in any order, then count replaces as before', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Deletes that land in the wrong run do not remove a replace. A run of length 3 needs 1 replace; one delete there saves it. A run of length 4 needs 2 deletes to save one replace.\nStep back to when you chose which runs get the deletes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After spending deletes, answer = (n − 20) + max(remaining replaces, 3 − types). Strong Password Checker II (2299) only tests a password; it does not count edits. O(n) time, O(1) space.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Three length regimes. Mod-3 deletes over 20. Not 2299', 'next' => 'success'],
                ['label' => 'Under 6, answer is (6 − n) + (3 − types)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Inserts can cover length and missing types together when n < 6. \"a\" needs 5 inserts, and those inserts can supply the uppercase and digit. The answer is max(6 − n, 3 − types), not the sum.\nStep back to when you added the two counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Three length regimes, replaces break runs and add missing types, and over 20 the forced deletes go to runs by L mod 3 first. \"a\" → 5. \"aA1\" → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
