## Suffix maxima over d

1. For each element v and d = 0 … 300: new[d] = 1 + max(dp[v − d][d], dp[v + d][d]) over values already seen.
2. Fold suffix maxima: dp[v][d] = max(dp[v][d], 1, max over d′ ≥ d of new[d′]).
3. Answer the largest new[d] (at least 1).

Examples → 3, 4, 5. Checked against every subsequence on 300 random arrays.

Using contiguous subarrays instead of subsequences: example 2 → 3 instead of 4.

Time: O(n · V), V = 300, about 3 · 10^6  
Space: O(V²)

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
