Given n, m and k, count the arrays of length n with values from 1 to m in which exactly k adjacent pairs satisfy a parity condition on the two values, modulo 10^9 + 7. The exact condition and limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Parity DP

This assumes the condition holds exactly when both neighbours are even (as it does for a · b − a − b being even); check the official expression.

1. E = ⌊m/2⌋, O = m − E; dp[j][even?] after the first value: E at (0, even), O at (0, odd).
2. Next value even: from even j → j + 1, from odd j → j (× E). Next value odd: j stays (× O).
3. Answer dp[k][even] + dp[k][odd].

Constructed checks (run in code): n = 3, m = 3, k = 1 → 4; n = 4, m = 5, k = 2 → 48. Checked against every array for n ≤ 5, m ≤ 4.

Counting pairs of odd neighbours instead: n = 3, m = 3, k = 1 → 8 instead of 4.

Time: O(n · k)  
Space: O(k)

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
