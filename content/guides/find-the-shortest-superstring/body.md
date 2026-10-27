## A traveling-salesman-style DP

No word is a substring of another, so each word appears as its own piece and only the order matters.

1. `overlap[i][j]` = the longest suffix of `words[i]` that is a prefix of `words[j]`.
2. `dp[mask][last]` = the largest total overlap for an order of the words in `mask` that ends with `last`. Start with `dp[1 << i][i] = 0`.
3. For each `mask`, `last` in `mask`, and `nxt` not in `mask`: `dp[mask | 1 << nxt][nxt] = max(…, dp[mask][last] + overlap[last][nxt])`, remembering the parent.
4. Pick the best `last` for the full mask, walk the parents back to get the order, and join the words, skipping each overlap.

Do not try all n! orders; n is up to 12. Do not merge greedily by the largest overlap; it can miss the best order.

Time: O(n² · 2ⁿ + n² · L²) with L the word length  
Space: O(n · 2ⁿ)

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
