## Lengths, not words

1. For each word keep its cheapest cost, grouped by length (hash the strings, or use rolling hashes).
2. dp[0] = 0. From each reachable i, for each distinct length L: if target[i … i + L) is a word, relax dp[i + L].
3. Return dp[n], or −1.

Examples → 7, −1. Distinct lengths: 1 + 2 + … + 315 ≤ 5 · 10^4 < 1 + … + 316.

Always taking the longest matching word: example 1 → 11 instead of 7.

Time: O(n · √L) hash lookups (rolling hash keeps each O(1))  
Space: O(n + L)

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
