## Count subsets

1. `dp[0] = 1`, others 0.
2. For each j with `p = j^x ≤ n`: for s from n down to p, `dp[s] += dp[s − p]` (mod 10^9 + 7).
3. Return `dp[n]`.

Examples → 1, 2. Checked against trying every subset for n ≤ 25 and x ≤ 3.

Looping s upward lets one base be used many times: example 2 → 5 instead of 2. There are at most n bases, so the table is at most 300 × 300.

Time: O(n · n^(1/x))  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
