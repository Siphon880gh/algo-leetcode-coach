## Graph on strings, DP on positions

1. Give each distinct string in original and changed an id; d[a][b] = cheapest rule; Floyd–Warshall (only same-length strings connect).
2. dp[0] = 0. From i: if source[i] = target[i], `dp[i + 1] = min(dp[i + 1], dp[i])`; for each rule length L, if source[i … i + L − 1] and target[i … i + L − 1] are both nodes, `dp[i + L] = min(…, dp[i] + d)`.
3. Return dp[n], or −1.

Examples → 28, 9, −1.

Operations may only be disjoint or exactly repeated on the same range, which is why each piece is converted as a whole. A trie or hashing of substrings speeds up step 2.

Time: O(N³ + n · L · len)  
Space: O(N² + n)

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
