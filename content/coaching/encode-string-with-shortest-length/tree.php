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
            'message' => "Problem: lowercase s, length 1 to 150. Encode as k[encoded] to make it shortest; do not encode if it does not save length. \"aaa\" → \"aaa\". \"aaaaa\" → \"5[a]\". \"aabcaabcd\" → \"2[aabc]d\". \"abbbabbbcabbbabbbc\" → \"2[2[abbb]c]\". (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Interval DP: best encoding of every substring s[i..j]', 'next' => 's2'],
                ['label' => 'Greedily replace the longest repeat you see, left to right', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Greedy collapse of the first repeat found can block a better nesting later. Shortest needs every option compared.\nStep back to when you collapsed greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For s[i..j], start with the raw string, then try every split f[i][k] + f[k + 1][j].\nWhat else can win?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing; splits are enough', 'next' => 'wrong_b'],
                ['label' => 'If s[i..j] has period p (find it in doubled string), try count[f[i][i + p − 1]]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Splits alone never produce k[...]. \"aaaaa\" needs the repeat form.\nStep back to when you only tried splits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The inner part uses its own best encoding, which is how nesting appears. Substrings shorter than 5 cannot gain. O(n³) time.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Raw, splits, and repeat with inner f; keep strictly shorter. Not 394', 'next' => 'success'],
                ['label' => 'Encode "aaaa" as "4[a]"', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. \"4[a]\" is 4 characters, same as \"aaaa\". The rule says do not encode when it is not shorter.\nStep back to when you encoded a tie.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Interval DP with raw, split, and repeat candidates, inner parts encoded too. \"aaaaa\" → \"5[a]\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
