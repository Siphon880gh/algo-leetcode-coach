## Take a prefix of each pile

1. `dp = [0, −∞, …]` of size `k + 1`.
2. For each pile with prefix sums `pre`: `new[j + t] = max(new[j + t], dp[j] + pre[t])` for `t = 1 … len`.
3. Return `dp[k]`.

Examples → 101, 706. Checked against every combination of prefix lengths on 200 small cases.

Coins come off the top, so from each pile you always take a prefix. The total coin count is at most 2000, so the work is about k · 2000.

Time: O(k · Σ pile sizes)  
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
