## Non-decreasing search

1. ds = divisors of n, ascending.
2. dfs(rem, parts, lo): if parts = 1, rem is the last factor (if rem ≥ lo); compare last − first with the best.
3. Otherwise for d in ds with d ≥ lo and d^parts ≤ rem: if d divides rem, dfs(rem / d, parts − 1, d).

Examples → [10, 10], [2, 2, 11]. Checked against every ordered split on 300 random cases. For n = 83,160 (128 divisors) and k = 5 the search makes 2,049 calls.

Greedy (the largest divisor ≤ the k-th root of what remains, then repeat): n = 68, k = 3 → [4, 1, 17] (difference 16) instead of [2, 2, 17] (15).

Time: O(D^(k − 1)) for D divisors, far less in practice  
Space: O(k)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
