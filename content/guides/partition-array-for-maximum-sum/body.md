## Choose the last block

`dp[i]` = best sum for the first `i` elements, `dp[0] = 0`.

For `i` from 1 to `n`: `m = 0`; for `len` from 1 to `min(k, i)`:

- `m = max(m, arr[i − len])`.
- `dp[i] = max(dp[i], dp[i − len] + m · len)`.

Answer: `dp[n]`.

Growing the block leftward one element at a time keeps its maximum in O(1).

Do not greedily extend blocks around the largest values; the best cut depends on what follows. Do not recompute the block maximum from scratch for each length.

Time: O(n · k)  
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
